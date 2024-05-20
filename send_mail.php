<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

function sendActivationEmail($name, $email, $activation_code)
{
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->SMTPDebug = false;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'nxbinh2004@gmail.com';
        $mail->Password = 'cqci uudl tjfg xyfq';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        //Recipients
        $mail->setFrom('nxbinh2004@gmail.com', 'CellphoneX.com.vn');
        $mail->addAddress($email, $name);
        $mail->addCC('nxbinh2004@gmail.com');

        // Tạo link kích hoạt
        $linkActive = 'http://localhost:8080/phonestore/active.php?code=' . $activation_code;

        // Thiết lập nội dung email
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = 'Kích hoạt tài khoản';
        $mail->Body = "
            <!DOCTYPE html>
            <html lang='en'>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <title>Kích hoạt tài khoản</title>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        line-height: 1.6;
                        background-color: #f4f4f4;
                        margin: 0;
                        padding: 0;
                    }
                    .container {
                        max-width: 600px;
                        margin: 20px auto;
                        padding: 20px;
                        background: #fff;
                        border-radius: 8px;
                        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                    }
                    h1 {
                        color: #333;
                        text-align: center;
                    }
                    p {
                        color: #666;
                        font-size: 16px;
                        line-height: 1.8;
                    }
                    .btn {
                        display: inline-block;
                        padding: 10px 20px;
                        background-color: #007bff;
                        color: #fff;
                        text-decoration: none;
                        border-radius: 5px;
                    }
                    .footer {
                        margin-top: 20px;
                        text-align: center;
                        color: #999;
                        font-size: 14px;
                    }
                </style>
            </head>
            <body>
                <div class='container'>
                    <h1>Kích hoạt tài khoản</h1>
                    <p>Xin chào $name,</p>
                    <p>Vui lòng nhấp vào đường link sau để kích hoạt tài khoản của bạn:</p>
                    <a href='$linkActive' class='btn'>Kích hoạt tài khoản</a>
                    <p><strong>Lưu ý:</strong> Bạn chỉ có 1 phút để kích hoạt tài khoản. Sau 1 phút, đường link sẽ hết hạn và bạn cần phải liên hệ admin để nhận lại đường link kích hoạt mới.</p>
                    <p>Trân trọng cảm ơn!</p>
                    <div class='footer'>
                        <p>CellphoneX.com.vn</p>
                    </div>
                </div>
            </body>
            </html>
            ";

        // Gửi email
        $mail->send();

        return true; // Gửi email thành công
    } catch (Exception $e) {
        return false; // Gửi email không thành công
    }
}
?>