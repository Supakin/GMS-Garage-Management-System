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
<div class="container">
  <div class="row justify-content-center align-content-center">
    <button type="button" class="btn btn-info btn-block mt-2 shadow-sm" onClick = "window.history.go(-1)">
      <i class='fas fa-home' style='font-size:10px;color:white'></i>
      กลับก่อนหน้า
    </button>
  </div>
  <div class="row mt-3 mb-3 align-items-center">
    <div class="col-1">
        <i class="fas fa-wrench" style='font-size:65px;color:black'></i>
    </div>
    <div class="col-8">
      <h1>บริการซ่อม</h1>
    </div>
    <div class="col-3">
      <button type="button" class="btn btn-success  m-1" data-toggle="modal" data-target="#addservice">
        <i class='fas fa-plus' style='font-size:10px;color:white'></i>
        เพิ่มบริการ
      </button>
      <button type="button" class="btn btn-success  m-1" data-toggle="modal" data-target="#editservice">
        <i class='fas fa-plus' style='font-size:10px;color:white'></i>
        แก้ไขบริการ
      </button>
    </div>
  </div>
  <div class="row">
    <table class="table table-hover table-bordered table-sm" >
      <thead class="thead-dark">
        <tr align="center">
          <th width="15%">รหัส</th>
          <th>ชื่อบริการ</th>
          <th width="30%">ราคาค่าช่าง</th>
        </tr>
      </thead>
    <?php
      $sql = "SELECT * FROM SERVICE ORDER BY SER_ID";
      $resultsql = mysql_query($sql) or die (mysql_error());

      while($row = mysql_fetch_array($resultsql)) {
    ?>
      <tr>
        <td align="center"> <?php  echo $row["SER_ID"] ?> </td>
        <td > <?php  echo $row["SER_NAME"] ?> </td>
        <td align="center"> <?php  echo $row["SER_BEGINCOST"] ?> </td>
      </tr>
    <?php
      }
    ?>
    </table>
  </div>
</div>

<!--addservicce-->
<form  method="post" action="insert.data.php">
  <div class="modal fade" id="addservice">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">สร้างบริการ</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <input type="hidden" name="action" value="addservice">
          <?php
            $sql = "SELECT SUBSTR(MAX(SER_ID),4) FROM SERVICE";
            $sql_query = mysql_query($sql) or die(mysql_error());
            $ser_id = (int)mysql_result($sql_query,0,0);
            $ser_id += 1;
            $ser_id = str_pad($ser_id, 7, "0", STR_PAD_LEFT);
            $ser_id = "SER".$ser_id;
          ?>
          <div class="form-group">
            <label for="ser_id">รหัสบริการ :</label>
            <input type="text" name="ser_id" class="form-control" value="<?php echo $ser_id ?>" readonly>
          </div>
          <div class="form-group">
            <label for="ser_name">ชื่อบริการ :</label>
            <input type="text" name="ser_name" class="form-control" required autocomplete="off">
          </div>
          <div class="form-group">
            <label for="ser_begincost">ราคาเริ่มต้น : </label>
            <input type="number" min="0" max="999999" name="ser_begincost" class="form-control" required autocomplete="off">
          </div>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn default" data-dismiss="modal">ปิด</button>
          <button name="save" type="submit" class="btn btn-success" id="submit" >เลือก</button>
        </div>
      </div>
    </div>
  </div>
</div>
</form>

<!--editservicce-->
<form  method="post" action="editservice.php">
  <div class="modal fade" id="editservice">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">แก้ไขบริการ</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="form-group">
            <label for="sel_id">รหัสบริการ :</label>
            <select class="form-control"  id="ser_id" name="ser_id" required>
              <option value="">กรุณาเลือกรหัสบริการ</option>
              <?php
                $sql = "SELECT SER_ID,SER_NAME FROM SERVICE ORDER BY SER_ID";
                $sql_query = mysql_query($sql) or die(mysql_error());
                while ($row = mysql_fetch_array($sql_query)){
              ?>
                <option value="<?php echo $row['SER_ID'] ?>"> <?php echo $row['SER_ID']." --- ".$row['SER_NAME'] ?></option>

              <?php
                }
              ?>
            </select>
          </div>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn default" data-dismiss="modal">ปิด</button>
          <button name="save" type="submit" class="btn btn-success" id="submit" >เลือก</button>
        </div>
      </div>
    </div>
  </div>
</div>
</form>




</body>
</html>
<?php
  disconnect();
?>
