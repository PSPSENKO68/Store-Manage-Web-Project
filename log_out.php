<?php
    include("database/connection.php");
   session_start();


   if(session_destroy()) {
      $myusername = $_SESSION['login_user'];
      $update_sql = "UPDATE user SET status = 0 WHERE username = '$myusername'";
      mysqli_query($conn, $update_sql);

      header("Location: sign_in.php");
   }
?>