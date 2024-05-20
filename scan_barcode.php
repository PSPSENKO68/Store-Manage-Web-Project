<?php
include("database/connection.php");
?>

<!-- Index.html file -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <title>QR Code Scanner / Reader
    </title>
</head>
<style>
    /* style.css file*/
    body {
        display: flex;
        justify-content: center;
        margin: 0;
        padding: 0;
        height: 100vh;
        box-sizing: border-box;
        text-align: center;
        background: linear-gradient(90deg, #ff4af8 30%, #00c1f8 100%);

    }

    .container {
        width: 100%;
        max-width: 500px;
        margin: 5px;
    }

    .container h1 {
        color: #ffffff;
    }

    .section {
        background-color: #ffffff;
        padding: 50px 30px;
        border: 1.5px solid #b2b2b2;
        border-radius: 0.25em;
        box-shadow: 0 20px 25px rgba(0, 0, 0, 0.25);
    }

    #my-qr-reader {
        padding: 20px !important;
        border: 1.5px solid #b2b2b2 !important;
        border-radius: 8px;
    }

    #my-qr-reader img[alt="Info icon"] {
        display: none;
    }

    #my-qr-reader img[alt="Camera based scan"] {
        width: 100px !important;
        height: 100px !important;
    }

    button {
        padding: 10px 20px;
        border: 1px solid #b2b2b2;
        outline: none;
        border-radius: 0.25em;
        color: white;
        font-size: 15px;
        cursor: pointer;
        margin-top: 15px;
        margin-bottom: 10px;
        background-color: #008000ad;
        transition: 0.3s background-color;
    }

    button:hover {
        background-color: #008000;
    }

    #html5-qrcode-anchor-scan-type-change {
        text-decoration: none !important;
        color: #1d9bf0;
    }

    video {
        width: 100% !important;
        border: 1px solid #b2b2b2 !important;
        border-radius: 0.25em;
    }
</style>

<body>
    <div class="container">
        <h1>Scan QR Codes</h1>
        <div class="section">
            <div id="my-qr-reader">
            </div>
            <div class="mb-3">
            <a class="btn btn-secondary " href="Cart.php">Back</a>
        </div>
        </div>
    </div>
    
    <script src="https://unpkg.com/html5-qrcode">
    </script>
</body>
<script>
    function domReady(fn) {
        if (
            document.readyState === "complete" ||
            document.readyState === "interactive"
        ) {
            setTimeout(fn, 1000);
        } else {
            document.addEventListener("DOMContentLoaded", fn);
        }
    }

    domReady(function() {
        // If found you qr code
        function onScanSuccess(decodeText, decodeResult) {
            fetch('Cart_add.php?action=add&id=' + encodeURIComponent(decodeText), {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'add=true',
                })
                .then(response => response.text())
                .then(data => console.log(data))
                .catch((error) => {
                    console.error('Error:', error);
                });

            window.location.href = 'Cart.php';
        }

        let htmlscanner = new Html5QrcodeScanner(
            "my-qr-reader", {
                fps: 10,
                qrbos: 250
            }
        );
        htmlscanner.render(onScanSuccess);
    });
</script>

</html>