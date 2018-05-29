<?php
  $trimmed = trim($_POST["title"]);
  if(empty($_POST["title"]) || empty($trimmed)){
    header("Location: list.php");
    return;
  }
  header("Progma:no-cache");
  header("Cache-Control:no-cache,must-revalidate");
  require_once("dbconfig.php");
  $id = $_POST["id"];
  $title = mysqli_real_escape_string($conn,$_POST["title"]);
  $writer = mysqli_real_escape_string($conn,$_POST["writer"]);
  $content = mysqli_real_escape_string($conn,$_POST["content"]);
  
  $query = "UPDATE content SET title = '".$title."', writer='".$writer."', content='".$content."' WHERE id=".$_POST["id"];
  $result = mysqli_query($conn, $query);
  if ($result == FALSE) {
    echo "Failed to insert data into database<br>";
    echo "Error: ".mysqli_error($conn);
  }
  else {
    header("Location: detail.php?id=".$id);
  }
?>