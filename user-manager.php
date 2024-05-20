<?php
include ("database/connection.php");
require 'send_mail.php';

session_start();

if (!isset($_SESSION["login_user"])) {
    header("location: ../sign_in.php");
    exit();
}

if (!isset($_SESSION["admin"])) {
    header("location: ../index.php");
}

// Handle activation request
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // Generate new activation code
    $new_activation_code = bin2hex(random_bytes(16));

    // Update activation_code and activation_time in the database
    $update_query = "UPDATE user SET activation_code = '$new_activation_code', activation_time = NOW() WHERE id = $user_id";
    if (mysqli_query($conn, $update_query)) {
        // Retrieve user information
        $user_query = "SELECT * FROM user WHERE id = $user_id";
        $result = mysqli_query($conn, $user_query);
        $user = mysqli_fetch_assoc($result);

        // Send new activation email
        if (sendActivationEmail($user['fullname'], $user['email'], $new_activation_code)) {
            $activation_message = "Activation email has been sent successfully.";
        } else {
            $activation_message = "Failed to send activation email. Please contact the administrator for assistance.";
        }
    } else {
        $activation_message = "Failed to activate the account. Please try again later.";
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background-color: #de47ff;
            padding-top: 50px;
        }

        .container {
            max-width: 800px;
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

        .on-status {
            color: green;
        }

        .off-status {
            color: red;
        }

        .on-block {
            color: red;
        }

        .off-block {
            color: green;
        }

        .avatar-cell {
            width: 60px;
            /* Đảm bảo rằng ô chứa ảnh đại diện có kích thước cố định */
        }

        .avatar-wrapper {
            width: 50px;
            /* Đảm bảo rằng ảnh đại diện tròn nằm giữa ô */
            height: 50px;
            border-radius: 50%;
            /* Làm cho ảnh đại diện trở thành hình tròn */
            overflow: hidden;
            /* Ẩn bớt phần ngoài vòng tròn */
            position: relative;
        }

        .avatar-img {
            width: 100%;
            /* Đảm bảo rằng ảnh đại diện tròn điền đầy vào vùng chứa */
            height: 100%;
            transition: transform 0.3s ease;
            /* Thêm hiệu ứng khi di chuột qua */
        }

        .avatar-wrapper:hover .avatar-img {
            transform: scale(1.1);
            /* Phóng to ảnh khi di chuột qua */
        }

        .popup {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
            padding: 20px;
            z-index: 1000;
            display: none;
        }

        .popup h2 {
            margin-bottom: 10px;
            color: #333333;
        }

        .popup p {
            margin-bottom: 20px;
            color: #666666;
        }

        .popup .btn-wrapper {
            text-align: center;
        }

        .popup .btn {
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-confirm {
            background-color: #dc3545;
            color: #ffffff;
            border: none;
        }

        .btn-cancel {
            background-color: #007bff;
            color: #ffffff;
            border: none;
            margin-left: 10px;
        }
    </style>
</head>

<body>

    <?php
    // Separate PHP logic
    $sql = "SELECT * FROM user";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0):
        ?>
        <div class="container">
            <h3 class="mb-4" style="text-align: center;">Staff Manager</h3>

            <div class="mb-3">
                <a class="btn btn-secondary" href="index.php">Back</a>
                <a class="btn btn-success" href="add-user.php">Add User</a>
            </div>

            <table id="staffTable" class="table table-bordered table-hover ">
                <thead class="thead" style="background-color: #43cac2;">
                    <tr>
                        <th>Avatar</th>
                        <th>Full Name</th>
                        <th>Status</th>
                        <th>Block</th>
                        <th>Activation Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td class="avatar-cell">
                                <div class="avatar-wrapper">
                                    <img class="avatar-img" src="./images/user/<?= $row['avatar'] ?>" alt="Avatar">
                                </div>
                            </td>
                            <td><?= $row['fullname'] ?></td>
                            <td class="<?= ($row['status'] == 1) ? 'on-status' : 'off-status'; ?>">
                                <?= ($row['status'] == 1) ? "ONLINE" : "OFFLINE"; ?>
                            </td>
                            <td class="<?= ($row['block'] == 1) ? 'on-block' : 'off-block'; ?>">
                                <?= ($row['block'] == 1) ? "BLOCKED" : "UNBLOCKED"; ?>
                            </td>
                            <td><?= ($row['authentication'] == 1) ? "ACTIVATED" : "NOT ACTIVATED"; ?></td>
                            <td>
                                <?php if ($row['authentication'] == 0): ?>
                                    <a class="btn btn-sm btn-primary" href="?id=<?= $row['id'] ?>">Activate</a>
                                <?php endif; ?>
                                <a class="btn btn-sm btn-success" href="user-information.php?id=<?= $row['id'] ?>">Detail</a>
                                <button class="btn btn-sm btn-danger" onclick="confirmDelete(<?= $row['id'] ?>)">Delete</button>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="container">
            <p class="text-center">0 result</p>
        </div>
    <?php endif; ?>

    <div class="popup" id="popup">
        <h2>Confirmation</h2>
        <p>Are you sure you want to delete this user?</p>
        <div class="btn-wrapper">
            <button class="btn btn-confirm" onclick="deleteUser()">Yes, delete</button>
            <button class="btn btn-cancel" onclick="closePopup()">Cancel</button>
        </div>
    </div>

    <script>
        function confirmDelete(userId) {
            var popup = document.getElementById('popup');
            popup.style.display = 'block';
            // Pass userId to deleteuser function
            window.userId = userId;
        }

        function deleteUser() {
            var userId = window.userId;
            window.location.href = './api/api-delete-user.php?id=' + userId;
        }

        function closePopup() {
            var popup = document.getElementById('popup');
            popup.style.display = 'none';
        }
    </script>


</body>

</html>