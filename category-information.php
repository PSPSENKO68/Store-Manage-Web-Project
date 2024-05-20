<?php
include ("database/connection.php");
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
    <title>Category Information</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: #de47ff;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #BA68C8
        }

        .profile-button {
            background: rgb(99, 39, 120);
            box-shadow: none;
            border: none
        }

        .profile-button:hover {
            background: #682773
        }

        .profile-button:focus {
            background: #682773;
            box-shadow: none
        }

        .profile-button:active {
            background: #682773;
            box-shadow: none
        }

        .back:hover {
            color: #682773;
            cursor: pointer
        }

        .labels {
            font-size: 11px
        }

        .add-experience:hover {
            background: #BA68C8;
            color: #fff;
            cursor: pointer;
            border: solid 1px #BA68C8
        }

        .on-status {
            color: green;
        }

        .off-status {
            color: red;
        }
    </style>
</head>

<body>
    <div class="container rounded bg-white my-5 py-3 col-md-6">
        <?php
        // Lấy ID của category từ URL
        $id = $_GET["id"];

        // Truy vấn thông tin category từ database
        $sql = "SELECT * FROM category WHERE id = $id LIMIT 1";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        // Nếu không tìm thấy category, thông báo lỗi
        if (!$row) {
            echo "<p>Category not found</p>";
            exit();
        }
        ?>

        <h3 class="text-center mt-2">Category Information</h3>
        <form action="./api/api-update-category.php?id=<?php echo $row['id'] ?>" method="post"
            enctype="multipart/form-data">
            <div class="d-flex flex-column align-items-center text-center">
                <img id="avatar-preview" class="rounded-circle mt-5 mb-3" width="200px"
                    src="./images/category/<?php echo $row['avatar']; ?>">
                <label for="avatar-upload" class="btn btn-primary mt-3">
                    <i class="fas fa-upload me-1"></i> Choose Avatar
                </label>
                <input type="file" name="avatar" id="avatar-upload" accept="image/*" class="d-none">
            </div>
            <div class="p-3 py-5">
                <div class="row mt-2">
                    <div class="col-md-12"><label class="labels" style="font-size: 15px">ID</label><input disabled
                            type="text" class="form-control" name="id" value="<?php echo $row['id'] ?>"></div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12"><label class="labels" style="font-size: 15px">Name</label><input type="text"
                            class="form-control" name="name" value="<?php echo $row['name'] ?>"></div>
                </div>
                <div class="row mt-2">
                    <div class="mt-5 text-center">
                        <a class="btn btn-danger" type="button" href="./category-manager.php">Back</a>
                        <button class="btn btn-primary" type="submit" name="update">Update Category</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>

</html>

<script>
    document.getElementById('avatar-upload').addEventListener('change', function () {
        var file = this.files[0];
        var reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById('avatar-preview').src = e.target.result;
        };
        reader.readAsDataURL(file);
    });
</script>