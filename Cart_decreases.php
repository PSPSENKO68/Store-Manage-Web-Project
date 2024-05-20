<?php
include ("database/connection.php");
date_default_timezone_set('Asia/Ho_Chi_Minh');
session_start();


if (isset($_GET["action"]) && $_GET["action"] == "decreases" && isset($_GET["id"])) {
    $id = $_GET["id"];
    if (isset($_SESSION["cart"])) {
        $cart_items = $_SESSION["cart"];
        if (array_key_exists($id, $cart_items)) {
            $cart_items[$id]["item_quantity"] -= 1;
            if ($cart_items[$id]["item_quantity"] <= 0) {
                unset($cart_items[$id]);
            }
            $_SESSION["cart"] = $cart_items;
        }
    }
    header("Location: Cart.php");
    exit;
}


?>