<?php
include ("database/connection.php");

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
    $name = $_POST['name'];
    $avatar = $_FILES['avatar'];

    if (!$avatar['name']) {
        $avatar_name = 'nobody.png';
    } else {
        $time = time();
        $avatar_name = $time . $avatar['name'];
        $avatar_tmp_name = $avatar['tmp_name'];
        $avatar_destination_path = './images/category/' . $avatar_name;
        move_uploaded_file($avatar_tmp_name, $avatar_destination_path);
    }


    $sql = "INSERT INTO category (avatar, name) VALUES ('$avatar_name', '$name')";
    $result = mysqli_query($conn, $sql);
    header("location: category-manager.php");
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
    </style>
</head>

<body>
    <div class="container">
    <h3 class="mb-4" style="text-align: center;">Add Category</h3>

        <form id="addForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nameCategory">Name Category:</label>
                <input type="text" class="form-control" id="nameCategory" name="name">
            </div>
            <div class="form-group">
                <label for="avatar">Image:</label>
                <input type="file" id="avatar-upload" name="avatar" style="display: none;">
                <button type="button" class="btn btn-primary"
                    onclick="document.getElementById('avatar-upload').click();"> Choose Image </button>
                <img id="avatar-preview" src="#" alt="Preview" style="max-width: 200px; display: none;">
            </div>
            <div class="mb-3">
                <a class="btn btn-secondary" href="category-manager.php">Back</a>
                <button type="submit" class="btn btn-success" name="submit"">Add</button>
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