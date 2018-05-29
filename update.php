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
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="write.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <title>21300443 - TaeyeobYeo</title>
  </head>
  <body>
    <div class="container">
      <form class="form-horizontal" action="update_process.php" method="post">
        <input type="hidden" name="id" value='<?= $id?>'>
        <?php
          $query = "SELECT title, writer, content FROM content WHERE id = ".$id;
          $result = mysqli_query($conn, $query);
          while($row = mysqli_fetch_array($result)) {   
            $title = addslashes($row["title"]);
            $writer = addslashes($row["writer"]);
            $content = $row["content"];
            echo "<div class=\"form-group\">";
            echo "<label class=\"col-md-2 control-label\">Title</label>";
            echo "<div class=\"col-md-10\">";
            echo "<input class=\"form-control\" type=\"text\" name=\"title\" placeholder=\"Enter the title\" value =\"\">";
            echo "</div>";
            echo "</div>";
            echo "<div class=\"form-group\">";
            echo "<label class=\"col-md-2 control-label\">Writer</label>";
            echo "<div class=\"col-md-10\">";
            echo "<input class=\"form-control\" type=\"text\" name=\"writer\" placeholder=\"Enter within 30 characters.\" value =\"\">";
            echo "</div>";
            echo "</div>";
            echo "<div class=\"form-group\">";
            echo "<label class=\"col-md-2 control-label\">Content</label>";
            echo "<div class=\"col-md-10\">";
            echo "<textarea class=\"form-control\" name=\"content\" rows=\"10\" placeholder=\"Enter the content\">".$content."</textarea>";
            echo "</div>";
            echo "</div>";
          }
        ?>
        <script>
          $('input[name="title"]').val('<?= $title?>');
          $('input[name="writer"]').val('<?= $writer?>');
        </script>
        <div class="form-group">
          <div class="col-md-offset-2 col-md-10">
            <button class="btn btn-default" type="submit">저장</button>
          </div>
        </div>
      </form>
    </div>
  </body>
</html>