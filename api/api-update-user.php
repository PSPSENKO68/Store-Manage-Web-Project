<?php
include("../database/connection.php");
session_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql = "SELECT * FROM user where id = '$id' LIMIT 1";
    if(isset($_POST["update"])){
        // Handle avatar upload
        if($_FILES['avatar']['name'] != ''){
            $time = time();
            $avatar_name = $time . $_FILES['avatar']['name'];
            $temp = $_FILES['avatar']['tmp_name'];
            $folder = "../images/user/";
            move_uploaded_file($temp, $folder.$avatar_name);
            $avatar_sql = ", avatar = '$avatar_name'";
        } else {
            $avatar_sql = "";
        }

        // Other user data update
        $name = $_POST['fullname'];
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        if($_POST['role'] == 'admin'){
            $role = 1;
        } else {
            $role = 0;
        }
        if($_POST['block'] == 'block'){
            $block = 1;
        } else {
            $block = 0;
        }

        $sql = "UPDATE user SET fullname = '$name', email = '$email', pass = '$pass', role = '$role', block = '$block' $avatar_sql WHERE id = '$id'";
        $result = mysqli_query($conn, $sql);
        header("location: ../user-manager.php");
    }
} else {
    echo "ID is not provided";
}

?>