<?php
include("../database/connection.php");
session_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');
// Xác định xem có ID được cung cấp không
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql = "SELECT * FROM category WHERE id = '$id' LIMIT 1";

    // Kiểm tra xem có sự kiện nút cập nhật được kích hoạt không
    if (isset($_POST["update"])) {
        // Xử lý tải lên avatar
        if($_FILES['avatar']['name'] != ''){
            $time = time();
            $avatar_name = $time . $_FILES['avatar']['name'];
            $temp = $_FILES['avatar']['tmp_name'];
            $folder = "../images/category/";
            move_uploaded_file($temp, $folder.$avatar_name);
            $avatar_sql = ", avatar = '$avatar_name'";
        } else {
            $avatar_sql = "";
        }

        // Cập nhật thông tin danh mục khác
        $name = $_POST['name'];

        // Câu lệnh SQL cập nhật thông tin danh mục
        $sql = "UPDATE category SET name = '$name' $avatar_sql WHERE id = '$id'";
        $result = mysqli_query($conn, $sql);

        // Chuyển hướng trở lại trang quản lý danh mục
        header("location: ../category-manager.php");
    }
} else {
    echo "ID is not provided";
}
?>
