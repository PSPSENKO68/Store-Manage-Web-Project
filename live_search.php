<?php
include("database/connection.php");

$search_term = mysqli_real_escape_string($conn, $_POST['search_term']);
$query = "SELECT * FROM product WHERE name LIKE '%$search_term%' ORDER BY id ASC";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
        // Output each product as you did in your original PHP code
        echo '<form method="post" action="Cart.php?action=add&id=' . $row["id"] . '">';
        echo '<div class="card mt-3">';
        echo '<img class="card-img-top custom-card-img" src="./images/product/' . $row["avatar"] . '">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">' . $row["name"] . '</h5>';
        echo '<h6 class="card-text text-danger">Price: ' . $row["price_out"] . '$</h6>';
        echo '<h6 class="card-text text-primary">Quantity: ' . $row["quantity"] . '</h6>';
        echo '</div>';
        echo '<div class="card-footer text-center">';
        echo '<input type="submit" name="add" style="margin-top: 5px;" class="btn btn-success " value="Add">';
        echo '</div></div></form>';
    }
}
