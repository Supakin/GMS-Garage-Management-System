<!DOCTYPE html>
<html>
<head>
<!-- Always force latest IE rendering engine -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1">
<title> gms.garage-management-systems.com</title>
<!--CSS-bootstrap4-->
<link rel ="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<!--CSS-myCSS-->
<link rel ="stylesheet" href="myCSS.css">

<!--JS-bootstrap4-->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<!--JS-myJS-->
<script type="text/javascript" src="myJS.js"></script>

<!--font-Thai-->
<link href="https://fonts.googleapis.com/css?family=Athiti" rel="stylesheet">
</head>

<body id="main">
<div class="container">
  <div class="row justify-content-center">
    <div class="col-11">
      <h3>ประวัติการลงเวลาเข้า-ออก</h3>
    </div>
    <div class="col-1">
      <button type="button" class="btn default" onclick='window.history.go(-1);'>ปิด</button>
    </div>
  </div>
  <div class="row justify-content-center"><br></div>
  <table class="table table-hover">
    <thead>
      <tr>
        <th>วัน</th>
        <th>รหัสพนักงาน</th>
        <th>ชื่อพนักงาน</th>
        <th>เวลาเข้า</th>
        <th>เวลาออก</th>
        <th>จำนวนชั่วโมงที่ทำ</th>
      </tr>
    </thead>
    <?php
    while($row = mysql_fetch_array($sql_query)) {
      echo "<tr>";
      echo "<td>" .$row["SCH_DATE"] .  "</td> ";
      echo "<td>" .$row["EMP_ID"] .  "</td> ";
      echo "<td>" .$row["EMP_FNAME"] ."    ".$row["EMP_LNAME"]. "</td> ";
      echo "<td>" .$row["SCH_STARTTIME"] ."</td> ";
      if($row["SCH_FINISHTIME"]== '00:00:00'){
        echo "<td><b>ไม่ได้ลงเวลาออก</b></td>";
        echo "<td><b><b>ไม่สามารถคำนวณได้</b></td>";
      }else{
        echo "<td>" .$row["SCH_FINISHTIME"] ."</td> ";
        echo "<td>" .$row["AMOUNTHOURS"] ."</td> ";
      }
      echo "</tr>";
    }
    ?>
  </table>



</div>




</body>
</html>
