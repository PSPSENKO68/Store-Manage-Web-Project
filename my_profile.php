<?php
include("./database/connection.php");
session_start();

if (!isset($_SESSION["login_user"])) {
    header("location: ./sign_in.php");
    exit();
}


$username = $_SESSION["login_user"];
$sql = "SELECT * FROM user where username = '$username' LIMIT 1";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);


if (isset($_POST["update"])) {
    // Handle avatar upload
    if ($_FILES['avatar']['name'] != '') {
        $avatar = $_FILES['avatar']['name'];
        $temp = $_FILES['avatar']['tmp_name'];
        $folder = "./images/user/";
        move_uploaded_file($temp, $folder . $avatar);
        $avatar_sql = ", avatar = '$avatar'";
    } else {
        $avatar_sql = "";
    }


    $pass = $_POST['pass'];
    $sql_u = "UPDATE user SET pass = '$pass' $avatar_sql WHERE id = '$row[id]'";
    $result_u = mysqli_query($conn, $sql_u);
    header("location: my_profile.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"></script>
    <title>User Information</title>
</head>
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
    .rounded-circle {
        border-radius: 50%;
        object-fit: cover;
        width: 200px; /* Điều chỉnh kích thước ảnh theo ý muốn */
        height: 200px; /* Điều chỉnh kích thước ảnh theo ý muốn */
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    }
</style>

<body>
    <div class="container rounded bg-white my-5 py-3 col-md-6">
        <h3 class="text-center mt-2">Profile Information</h3>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="d-flex flex-column align-items-center text-center">
                <img id="avatar-preview" class="rounded-circle mt-5 border border-dark " width="200px" src="./images/user/<?= $row['avatar'] ?>">
                <label for="avatar-upload" class="btn btn-primary mt-3">
                    <i class="fas fa-upload me-1"></i> Choose Avatar
                </label>
                <input type="file" name="avatar" id="avatar-upload" accept="image/*" class="d-none">
            </div>
            <div class="p-3 py-5">
                <div class="row mt-2">
                    <div class="col-md-6"><label class="labels" style="font-size: 15px">Full Name</label><input disabled type="text" class="form-control" name="fullname" value="<?php echo $row['fullname'] ?>">
                    </div>
                    <div class="col-md-6"><label class="labels" style="font-size: 15px">UserName</label><input disabled type="text" class="form-control" value="<?php echo $row['username'] ?>"></div>
                </div>
                <div class="row mt-3">

                    <div class="col-md-12"><label class="labels" style="font-size: 15px">Email</label><input disabled type="text" class="form-control" name="email" value="<?php echo $row['email'] ?>"></div>
                    <div class="col-md-12"><label class="labels" style="font-size: 15px">Password</label><input type="text" class="form-control" name="pass" value="<?php echo $row['pass'] ?>"></div>

                </div>
                <div class="row mt-2">
                    <div class="mt-5 text-center">
                            <a class="btn btn-secondary " href="index.php" >Back</a>
                        <button class="btn btn-primary " type="submit" name="update">Update Profile</button>
                    </div>
                </div>
            </div>
        </form>

    </div>
</body>
<script>
    document.getElementById('avatar-upload').addEventListener('change', function() {
        var file = this.files[0];
        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('avatar-preview').src = e.target.result;
        };
        reader.readAsDataURL(file);
    });
</script>

</html>