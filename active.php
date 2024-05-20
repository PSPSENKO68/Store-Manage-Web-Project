<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activation Status</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            text-align: center;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
        }

        .message {
            margin-top: 20px;
            font-size: 18px;
        }

        .redirect {
            margin-top: 20px;
            font-size: 16px;
            color: #666;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Activation Status</h1>
        <?php
        include ("./database/connection.php");

        if (isset($_GET['code'])) {
            $activation_code = $_GET['code'];

            // Kiểm tra thời hạn của đường link kích hoạt
            $check_activation_query = "SELECT * FROM user WHERE activation_code = '$activation_code' AND authentication = 0 AND activation_time >= NOW() - INTERVAL 1 MINUTE";
            $result = $conn->query($check_activation_query);
            if ($result->num_rows > 0) {
                // Kích hoạt tài khoản
                $activate_user_query = "UPDATE user SET authentication = 1 WHERE activation_code = '$activation_code'";
                if ($conn->query($activate_user_query) === TRUE) {
                    echo "<p class='message'>Tài khoản của bạn đã được kích hoạt thành công!</p>";
                    // Redirect to login page after 5 seconds
                    echo "<p class='redirect'>Chuyển đến trang đăng nhập sau 5 giây...</p>";
                    echo "<meta http-equiv='refresh' content='5;url=log_out.php'>";
                } else {
                    echo "<p class='message'>Đã có lỗi xảy ra khi kích hoạt tài khoản: " . $conn->error . "</p>";
                }
            } else {
                // Thông báo đường link kích hoạt đã hết hiệu lực
                echo "<p class='message'>Đường link kích hoạt đã hết hiệu lực, vui lòng liên hệ admin để được gửi lại đường link kích hoạt khác.</p>";
            }
        } else {
            echo "<p class='message'>Không có mã kích hoạt được cung cấp.</p>";
        }
        ?>
    </div>
</body>

</html>