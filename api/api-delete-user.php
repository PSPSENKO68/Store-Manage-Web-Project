<?php
include ("../database/connection.php");
$id = $_GET["id"];
$sql = "DELETE FROM user WHERE id='$id'";
$result = mysqli_query($conn, $sql);
if ($result) {
    header('location: ../user-manager.php');
} else {
    echo "Failed" . mysqli_error($conn);
}

?>