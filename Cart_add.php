<?php
include ("database/connection.php");
date_default_timezone_set('Asia/Ho_Chi_Minh');
session_start();


if (isset($_POST["add"])) {
    $id = $_GET["id"];
    $query = "SELECT * FROM product WHERE id = $id";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 0) {
        exit;
    }
    $row = mysqli_fetch_assoc($result);

    $item_array = array(
        'product_id' => $row["id"],
        'item_name' => $row["name"],
        'product_price' => $row["price_out"],
        'item_quantity' => 1,
        'cost' => $row["price_in"],
    );

    if (isset($_SESSION["cart"])) {
        if (array_key_exists($id, $_SESSION["cart"])) {
            $_SESSION["cart"][$id]["item_quantity"] += 1;
        } else {
            $_SESSION["cart"][$id] = $item_array;
        }
    } else {
        $_SESSION["cart"] = array($id => $item_array);
    }
    
    header("Location: Cart.php");
}


?>