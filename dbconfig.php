<?php
  $db_host = "localhost";
  $db_user = "root";
  $db_password = "josh826";  // your password
  $db_name = "project";
  $conn = mysqli_connect($db_host, $db_user, $db_password, $db_name);
  if (mysqli_connect_errno($conn)) {
    echo "Database connection failed: ".mysqli_connect_error();
  }
?>