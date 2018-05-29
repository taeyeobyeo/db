<?php
    require_once("dbconfig.php");
    $id = $_GET["id"];
    $cond = 0;
    if ($id == NULL) {
        error();
    }
    $query = "SELECT id, back_up FROM content WHERE id = ".$id;
    $result = mysqli_query($conn, $query);
    if ($result == FALSE) {
        echo "Failed to insert data into database<br>";
        echo "Error: ".mysqli_error($conn);
    }
    else if($row = mysqli_fetch_array($result)){
        if($row["back_up"] == 1)
        error();
        else $cond = 1;
    }
    if($cond == 1){
        $query = "UPDATE content SET back_up = 1 WHERE id = ".$id;
        $result = mysqli_query($conn, $query);
        if ($result == FALSE) {
            echo "Failed to insert data into database<br>";
            echo "Error: ".mysqli_error($conn);
        }
        else header("Location: list.php");
    }
    else error();
    function error(){
        echo '<body>';
        echo '<script type="text/javascript">';
        echo 'alert("This is not the right access.");';
        echo 'window.location.href="list.php"';
        echo '</script>';
        echo '</body>';
    }
?>