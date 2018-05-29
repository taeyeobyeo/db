<?php
  require_once("dbconfig.php");
  $page = $_GET["page"];
  $count = $_GET["count"];
  $condition = $_GET["condition"];
  if ($page == NULL) $page = 1;
  else $page = (int)$_GET["page"];
  if ($count == NULL) $count = 10;
  else $count = (int)$_GET["count"];
  if ($condition == NULL) $condition = "";
  else {$condition = (string)$_GET["condition"];
    $condi = str_replace("\"","\"%",$condition);
    $cond = str_replace("*","%\"",$condi);
  };
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="list.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <title>Diamond</title>
  </head>
  <body>
    <div class="title"><h1>Title</h1></div>
    <div class="container">
      <table class="table table-hover">
        <thead>
          <tr>
            <th id="number">#</th>
            <th id="title">Title</th>
            <th id="writer">Writer</th>
            <th id="date">Date</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $first = (($page-1)*$count);
            $query = "SELECT id, title, writer, DATE_FORMAT(write_date, \"%d/%c/%Y %h:%i %p\" ) as 'date' FROM content WHERE ".$cond." back_up = 0 LIMIT ".($first).", ".$count;
            $result = mysqli_query($conn, $query);
            while($row = mysqli_fetch_array($result)) {
              echo "<tr>";
              echo "<td>".$row["id"]."</td>";
              echo "<td>".$row["title"]."</td>";
              echo "<td>".$row["writer"]."</td>";
              echo "<td>".$row["date"]."</td>";
              echo "</tr>";
            }
          ?>
        </tbody>
      </table>
      <select id="selector" class="btn btn-default" onchange="myfunction()">
        <option value="" disabled selected>정렬선택</option>
        <?php
          if($count == 10){
            echo "<option value=\"5\">5개</option>";
            echo "<option value=\"10\" selected=\"selected\">10개</option>";
            echo "<option value=\"15\">15개</option>";
          }
          else if($count == 5){
            echo "<option value=\"5\" selected=\"selected\">5개</option>";
            echo "<option value=\"10\">10개</option>";
            echo "<option value=\"15\">15개</option>";
          }
          else {
            echo "<option value=\"5\">5개</option>";
            echo "<option value=\"10\">10개</option>";
            echo "<option value=\"15\" selected=\"selected\">15개</option>";
          }
        ?>
      </select>
      <script>
        function myfunction(){
          var x = document.getElementById("selector").value;
          var url = "list.php?page=1&count="+x;
          location.href = url;
        }
      </script>
      <button id="write_btn" class="btn btn-default" type="button">Write</button>
      <div class="text-center">
        <ul class="pagination col-md-12">
          <?php
            $query = "SELECT id FROM content";
            $result = mysqli_query($conn, $query);
            $rows = mysqli_num_rows($result);
            if (!($rows <= $count)) {
              if ($page == 1)
                echo "<li class='disabled'><a href='#'><span>&laquo;</span></a></li>";
              else
                echo "<li><a href='list.php?page=".($page - 1)."&count=".($count)."&condition=".($condition)."'><span>&laquo;</span></a></li>";
              for ($i = 1; $i <= (int)($rows / $count+1); $i++) {
                if ($page == $i)
                  echo "<li class='active'><a href='list.php?page=".$i."&count=".($count)."&condition=".($condition)."'>".$i."</a></li>";
                else
                  echo "<li><a href='list.php?page=".$i."&count=".($count)."&condition=".($condition)."'>".$i."</a></li>";
              }
              if ($page == (int)($rows / $count+1))
                echo "<li class='disabled'><a href='#'><span>&raquo;</span></a></li>";
              else
                echo "<li><a href='list.php?page=".($page+1)."&count=".($count)."&condition=".($condition)."'><span>&raquo;</span></a></li>";
            }
          ?>
        </ul>
      </div>
        <select id="search_option" class="btn btn-default">
          <option value="" disabled selected>검색대상</option>
          <option value="bytitle">제목</option>
          <option value="bywriter">작성자</option>
        </select>
        <input type="text" id="object" placeholder="2글자 이상으로 입력해주세요.">
        <button id="search" class="btn btn-default" type="button">검색</button>
        <button id="reset" class="btn btn-default" type="button">리셋</button>
      <script>
        $(function() {
          $("table > tbody > tr").click(function() {
            var number = $(this).find("td").eq(0).text();
            var url = "detail.php?id=" + number;
            location.href = url;
          });
          $("#write_btn").click(function() {
            location.href = "write.html";
          });
          $("#search").click(function() {
            var tex = document.getElementById("object").value;
            var v = document.getElementById("search_option").value;
            if (tex.length < 2)
              alert("2글자 이상으로 입력해주세요.");
            else if(v == "bytitle"){
              tex = tex.replace("\"","\\\"");
              tex = tex.replace("\'","\\\'");
              var cond =" title LIKE \"" + tex + "* AND";
              var url = "list.php?page=1&count="+'<?= $count?>'+"&condition="+ cond;
              location.href = url;
            }
            else if(v == "bywriter"){
              tex = tex.replace("\"","\\\"");
              tex = tex.replace("\'","\\\'");
              var cond =" writer LIKE \"" + tex + "* AND";
              var url = "list.php?page=1&count="+'<?= $count?>'+"&condition="+ cond;
              location.href = url;
            }
            else alert("검색대상을 선택해주세요.");
          });
          $("#reset").click(function() {
            location.href = "list.php";
          });
        });
      </script>
      <?php include 'footer.html'?>
    </div>
  </body>
</html>