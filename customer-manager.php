<?php
include ("database/connection.php");
session_start();

if (!isset($_SESSION["login_user"])) {
    header("location: ./sign_in.php");
    exit();
}

if (!isset($_SESSION["admin"])) {
    header("location: ./index.php");
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
            height: 50px;
            border-radius: 50%;
            overflow: hidden;
            position: relative;
        }

        .avatar-img {
            width: 100%;
            height: 100%;
            transition: transform 0.3s ease;
        }

        .avatar-wrapper:hover .avatar-img {
            transform: scale(1.1);
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
    $sql = "SELECT * FROM customer";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0):
        ?>
        <div class="container">
            <h3 class="mb-4" style="text-align: center;">Customer Manager</h3>

            <div class="mb-3">
                <a class="btn btn-secondary" href="index.php">Back</a>
            </div>

            <table id="staffTable" class="table table-bordered table-hover ">
                <thead class="thead" style="background-color: #43cac2;">
                    <tr>
                        <th>Customer ID</th>
                        <th>Phone Number</th>
                        <th>Full Name</th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= $row['phonenumber'] ?></td>
                            <td><?= $row['fullname'] ?></td>
                            <td><?= $row['address'] ?></td>
                            <td>
                                <a class="btn btn-sm btn-success" href="order-manager.php?id=<?= $row['id'] ?>">View
                                    Order</a>
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
</body>

</html>