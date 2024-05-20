<?php
include("../admin/database/connection.php");
session_start();

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql = "SELECT * FROM product WHERE id = '$id' LIMIT 1";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if (isset($_POST["update"])) {
            $name = $_POST['name'];
            $price_in = $_POST['price_in'];
            $price_out = $_POST['price_out'];
            $category_id = $_POST['category_id'];
            $quantity = $_POST['quantity'];
            $updated_at = date('Y-m-d H:i:s');

            // Check if a file is uploaded
            if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $image = $_FILES['image'];
                $image_name = $image['name'];
                $image_tmp = $image['tmp_name'];
                $image_path = "../images/product/$image_name";

                // Move uploaded file to the specified path
                move_uploaded_file($image_tmp, $image_path);

                // Update product record with new image path
                $sql_update = "UPDATE product SET 
                               name = '$name', 
                               price_in = '$price_in', 
                               price_out = '$price_out', 
                               category_id = '$category_id', 
                               quantity = '$quantity', 
                               avatar = '$image_name',
                               updated_at = '$updated_at' 
                               WHERE id = '$id'";
            } else {
                // Update product record without changing the image
                $sql_update = "UPDATE product SET 
                               name = '$name', 
                               price_in = '$price_in', 
                               price_out = '$price_out', 
                               category_id = '$category_id', 
                               quantity = '$quantity', 
                               updated_at = '$updated_at' 
                               WHERE id = '$id'";
            }

            $result_update = mysqli_query($conn, $sql_update);
            if ($result_update) {
                header("location: ../product-manager.php?id=$category_id");
                exit();
            } else {
                echo "Error updating record: " . mysqli_error($conn);
            }
        }
    } else {
        echo "Product not found";
    }
} else {
    echo "ID is not provided";
}
?>
