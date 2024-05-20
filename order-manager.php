<?php
include("database/connection.php");
session_start();

if (!isset($_SESSION["login_user"])) {
    header("location: ./sign_in.php");
    exit();
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Manager</title>
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

        h3 {
            text-align: center;
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
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var btnOpenPDFs = document.querySelectorAll('.btn-open-pdf');
            btnOpenPDFs.forEach(function(btnOpenPDF) {
                btnOpenPDF.addEventListener('click', function() {
                    var invoice = this.getAttribute('data-invoice');
                    var pdfUrl = "./invoice/" + invoice;
                    window.open(pdfUrl, '_blank');
                });
            });
        });
    </script>
</head>

<body>
    <?php
    if (isset($_GET['id'])) {
        $customer_id = $_GET['id'];
        $query = "SELECT * FROM order_history WHERE customer_id = $customer_id";
        $result = mysqli_query($conn, $query);
    } else {
        header("location: customer-manager.php");
        exit();
    }

    if (mysqli_num_rows($result) > 0) :
    ?>
        <div class="container">
            <h3 class="mb-4">Order Manager</h3>
            <?php
            if (isset($_SESSION["admin"])) {
                echo '<div class="mb-3">
                <a class="btn btn-secondary" href="customer-manager.php">Back</a>
            </div>';
            }
            ?>

            <table id="staffTable" class="table table-bordered table-hover ">
                <thead class="thead text-center" style="background-color: #43cac2;">
                    <tr>
                        <th>Order ID</th>
                        <th>Order Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= $row['order_date'] ?></td>
                            <td>
                                <button class="btn-open-pdf btn btn-link" data-invoice="<?= $row['invoice'] ?>">Open
                                    PDF</button>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
        </div>
    <?php else : ?>
        <div class="container">
            <p class="text-center">0 result</p>
        </div>
    <?php endif; ?>
</body>

</html>