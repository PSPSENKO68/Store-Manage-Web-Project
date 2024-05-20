<?php
include("./database/connection.php");
session_start();
$error = '';

if (isset($_SESSION["login_user"])) {
    header("location: ./index.php");
    exit();
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $myusername = mysqli_real_escape_string($conn, $_POST['user']);
    $mypassword = mysqli_real_escape_string($conn, $_POST['pass']);

    $sql = "SELECT * FROM user WHERE username = '$myusername' and pass = '$mypassword'";

    $result = mysqli_query($conn, $sql);


    if (mysqli_num_rows($result) == 1) {
        $_SESSION['login_user'] = $myusername;
        $row = mysqli_fetch_assoc($result);

        if ($row["authentication"] == 0) {
            $error = "Your account has not been activated";
        } else if ($row["block"] == 1) {
            $error = "Your account wasn't block";
        } else {
            $update_sql = "UPDATE user SET status = 1 WHERE username = '$myusername'";
            mysqli_query($conn, $update_sql);
            if ($row["login"] == 0) {
                header('location: changePass.php');
                exit();
            } else if ($row['role'] == 1) {
                $_SESSION["admin"] = $myusername;
                header('location: index.php');
                exit();
            }
            header("location: index.php");
            exit();
        }
    } else {
        $error = "Your Login Name or Password is invalid";
    }
}

?>


<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title>Login Form</title>
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
            text-align: center;
            /* Căn giữa nội dung */
        }

        .logo {
            text-align: center;
            /* Căn giữa nội dung */
        }

        .logo img {
            display: block;
            /* Hiển thị hình ảnh dưới dạng block để có thể căn giữa */
            margin: 0 auto;
            /* Margin tự động (auto) ở trục ngang sẽ giúp căn giữa */
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
        <div class="logo">
            <img src="images/logo/icon.png" alt="Logo" class="logo">
        </div>
        <div class="title text-center"><h4>Login Form</h4></div>
        <div class="content">

            <div style="font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>

            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div class="input-box">
                    <span>Username</span>
                    <input type="text" name="user" placeholder="Enter your username" required>
                </div>
                <div class="input-box">
                    <span>Password</span>
                    <input type="password" name="pass" placeholder="Enter your password" required>
                </div>
                <div class="button">
                    <input type="submit" name="submit" value="Sign In">
                </div>
            </form>
        </div>
    </div>

</body>

</html>