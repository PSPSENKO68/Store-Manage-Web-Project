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
    <title>Product Manager</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
            margin: auto;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            padding: 12px;
            text-align: center;
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

    <div class="container">
        <h3 class="text-center mt-2">Product Manager</h3>

        <div class="mb-3">
            <a class="btn btn-secondary" href="category-manager.php">Back</a>
            <?php
            if (isset($_SESSION['admin'])) {
                echo '<a class="btn btn-success" href="./add-product.php">Add Product</a>';
            }
            ?>

        </div>

        <table id="productTable" class="table table-bordered table-hover ">
            <thead class="thead" style="background-color: #43cac2;">
                <tr>
                    <th>Avatar</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $id = $_GET["id"];
                $sql = "SELECT * FROM product WHERE category_id = '$id'";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                        <tr>
                            <td><img class="" width="50px" src="./images/product/<?= $row['avatar'] ?>"></td>
                            <td><?php echo $row['name'] ?></td>
                            <td>
                                <a class="btn btn-sm btn-success" href="product-information.php?id=<?php echo $row['id'] ?>">Detail</a>
                                <?php
                                if (isset($_SESSION['admin'])) {
                                    echo '<a class="btn btn-sm btn-danger" href="#" onclick="confirmDelete(' . $row['id'] . ')">Delete</a>';
                                }
                                ?>
                                
                            </td>
                        </tr>
                <?php
                    }
                } else {
                    echo "0 result";
                }
                ?>
            </tbody>
        </table>
    </div>

    <div class="popup" id="popup">
        <h2>Confirmation</h2>
        <p>Are you sure you want to delete this product?</p>
        <div class="btn-wrapper">
            <button class="btn btn-confirm" onclick="deleteProduct()">Yes, delete</button>
            <button class="btn btn-cancel" onclick="closePopup()">Cancel</button>
        </div>
    </div>

    <script>
        function confirmDelete(productId) {
            var popup = document.getElementById('popup');
            popup.style.display = 'block';
            // Pass productId to deleteProduct function
            window.productId = productId;
        }

        function deleteProduct() {
            var productId = window.productId;
            window.location.href = './api/api-delete-product.php?id=' + productId;
        }

        function closePopup() {
            var popup = document.getElementById('popup');
            popup.style.display = 'none';
        }
    </script>

    <script>
        sessionStorage.setItem('previousUrl', window.location.href);
    </script>

</body>

</html>