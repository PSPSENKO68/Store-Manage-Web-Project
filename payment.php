<?php
include("database/connection.php");
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"></script>
    <title>User Information</title>
</head>
<style>
    @import url('https://fonts.googleapis.com/css?family=Montserrat:400,700&display=swap');

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        list-style: none;
        font-family: 'Montserrat', sans-serif
    }

    body {
        background-color: green;
        line-height: 1rem;
        font-size: 14px;
        padding: 10px
    }

    .container {
        border-top-left-radius: 25px;
        border-top-right-radius: 25px;
        border-bottom-left-radius: 25px;
        border-bottom-right-radius: 25px;
        background-color: #eee
    }

    .navbar-brand {
        text-transform: uppercase;
        font-size: 14px;
        font-weight: 800
    }

    nav {
        border-top-left-radius: 25px;
        border-top-right-radius: 25px;
        background-color: white
    }

    .order .card {
        position: relative;
        background: #fff;
        box-shadow: 0 0 15px rgba(0, 0, 0, .1)
    }

    .ribbon {
        width: 150px;
        height: 150px;
        overflow: hidden;
        position: absolute
    }

    .ribbon::before,
    .ribbon::after {
        position: absolute;
        content: '';
        display: block;
        border: 5px solid red
    }

    .ribbon span {
        position: absolute;
        display: block;
        width: 225px;
        padding: 15px 0;
        background-color: red;
        box-shadow: 0 5px 10px rgba(0, 0, 0, .1);
        color: #fff;
        font: 700 18px/1 'Lato', sans-serif;
        text-shadow: 0 1px 1px rgba(0, 0, 0, .2);
        text-transform: uppercase;
        text-align: center
    }

    .ribbon-top-right {
        top: -12px;
        right: -12px
    }

    .ribbon-top-right::before,
    .ribbon-top-right::after {
        border-top-color: transparent;
        border-right-color: transparent
    }

    .ribbon-top-right::before {
        top: 0;
        left: 0
    }

    .ribbon-top-right::after {
        bottom: 0;
        right: 0
    }

    .ribbon-top-right span {
        left: -25px;
        top: 30px;
        transform: rotate(45deg)
    }

    small {
        font-size: 12px
    }

    .cart {
        line-height: 1
    }

    .icon {
        background-color: #eee;
        width: 40px;
        height: 40px;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 50%
    }

    .pic {
        width: 70px;
        height: 90px;
        border-radius: 5px
    }

    td {
        vertical-align: middle
    }

    .red {
        color: #fd1c1c;
        font-weight: 600
    }

    .b-bottom {
        border-bottom: 2px dotted black;
        padding-bottom: 20px
    }

    p {
        margin: 0px
    }

    table input {
        width: 40px;
        border: 1px solid #eee
    }

    input:focus {
        border: 1px solid #eee;
        outline: none
    }

    .round {
        background-color: #eee;
        height: 40px;
        width: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center
    }

    .payment-summary .unregistered {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #eee;
        text-transform: uppercase;
        font-size: 14px
    }

    .payment-summary input {
        width: 100%;
        margin-right: 20px
    }

    .payment-summary .sale {
        width: 100%;
        background-color: #e9b3b3;
        text-transform: uppercase;
        font-size: 12px;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 5PX 0
    }

    .red {
        color: #fd1c1c
    }

    .del {
        width: 35px;
        height: 35px;
        object-fit: cover
    }

    .delivery .card {
        padding: 10px 5px
    }

    .option {
        position: relative;
        top: 50%;
        display: block;
        cursor: pointer;
        color: #888
    }

    .option input {
        display: none
    }

    .checkmark {
        position: absolute;
        top: 40%;
        left: -25px;
        height: 20px;
        width: 20px;
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 50%
    }

    .option input:checked~.checkmark:after {
        display: block
    }

    .option .checkmark:after {
        content: "\2713";
        width: 10px;
        height: 10px;
        display: block;
        position: absolute;
        top: 30%;
        left: 50%;
        transform: translate(-50%, -50%) scale(0);
        transition: 200ms ease-in-out 0s
    }

    .option:hover input[type="radio"]~.checkmark {
        background-color: #f4f4f4
    }

    .option input[type="radio"]:checked~.checkmark {
        background: #ac1f32;
        color: #fff;
        transition: 300ms ease-in-out 0s
    }

    .option input[type="radio"]:checked~.checkmark:after {
        transform: translate(-50%, -50%) scale(1);
        color: #fff
    }
</style>

<body>
    <div class="container mt-4 p-0">
        <div class="row px-md-4 px-2 pt-4">
            <input type="text" id="searchInput" placeholder="Search products...">
            <div class="col-lg-7">
                <p class="pb-2 fw-bold">Product</p>
                <div class="card">
                    <div>
                        <div class="table-responsive px-md-4 px-2 pt-3">
                            <table class="table table-borderless">
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM product";
                                    $result = mysqli_query($conn, $sql);

                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {

                                    ?>
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div> <img class="pic" src="./images/<?= $row['avatar'] ?>" alt=""> </div>
                                                        <div class="ps-3 d-flex flex-column justify-content">
                                                            <p class="fw-bold"><?php echo $row['name'] ?></p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        <p class="pe-3"><span class="red"><?php echo $row['price_out'] ?></span></p>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <span class="pe-3 text-muted">Quantity</span>
                                                        <span class="pe-3"> <input class="ps-2" type="number" value="2"></span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <button class="btn btn-success">Add</button>
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
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <p class="pb-2 fw-bold">Current Order</p>
                <div class="card">
                    <div>
                        <div class="table-responsive px-md-4 px-2 pt-3">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr class="border-bottom">
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div> <img class="pic" src="https://images.pexels.com/photos/7322083/pexels-photo-7322083.jpeg?auto=compress&cs=tinysrgb&dpr=2&w=500" alt=""> </div>
                                                <div class="ps-3 d-flex flex-column justify-content">
                                                    <p class="fw-bold">Iphone</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <p class="pe-3"><span class="red">$45.00</span></p>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center"> <span class="pe-3 text-muted">Quantity</span> <span class="pe-3"> <input class="ps-2" type="number" value="2"></span>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <p class="fw-bold pt-lg-0 pt-4 pb-2">Payment Summary</p>
                <div class="card px-md-3 px-2 pt-4">
                    <div class="d-flex justify-content-between pb-3"> <small class="text-muted">Transaction code</small>
                        <p class="">VC115665</p>
                    </div>
                    <div class="d-flex flex-column b-bottom">
                        <div class="d-flex justify-content-between py-3"> <small class="text-muted">Order Summary</small>
                            <p>$122</p>
                        </div>
                        <div class="d-flex justify-content-between pb-3"> <small class="text-muted">Additional Service</small>
                            <p>$22</p>
                        </div>
                        <div class="d-flex justify-content-between"> <small class="text-muted">Total Amount</small>
                            <p>$132</p>
                        </div>
                    </div>
                </div>
                <div>
                    <?php
                    include("customer.php");
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    // Function to handle product search
    function searchProducts() {
        // Get the search query from the input field
        var searchQuery = document.getElementById('searchInput').value.toLowerCase();
        // Get all product items
        var products = document.querySelectorAll('#productList .card');

        // Loop through each product item
        products.forEach(function(product) {
            // Get product name
            var productName = product.querySelector('.fw-bold').innerText.toLowerCase();
            // If product name contains search query, display it, otherwise hide it
            if (productName.indexOf(searchQuery) > -1) {
                product.style.display = 'block';
            } else {
                product.style.display = 'none';
            }
        });
    }

    // Add event listener to input field for search
    document.getElementById('searchInput').addEventListener('input', searchProducts);
</script>
</html>