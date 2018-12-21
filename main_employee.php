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
<div class= "container">
  <div class="row justify-content-center align-content-center">
    <button type="button" class="btn btn-info btn-block mt-2 shadow-sm" onClick = "window.location.replace('main.php')">
      <i class='fas fa-home' style='font-size:10px;color:white'></i>
      กลับหน้าหลัก
    </button>
  </div>
  <div class="row mt-3 mb-3 align-items-center">
    <div class="col-1">
      <i class="fas fa-user" style='font-size:65px;color:black'></i>
    </div>
    <div class="col-7">
      <h1>พนักงาน</h1>
    </div>

    <div class="col-4 justify-content-end">
      <button type="button" class="btn btn-success shadow-sm" onclick='location.replace("main_employee_rolecall.php")'>
        <i class='fas fa-calendar-check' style='font-size:10px;color:white'></i>
        เช็คชื่อ</button>
      <button type="button" class="btn btn-success shadow-sm" data-toggle="modal" data-target="#editemployee">
        <i class='fas fa-user-edit' style='font-size:10px;color:white'></i>
        แก้ไขพนักงาน</button>
      <button type="button" class="btn btn-success  shadow-sm" data-toggle="modal" data-target="#addemployee">
        <i class='fas fa-user-plus' style='font-size:10px;color:white'></i>
        เพิ่มพนักงาน
      </button>
    </div>
  </div>
  <div class="row">
  <table class="table table-hover table-bordered">
    <thead class="thead-dark">
      <tr align="center">
        <th>รหัสพนักงาน</th>
        <th>ชื่อ</th>
        <th>นามสกุล</th>
        <th>เบอร์โทรติดต่อ</th>
        <th>สถานะ</th>
      </tr>
    </thead>
    <?php
    $sql = "SELECT * FROM EMPLOYEE ORDER BY EMP_ID";
    $resultsql = mysql_query($sql) or die (mysql_error());

    while($row = mysql_fetch_array($resultsql)) {
    ?>
      <tr>
        <td align="center"> <?php  echo $row["EMP_ID"] ?> </td>
        <td > <?php  echo $row["EMP_FNAME"] ?> </td>
        <td > <?php  echo $row["EMP_LNAME"] ?> </td>
        <td align="center"> <?php  echo $row["EMP_TEL"] ?> </td>
        <td align="center">
          <?php
            if ($row["EMP_STATUS"]=='Y'){
              echo "<span class='badge badge-success'>";
              echo "ทำงาน";
              echo "</span>";
            }else if ($row["EMP_STATUS"]=='N'){
              echo "<span class='badge badge-danger'>";
              echo "ออกแล้ว";
              echo "</span>";
          } ?>
        </td>
      </tr>
    <?php
    }
    ?>
  </table>
  </div>

</div>

<!------------------------------------------------------------------------>
<!--addemployee-->
<form  method="post" action="insert.data.php" >
  <div class="modal fade" id="addemployee">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">เพิ่มพนักงาน</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <input type="hidden" name="action" value="addemployee">
          <div class="form-group">
            <label for="emp_id">รหัสพนักงาน :</label>
            <input name="emp_id" type="text" class="form-control" id="emp_id" readonly value="<?php
              $sql = "SELECT SUBSTR(MAX(EMP_ID),2) FROM EMPLOYEE";
              $sql_query = mysql_query($sql) or die(mysql_error());
              $emp_id = (int)mysql_result($sql_query,0,0);
              $emp_id += 1;
              $emp_id = str_pad($emp_id, 5, "0", STR_PAD_LEFT);
              $emp_id = "E".$emp_id;

              echo $emp_id  ?>">
          </div>
          <div class="form-group">
            <label for="emp_fname">ชื่อ :</label>
            <input name="emp_fname" type="text" class="form-control" id="emp_fname" required  autocomplete="off">
          </div>
          <div class="form-group">
            <label for="emp_lname">นามสกุล :</label>
            <input name="emp_lname" type="text" class="form-control" id="emp_lname" required  autocomplete="off">
          </div>
          <div class="form-group">
              <label for="emp_gender">เพศ :</label>
              <select class="form-control"  id="emp_gender" name="emp_gender" required >
                  <option >กรุณาเลือกเพศ</option>
                  <option value="M">ชาย</option>
                  <option value="F">หญิง</option>
              </select>
          </div>
          <div class="form-group">
            <label for="emp_tel">เบอร์โทรติดต่อ :</label>
            <input name="emp_tel" type="text" class="form-control" id="emp_tel" required  autocomplete="off">
          </div>
          <div clas="form-group">
            <label for="emp_address">ที่อยู่ :</label>
            <textarea name="emp_address" class="form-control" rows="2" id="emp_address" required></textarea>
          </div>
          <div class="form-group">
            <label for="emp_date_beginwork">วันเริ่มงาน :</label>
            <div>
              <input class="form-control" type="date" name="emp_date_beginwork" id="emp_date_beginwork" required>
            </div>
          </div>
          <div class="form-group">
            <label for="emp_salary">เงินเดือน :</label>
            <input name="emp_salary" type="number" min="5000" max="999999" class="form-control" id="emp_salary" required  autocomplete="off">
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

<!---------------------------------------------------------------------------->
<!--editEmployee_selectID-->
<form  method="post" action="editemployee.php">
  <div class="modal fade" id="editemployee">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">แก้ไขข้อมูลพนักงาน</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="form-group">
            <label for="emp_id">รหัสพนักงาน :</label>
            <select class="form-control"  id="emp_id" name="emp_id">
              <option>กรุณาเลือกพนักงานที่ต้องการแก้ไขข้อมูล</option>
              <?php
                $sql = "SELECT EMP_ID,EMP_FNAME,EMP_LNAME FROM EMPLOYEE ORDER BY EMP_ID";
                $sql_query = mysql_query($sql) or die(mysql_error());
                while ($row = mysql_fetch_array($sql_query)){
              ?>
                <option value="<?php echo $row['EMP_ID'] ?>"> <?php echo $row['EMP_ID']." --- ".$row['EMP_FNAME']."  ".$row['EMP_LNAME'] ?></option>

              <?php
                }
              ?>
            </select>
          </div>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn default" data-dismiss="modal">ปิด</button>
          <button name="save" type="submit" class="btn btn-success" id="submit" >ยืนยัน</button>
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
