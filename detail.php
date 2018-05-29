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
  $query = "SELECT id, back_up FROM content WHERE id = ".$id;
  $result = mysqli_query($conn, $query);
  if ($result == FALSE) {
      echo "Failed to insert data into database<br>";
      echo "Error: ".mysqli_error($conn);
  }
  else if($row = mysqli_fetch_array($result)){
    if($row["back_up"] == 1){
      echo '<body>';
      echo '<script type="text/javascript">';
      echo 'alert("This is not the right access.");';
      echo 'window.location.href="list.php"';
      echo '</script>';
      echo '</body>';
    }
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <title>21300443 - TaeyeobYeo</title>
  </head>
  <body>
    <div class="container">
      <?php
        $query = "SELECT title, writer, content FROM content WHERE id = ".$id;
        $result = mysqli_query($conn, $query);
        while($row = mysqli_fetch_array($result)) {
          echo "<div class='page-header'>";
          echo "<h1><small>Title:</small> ".$row["title"]."</h1>";
          echo "</div>";
          echo "<div class='panel panel-default'>";
          echo "<div class='panel-heading'>Writer: ".$row["writer"]."</div>";
          echo "<div class='panel-body'>".$row["content"]."</div>";
          echo "</div>";
        }
      ?>
      <button class="btn btn-default" type ="button" id="list">List</button>
      <button class="btn btn-default" type ="button" id="del">삭제</button>
      <button class="btn btn-default" type ="button" id="back">백업삭제</button>
      <button class="btn btn-default" type ="button" id="update">수정</button>
      <?php include 'footer.html'?>
    </div>
    <script>
      $("#list").click(function() {
            location.href = "list.php";
      });
      $("#del").click(function() {
        if(confirm("삭제하시겠습니까?")){
            var number = '<?= $id?>';
            var url = "deleteprocess.php?id=" + number;
            location.href = url;
        }
      });
      $("#back").click(function() {
        if(confirm("백업삭제하시겠습니까?")){
            var number = '<?= $id?>';
            var url = "backupprocess.php?id=" + number;
            location.href = url;
        }
      });
      $("#update").click(function() {
        var number = '<?= $id?>';
        var url = "update.php?id=" + number;
        location.href = url;
      });
    </script>
  </body>
</html>