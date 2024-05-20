<?php
include ("database/connection.php");

session_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');

if (!isset($_SESSION["login_user"])) {
    header("location: ./sign_in.php");
    exit();
}

if (!isset($_SESSION["admin"])) {
    header("location: ./index.php");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $price_in = $_POST['price_in'];
    $price_out = $_POST['price_out'];
    $category_id = $_POST['category'];
    $quantity = $_POST['quantity'];
    $avatar = $_FILES['avatar'];
    $created_at = date('Y-m-d H:i:s');


    if (!$avatar['name']) {
        $avatar_name = 'user/nobody.png';
    } else {
        $time = time();
        $avatar_name = $time . $avatar['name'];
        $avatar_tmp_name = $avatar['tmp_name'];
        $avatar_destination_path = './images/product/' . $avatar_name;
        move_uploaded_file($avatar_tmp_name, $avatar_destination_path);
    }

    $sql = "INSERT INTO product (name, avatar, price_in, price_out, category_id, created_at, updated_at, quantity) VALUES ('$name', '$avatar_name', '$price_in', '$price_out', '$category_id', '$created_at', '$created_at', '$quantity')";
    $result = mysqli_query($conn, $sql);
    header("location: product-manager.php?id=$category_id");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Manager</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 50px;
        }

        .container {
            max-width: 700px;
            margin: auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h3 {
            color: #007bff;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid #dee2e6;
            padding: 12px;
            text-align: center;
        }

        #avatar-preview {
            max-width: 200px;
            border: 2px solid #ccc;
            border-radius: 8px;
            display: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <form id="addForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="productName">Name:</label>
                <input type="text" class="form-control" id="productName" name="name">
            </div>
            <div class="form-group">
                <label for="in">Input Price:</label>
                <input type="text" class="form-control" id="in" name="price_in">
            </div>
            <div class="form-group">
                <label for="out">Output Price:</label>
                <input type="text" class="form-control" id="out" name="price_out">
            </div>
            <div class="form-group">
                <label for="category">Category:</label>
                <select class="form-control" id="category" name="category">
                    <?php
                    $category_query = "SELECT * FROM category";
                    $category_result = mysqli_query($conn, $category_query);

                    while ($row = mysqli_fetch_assoc($category_result)) {
                        echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="quantity">Quantity:</label>
                <input type="text" class="form-control" id="productName" name="quantity">
            </div>
            <div class="form-group">
                <label for="avatar">Image:</label>
                <input type="file" id="avatar-upload" name="avatar" style="display: none;">
                <button type="button" class="btn btn-primary"
                    onclick="document.getElementById('avatar-upload').click();"> Choose Image </button>
                <img id="avatar-preview" src="#" alt="Preview" style="max-width: 200px; display: none;">
            </div>
            <div class="mb-3">
                <button type="button" class="btn btn-secondary" onclick="goBack()">Back</button>
                <button type="submit" class="btn btn-success" name="submit"">Add</button>
            </div>
        </form>
    </div>
    <script>
        function goBack() {
            var previousUrl = sessionStorage.getItem('previousUrl');
            if (previousUrl) {
                window.location.href = previousUrl;
            } else {
                // Nếu không có địa chỉ URL trước đó, chuyển hướng về trang mặc định
                window.location.href = 'product-manager.php';
            }
        }
    </script>
</body>

</html>

<script>
    document.getElementById('avatar-upload').addEventListener('change', function () {
        var file = this.files[0];
        var reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById('avatar-preview').src = e.target.result;
            document.getElementById('avatar-preview').style.display = 'block';
        };
        reader.readAsDataURL(file);
    });
</script>