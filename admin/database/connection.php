<?php
$host = 'fdb1032.awardspace.net';
$user = '4483488_cellphonex';
$password = 'QTyPnASd03b-a,hW';
$dbName = '4483488_cellphonex';

$conn = mysqli_connect($host, $user, $password, $dbName);
if (mysqli_connect_errno()) {
    die("Failed to connect with MySQL: " . mysqli_connect_error());
}

?>