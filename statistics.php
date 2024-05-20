<?php
include("database/connection.php");
session_start();
if (!isset($_SESSION["login_user"])) {
    header("location: sign_in.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Thống kê doanh thu bán hàng</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <style>
        *{
            font-family: Arial, Helvetica, sans-serif;
        }
        th,
        td {
            padding: 15px;
            text-align: center;
            border-bottom: 2px solid #ddd;
        }

        th {
            background-color: #43cac2;
            color: white;
        }

        /* Hiệu ứng hover cho các hàng của bảng */
        tr:hover {
            background-color: #f5f5f5;
        }

        /* Hiệu ứng hover cho thanh tìm kiếm */
        #search:hover {
            border-color: #888;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 10px;
            background-color: #f4f4f4;
        }

        h1,
        h2 {
            color: #333;
        }

        form {
            margin-bottom: 20px;
        }

        input[type="date"],
        input[type="submit"],
        #search {
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: #43cac2;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #43cac2;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            color: #333;
            background-color: #fff;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        #totalRevenueTable {
            width: 100%;
            border-collapse: collapse;
            color: #333;
            background-color: #fff;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
        }

        #totalRevenueTable th,
        #totalRevenueTable td {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        #totalRevenueTable th {
            background-color: #43cac2;
            color: white;
        }

        #totalRevenueTable tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #totalRevenueTable tr:hover {
            background-color: #ddd;
        }
    </style>
</head>

<body>
    <h1 style="text-align: center;">Statistics on sales revenue of phone stores</h1>
    <!-- Add this to your form -->
    <div class="mb-3">
        <a class="btn btn-secondary" href="index.php">Back</a>
    </div>
    <form method="post" action="statistics.php">
        <label for="timeline">Choose time:</label>
        <select id="timeline" name="timeline" class="form-control" style="width: auto; display: inline-block;">
            <option value="today">Today</option>
            <option value="yesterday">Yesterday</option>
            <option value="7days">In 7 day</option>
            <option value="thismonth">This month</option>
            <option value="fromto">Form-To</option>
        </select>

        <div id="dateRange" style="display: none;">
            <label for="fromDate">From:</label>
            <input type="date" id="fromDate" name="fromDate">
            <label for="toDate">To:</label>
            <input type="date" id="toDate" name="toDate">
        </div>

        <input type="submit" value="Submit">
    </form>

    <!-- Bảng hiển thị sản phẩm đã bán -->
    <div class="table-responsive"></div>
    <table class="table " id="myTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Total Money</th>
                <th>Money in</th>
                <th>Money out</th>
                <th>Time</th>
                <th>Quantity Products</th>
                <th>Customer ID</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $timeline = $_POST['timeline']; // Get the selected timeline from the form data

                $fromDate = new DateTime();
                $toDate = new DateTime();


                switch ($timeline) {
                    case 'today':
                        $fromDate->setTime(0, 0, 0);
                        $toDate->setTime(23, 59, 59);
                        break;
                    case 'yesterday':
                        $fromDate->modify('-1 day');
                        $toDate->modify('-1 day');
                        $fromDate->setTime(0, 0, 0);
                        $toDate->setTime(23, 59, 59);
                        break;
                    case '7days':
                        $fromDate->modify('-7 days');
                        $fromDate->setTime(0, 0, 0);
                        $toDate->setTime(23, 59, 59);
                        break;
                    case 'thismonth':
                        $fromDate->modify('first day of this month');
                        $toDate->modify('last day of this month');
                        $fromDate->setTime(0, 0, 0);
                        $toDate->setTime(23, 59, 59);
                        break;
                    case 'fromto':
                        $fromDate = DateTime::createFromFormat('Y-m-d', $_POST['fromDate']);
                        $toDate = DateTime::createFromFormat('Y-m-d', $_POST['toDate']);
                        $fromDate->setTime(0, 0, 0);
                        $toDate->setTime(23, 59, 59);
                        break;
                }

                $fromDate = $fromDate->format('Y-m-d H:i:s');
                $toDate = $toDate->format('Y-m-d H:i:s');



                $query = "SELECT * FROM order_history WHERE order_date >= '$fromDate' AND order_date <= '$toDate'";
                $result = mysqli_query($conn, $query);

                $totalMoney = 0;
                $count_invoid = 0;
                $quantity_product = 0;
                $quantity_cost = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    $totalMoney = $totalMoney + $row['totalmoney'];
                    $count_invoid = $count_invoid + 1;
                    $quantity_product = $quantity_product + $row['quantity'];
                    $quantity_cost += $row['cost']

            ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['totalmoney']; ?></td>
                        <td><?php echo $row['money_in']; ?></td>
                        <td><?php echo $row['money_out']; ?></td>
                        <td><?php echo $row['order_date']; ?></td>
                        <td><?php echo $row['quantity']; ?></td>
                        <td><?php echo $row['customer_id']; ?></td>
                    </tr>

            <?php
                }
                $profit = $totalMoney - $quantity_cost;
            }
            ?>
        </tbody>
    </table>
    </div>

    <div class="container"></div>
    <h2 class="mt-5" style="text-align: center;">Statistics table of all revenue</h2>
    <table class="table table-bordered mt-3" id="totalRevenueTable">
        <tr>
            <th>Total revenue</th>
            <td><?php echo isset($totalMoney) ? $totalMoney : 0 ?> $</td>
        </tr>
        <tr>
            <th>Total invoice</th>
            <td><?php echo isset($count_invoid) ? $count_invoid : 0 ?></td>
        </tr>
        <tr>
            <th>Total products</th>
            <td><?php echo isset($quantity_product) ? $quantity_product : 0 ?></td>
        </tr>

        <?php

        if (isset($_SESSION['admin'])) {
            echo '<tr>';
            echo '<th>Profit</th>';
            echo '<td>' . (isset($profit) ? $profit : 0) . ' $</td>';
            echo '</tr>';
        }
        ?>
    </table>
    </div>

    <script>
        document.getElementById('timeline').addEventListener('change', function() {
            if (this.value === 'fromto') {
                document.getElementById('dateRange').style.display = 'block';
            } else {
                document.getElementById('dateRange').style.display = 'none';
            }
        });
    </script>
</body>

</html>