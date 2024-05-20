<?php
include ("../database/connection.php");

// Kiểm tra xem id có được truyền qua không
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    // Truy vấn để lấy category_id của sản phẩm trước khi xóa
    $sql_select_category = "SELECT category_id, sold FROM product WHERE id='$id'";
    $result_select_category = mysqli_query($conn, $sql_select_category);
    if ($result_select_category && mysqli_num_rows($result_select_category) > 0) {
        $row = mysqli_fetch_assoc($result_select_category);
        $category_id = $row['category_id'];

        $sold = $row['sold'];

        // Check if sold count is not zero
        if ($sold != 0) {
            echo "Product with ID: $id cannot be deleted because it has been sold.";
        } else {
            // Delete the product
            $sql_delete = "DELETE FROM product WHERE id='$id'";
            $result_delete = mysqli_query($conn, $sql_delete);

            // Check if deletion was successful
            if ($result_delete) {
                // Redirect back to product management page with same category_id parameter
                header("location: ../product-manager.php?id=$category_id");
            } else {
                echo "Failed" . mysqli_error($conn);
            }
        }
    } else {
        echo "Category ID not found for product with ID: $id";
    }
} else {
    echo "ID is not provided";
}
?>