<?php
include ("./database/connection.php");
session_start();

if (!isset($_SESSION["login_user"])) {
    header("location: sign_in.php");
    exit();
}
if (isset($_SESSION["login_user"])) {
    $username = $_SESSION['login_user'];
    $query = "SELECT * FROM  user WHERE username='$username'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>

<html lang="en" dir="ltr">

<head>
<link rel="icon" href="./images/logo/icon.png" type="image/x-icon" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.3/js/bootstrap.min.js" integrity="sha384-1zjw8Y9CK3q42NpUrK7K/4pLb7v4XlRhZ1Ll1RyK6xQ/RPx5CO7f6K6l6gO9w5J" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">

    <link rel="stylesheet" href="css_header/fonts/icomoon/style.css">

    <link rel="stylesheet" href="css_header/css/owl.carousel.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css_header/css/bootstrap.min.css">
    
    <!-- Style -->
    <link rel="stylesheet" href="css_header/css/style.css">
    
    <style>
        * {
            font-family: Arial, sans-serif;
        }

        .dropdown-menu {
            display: none;
        }

        .dropdown:hover .dropdown-menu {
            display: block;
        }

        footer {
            color: white;
            /* Màu chữ trắng */
        }

        footer a {
            color: white;
            /* Màu chữ trắng cho các liên kết */
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" style="background-color: #b24fff;">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="images\logo\logo.png" alt="Cellphone X" width="180" height="80">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item active ">
                        <a class="nav-link text-white" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="about.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="service.php">Services</a>
                    </li>
                    <li>
                        <div class="dropdown">
                            <a href="#" class="d-block" id="dropdownUser1" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <img src="./images/user/<?= $row['avatar'] ?>" alt="mdo" width="40" height="40"
                                    class="rounded-circle">
                            </a>
                            <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
                                <li><a class="dropdown-item" href="my_profile.php">My
                                        Profile</a></li>
                                <li><a class="dropdown-item" href="log_out.php">Sign
                                        out</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    

</body>
<script src="css_header/js/jquery-3.3.1.min.js"></script>
    <script src="css_header/js/popper.min.js"></script>
    <script src="css_header/js/bootstrap.min.js"></script>
    <script src="css_header/js/jquery.sticky.js"></script>
    <script src="css_header/js/main.js"></script>
</html>