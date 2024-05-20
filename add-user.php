<?php
include ("database/connection.php");
require './send_mail.php';

session_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');

if (!isset($_SESSION["login_user"])) {
    header("location: ./sign_in.php");
    exit();
}

if (!isset($_SESSION["admin"])) {
    header("location: ./index.php");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['fullname'];
    $email = $_POST['email'];
    $check_email_sql = "SELECT * FROM user WHERE email = '$email'";
    $check_email_result = mysqli_query($conn, $check_email_sql);
    if (mysqli_num_rows($check_email_result) > 0) {
        echo "<script>alert('The email already exists in the database. Please choose another email.');</script>";
        echo "<script>window.history.back();</script>";
        exit(); // Dừng việc thêm người dùng mới nếu email đã tồn tại
    }
    $emailParts = explode("@", $email);
    $username = $emailParts[0];
    $pass = $emailParts[0];
    $avatar = $_FILES['avatar'];
    $activation_code = bin2hex(random_bytes(16));
    $activation_time = date('Y-m-d H:i:s'); // Lưu thời điểm tạo mã

    if (!$avatar['name']) {
        $avatar_name = 'nobody.png';
    } else {
        $time = time();
        $avatar_name = $time . $avatar['name'];
        $avatar_tmp_name = $avatar['tmp_name'];
        $avatar_destination_path = './images/user/' . $avatar_name;
        move_uploaded_file($avatar_tmp_name, $avatar_destination_path);
    }

    $role = ($_POST['role'] == 'admin') ? 1 : 0;

    $sql = "INSERT INTO user (fullname, email, username, pass, avatar, role, login, status, block, authentication, activation_code, activation_time) VALUES ('$name', '$email', '$username', '$pass', '$avatar_name', '$role', 0, 0, 0, 0, '$activation_code', '$activation_time')";
    $result = mysqli_query($conn, $sql);
    header("location: user-manager.php");

    if ($result) {
        // Gửi email kích hoạt
        if (sendActivationEmail($name, $email, $activation_code)) {
            echo "Tài khoản đã được tạo thành công. Một email kích hoạt đã được gửi đến $email. Vui lòng kiểm tra email của bạn để kích hoạt tài khoản.";
        } else {
            echo "Tài khoản đã được tạo thành công nhưng gửi email kích hoạt không thành công. Vui lòng liên hệ quản trị viên để được hỗ trợ.";
        }
    } else {
        echo "Đã có lỗi xảy ra khi thêm nhân viên. Vui lòng thử lại sau.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Manager</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #de47ff;
            padding-top: 50px;
        }

        .container {
            max-width: 700px;
            margin: auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid #dee2e6;
            padding: 12px;
            text-align: center;
        }

        #avatar-preview {
            max-width: 200px;
            border: 2px solid #ccc;
            border-radius: 8px;
            display: none;
        }

        .alert {
            padding: 20px;
            background-color: #f44336;
            color: white;
            margin-bottom: 15px;
        }

        /* Định dạng cho nút đóng */
        .closebtn {
            margin-left: 15px;
            color: white;
            font-weight: bold;
            float: right;
            font-size: 22px;
            line-height: 20px;
            cursor: pointer;
            transition: 0.3s;
        }

        /* Khi di chuột qua nút đóng, thay đổi màu nền */
        .closebtn:hover {
            color: black;
        }
    </style>
</head>

<body>
    <div class="container">
        <h3 class="mb-4" style="text-align: center;">Add Staff</h3>
        <form id="addForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="staffFirstName">Full Name:</label>
                <input type="text" class="form-control" id="staffFullName" name="fullname">
            </div>
            <div class="form-group">
                <label for="staffEmail">Email:</label>
                <input type="email" class="form-control" id="staffEmail" name="email">
            </div>
            <div class="form-group">
                <label for="avatar">Avatar:</label>
                <input type="file" id="avatar-upload" name="avatar" style="display: none;">
                <button type="button" class="btn btn-primary"
                    onclick="document.getElementById('avatar-upload').click();"> Choose Image </button>
                <img id="avatar-preview" src="#" alt="Preview" style="max-width: 200px; display: none;">
            </div>
            <div class="form-group">
                <label>Role:</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="role" id="staff" value="staff">
                    <label class="form-check-label" for="staff">Staff</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="role" id="admin" value="admin">
                    <label class="form-check-label" for="admin">Admin</label>
                </div>
            </div>
            <div class="mb-3">
                <a class="btn btn-secondary" href="user-manager.php">Back</a>
                <button type="submit" class="btn btn-success" name="submit">Add</button>
            </div>
        </form>
    </div>
</body>

</html>
<script>
    document.getElementById('avatar-upload').addEventListener('change', function () {
        var file = this.files[0];
        var reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById('avatar-preview').src = e.target.result;
            document.getElementById('avatar-preview').style.display = 'block';
        };
        reader.readAsDataURL(file);
    });
</script>