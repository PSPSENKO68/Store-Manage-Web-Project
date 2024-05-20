<?php
// Kết nối đến cơ sở dữ liệu
include ("database/connection.php");
session_start();

// Lấy thông tin khách hàng từ biến POST
$phone = $_POST['phone'];
$name = $_POST['name'];
$address = $_POST['address'];

// Truy vấn cơ sở dữ liệu để lấy danh sách hóa đơn của khách hàng
$sql = "SELECT * FROM order_history WHERE customer_id IN (SELECT id FROM customer WHERE phonenumber = '$phone' AND fullname = '$name' AND address = '$address')";
$result = $conn->query($sql);

// Hiển thị danh sách hóa đơn
if ($result->num_rows > 0) {
    echo "<table class='table table-striped'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>Invoice ID</th>";
    echo "<th>Total Money</th>";
    echo "<th>Action</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>$" . $row["totalmoney"] . "</td>";
        echo "<td><button class='btn btn-primary btn-open-pdf' data-invoice='" . $row["invoice"] . "'>View PDF</button></td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
} else {
    echo "<p class='text-center'>Không có hóa đơn nào cho khách hàng này.</p>";
}

$conn->close();
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Manager</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>

<style>
        
        .container {
            max-width: 800px;
            margin: auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        
    </style>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        var btnOpenPDFs = document.querySelectorAll('.btn-open-pdf');
        btnOpenPDFs.forEach(function (btnOpenPDF) {
            btnOpenPDF.addEventListener('click', function () {
                var invoice = this.getAttribute('data-invoice');
                var pdfUrl = "./invoice/" + invoice;
                // Hiển thị thông báo yêu cầu người dùng nhấp để mở cửa sổ mới
                if (confirm("Nhấp OK để mở hóa đơn PDF trong cửa sổ mới.")) {
                    // Nếu người dùng đồng ý, mở cửa sổ mới
                    window.open(pdfUrl, '_blank');
                }
            });
        });
    });

</script>