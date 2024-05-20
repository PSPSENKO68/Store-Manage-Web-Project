<?php
include ("../database/connection.php");
$id = $_GET["id"];

// Xóa tất cả các sản phẩm liên quan đến danh mục
$sql_delete_products = "DELETE FROM product WHERE category_id='$id'";
$result_delete_products = mysqli_query($conn, $sql_delete_products);

// Sau đó mới xóa danh mục
$sql_delete_category = "DELETE FROM category WHERE id='$id'";
$result_delete_category = mysqli_query($conn, $sql_delete_category);

if ($result_delete_category) {
    header('location: ../category-manager.php');
} else {
    echo "Failed" . mysqli_error($conn);
}
?>