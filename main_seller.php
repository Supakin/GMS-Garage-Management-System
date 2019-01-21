<?php
  require_once('GMSdb/connect.inc.php');
  connect();
?>

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

<!--icon-->
<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.5.0/css/all.css' integrity='sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU' crossorigin='anonymous'>

<!--font-Thai-->
<link href="https://fonts.googleapis.com/css?family=Athiti" rel="stylesheet">
</head>

<body>
<div class = "container" >
  <div class="row justify-content-center align-content-center">
    <button type="button" class="btn btn-info btn-block mt-2 shadow-sm" onClick = "window.location.replace('main.php')">
      <i class='fas fa-home' style='font-size:10px;color:white'></i>
      กลับหน้าหลัก
    </button>
  </div>
  <div class="row mt-3 mb-3 align-items-center">
    <div class="col-1">
      <i class="fas fa-hands-helping" style='font-size:65px;color:black'></i>
    </div>
    <div class="col-9">
      <h1>คู่ค้าของเรา</h1>
    </div>
    <div class="col-2 justify-content-center">
      <button type="button" class="btn btn-success btn-block shadow-sm" data-toggle="modal" data-target="#addseller">
        <i class='fas fa-plus' style='font-size:10px;color:white'></i>
        เพิ่มข้อมูลคู่ค้า
      </button>
    </div>
  </div>
  <div class="row">
  <table class="table table-hover table-bordered table-sm" >
    <thead class="thead-dark">
      <tr align="center">
        <th>รหัสคู่ค้า</th>
        <th>ชื่อคู่ค้า</th>
        <th>เบอร์โทรติดต่อ</th>
        <th>ที่อยู่</th>
        <th>รายละเอียดเพิ่มเติม</th>
      </tr>
    </thead>
    <?php
    $sql = "SELECT * FROM SELLER ORDER BY SEL_ID";
    $resultsql = mysql_query($sql) or die (mysql_error());

    while($row = mysql_fetch_array($resultsql)) {
    ?>
      <tr>
        <td align="center"> <?php  echo $row["SEL_ID"] ?> </td>
        <td> <?php  echo $row["SEL_NAME"] ?> </td>
        <td align="center"> <?php  echo $row["SEL_TEL"] ?> </td>
        <td align="center"> <?php  echo $row["SEL_ADDRESS"] ?> </td>
        <td align="center"> <?php  echo $row["SEL_DESCRIPT"] ?> </td>
      </tr>
    <?php
    }
    ?>
  </table>
</div>
</div>






<!---------------------------------------------------------------------------------------->
<!--addseller-->
<form  method="post" action="insert.data.php">
  <div class="modal fade" id="addseller">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">เพิ่มคู่ค้า</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <input type="hidden" name="action" value="addseller">
          <div class="form-group">
            <label for="sel_id">รหัสคู่ค้า :</label>
            <input name="sel_id" type="text" class="form-control"  maxlength="6" readonly value
            ="<?php
              $sql = "SELECT SUBSTR(MAX(SEL_ID),2) FROM SELLER";
              $sql_query = mysql_query($sql) or die(mysql_error());
              $sel_id = (int)mysql_result($sql_query,0,0);
              $sel_id += 1;
              $sel_id = str_pad($sel_id, 5, "0", STR_PAD_LEFT);
              $sel_id = "S".$sel_id;

              echo $sel_id?>">
          </div>
          <div class="form-group">
            <label for="sel_name">ชื่อคู่ค้า :</label>
            <input name="sel_name" type="text" class="form-control" id="sel_name" required autocomplete="off">
          </div>
          <div class="form-group">
            <label for="sel_tel">เบอร์โทรติดต่อ :</label>
            <input name="sel_tel" type="text" class="form-control" id="sel_tel" required autocomplete="off">
          </div>
          <div clas="form-group">
            <label for="sel_address">ที่อยู่ :</label>
            <textarea name="sel_address" class="form-control" rows="2" id="sel_address" required autocomplete="off"></textarea>
          </div>
          <div clas="form-group">
            <label for="sel_descript">รายละเอียดเพิ่มเติม :</label>
            <textarea name="sel_descript" class="form-control" rows="3" id="sel_descript"></textarea>
          </div>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn default" data-dismiss="modal">ปิด</button>
          <button name="save" type="submit" class="btn btn-success" id="submit" >บันทึก</button>
        </div>
      </div>
    </div>
  </div>
</form>


</body>
</html>
