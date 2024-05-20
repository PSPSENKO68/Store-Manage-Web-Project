<?php
include("./database/connection.php");
session_start();
$error = '';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new = $_POST["new"];
    $confirm = $_POST["confirm"];
    $myusername = $_SESSION['login_user'];

    if ($new != $confirm) {
        $error = "New password and confirm password do not match";
    } else {
        $sql = "UPDATE user SET pass = '$new' , login = 1 WHERE username = '$myusername'";
        if (mysqli_query($conn, $sql)) {
            header("location: index.php");
            exit();
        } else {
            $error = "Failed to update password";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title>Password Change Form</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 10px;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(90deg, #ff4af8 30%, #00c1f8 100%);
        }

        .container {
            max-width: 500px;
            width: 100%;
            background: linear-gradient(to right, #ffffff, #dfd8d8);
            color: #333;
            padding: 25px 30px;
            border-radius: 10px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.15);
        }

        .title {
            font-size: 25px;
            font-weight: 500;
            position: relative;
            margin-bottom: 20px;
        }

        .title::before {
            content: "";
            position: absolute;
            left: 0;
            bottom: -5px;
            height: 3px;
            width: 30px;
            border-radius: 5px;
            background: linear-gradient(90deg, #ff4af8 30%, #00c1f8 100%);
        }

        .input-box {
            margin-bottom: 20px;
        }

        .input-box span {
            display: block;
            font-weight: 500;
            margin-bottom: 5px;
            color: #333;
        }

        input[type="text"],
        input[type="password"] {
            height: 45px;
            width: 100%;
            outline: none;
            font-size: 16px;
            border-radius: 5px;
            padding-left: 15px;
            border: 1px solid #ccc;
            border-bottom-width: 2px;
            transition: all 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="password"]:focus,
        input[type="text"]:valid,
        input[type="password"]:valid {
            border-color: #00c1f8;
        }

        .button {
            margin-top: 20px;
        }

        input[type="submit"] {
            height: 45px;
            width: 100%;
            border-radius: 5px;
            border: none;
            color: #fff;
            font-size: 18px;
            font-weight: 500;
            letter-spacing: 1px;
            cursor: pointer;
            transition: all 0.3s ease;
            background: linear-gradient(90deg, #ff4af8 30%, #00c1f8 100%);
        }

        input[type="submit"]:hover {
            background: linear-gradient(90deg, #00c1f8 30%, #ff4af8 100%);
        }

        @media(max-width: 584px) {
            .container {
                max-width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="title">Password Change</div>
        <div class="content">
            <div style="font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>

            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">    
                <div class="input-box">
                    <span>New Password</span>
                    <input type="text" name="new" placeholder="Enter your password" required>
                </div>
                <div class="input-box">
                    <span>Confirm Password</span>
                    <input type="password" name="confirm" placeholder="Retype your password" required>
                </div>
                <div class="button">
                    <input type="submit" name="submit" value="Change Password">   
                </div>
            </form>
        </div>
    </div>

</body>

</html>

