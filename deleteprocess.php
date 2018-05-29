<?php
    require_once("dbconfig.php");
    $id = $_GET["id"];
    if ($id == NULL) {
    echo '<body>';
    echo '<script type="text/javascript">';
    echo 'alert("This is not the right access.");';
    echo 'window.location.href="list.php"';
    echo '</script>';
    echo '</body>';
    }
    $query = "DELETE FROM content WHERE id = ".$id;
    $result = mysqli_query($conn, $query);
    if ($result == FALSE) {
        echo "Failed to insert data into database<br>";
        echo "Error: ".mysqli_error($conn);
    }
    else header("Location: list.php");
?>