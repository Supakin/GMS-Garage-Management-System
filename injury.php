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
      <i class="fas fa-trash-alt" style='font-size:65px;color:black'></i>
    </div>
    <div class="col-11">
      <h1>บันทึกอะไหล่ชำรุด</h1>
    </div>
  </div>
  <div class="row mt-5 mb-2">
    <h4>กรอกรายละเอียดอะไหล่ที่ชำหลุด</h4>
  </div>
  <form  action="insert.data.php" method="post">
    <input type="hidden" name="action" value="addinjury">
  <div class="row mt-2 mb-3">
    <div class="col-2">
      <label for="product">อะไหล่ : </label>
      <select class="form-control form-control-sm" name="product" required>
        <option value="">กรุณาเลือกอะไหล่</option>
        <?php
          $pro_sql = "SELECT * FROM PRODUCT ORDER BY PRO_ID ";
          $pro_query = mysql_query($pro_sql) or die(mysql_error());
          while ($row =  mysql_fetch_array($pro_query)){
         ?>
            <option value="<?php echo $row['PRO_ID'] ?>"><?php echo $row['PRO_ID']." --- ".$row['PRO_NAME'] ?></option>
        <?php
          }
        ?>
      </select>
    </div>
    <div class="col-1">
      <label for="amount">จำนวน : </label>
      <input class="form-control form-control-sm" type="number"  name="amount" >
    </div>
    <div class="col-3">
      <label for="rep_id">จากรหัสซ่อม : </label>
      <select class="form-control form-control-sm" name="rep_id" required>
        <option value="">กรุณาเลือกรหัสซ่อม</option>
        <?php
          $rep_sql = "SELECT * FROM (REPAIRSLIP NATURAL JOIN CARS) NATURAL JOIN CUSTOMER WHERE REP_REPAIRSTATUS='N' ORDER BY REP_ID ";
          $rep_query = mysql_query($rep_sql) or die(mysql_error());
          while ($row =  mysql_fetch_array($rep_query)){
         ?>
            <option value="<?php echo $row['REP_ID'] ?>"><?php echo $row['REP_ID']." --- ".$row['CUS_FNAME']." ".$row['CUS_LNAME']." --- ทะเบียนรถ : ".$row['CAR_LICENSE'] ?></option>
        <?php
          }
        ?>
      </select>
    </div>
    <div class="col-2">
      <label for="emp_id">ผู้พบ : </label>
      <select class="form-control form-control-sm" name="emp_id" required>
        <option value="">กรุณาเลือกผู้พบ</option>
        <?php
          $emp_sql = "SELECT * FROM EMPLOYEE WHERE EMP_STATUS ='Y' ORDER BY EMP_ID ";
          $emp_query = mysql_query($emp_sql) or die(mysql_error());
          while ($row =  mysql_fetch_array($emp_query)){
         ?>
            <option value="<?php echo $row['EMP_ID'] ?>"><?php echo $row['EMP_FNAME']." ".$row['EMP_LNAME'] ?></option>
        <?php
          }
        ?>
      </select>
    </div>
    <div class="col-3">
      <label for="inj_description">รายละเอียดการชำรุด : </label>
      <input type="text" name="inj_description" class="form-control form-control-sm" required>
    </div>

    <div class="col-1">
      <label for=""><small class="text-white">TEST</small></label>
      <button type="submit" name="save" class="btn btn-success btn-block shadow-sm btn-sm">บันทึก</button>
    </div>
  </div>
  </form>



  <small>
  <table class="table table-hover table-bordered table-sm" >
    <thead class="thead-dark">
      <tr align="center">
        <th>รหัสชำรุด</th>
        <th>วันที่</th>
        <th>รหัสอะไหล่</th>
        <th>อะไหล่</th>
        <th>จำนวน</th>
        <th>ค่าเสียหาย</th>
        <th>จากรหัสซ่อม</th>
        <th>ผู้พบ</th>
        <th>รายละเอียดความเสียหาย</th>
        <th>ลบ</th>
      </tr>
    </thead>
    <?php
    $sql = "SELECT * FROM (INJURY NATURAL JOIN EMPLOYEE) NATURAL JOIN PRODUCT ORDER BY INJ_ID";
    $resultsql = mysql_query($sql) or die (mysql_error());
    while($row = mysql_fetch_array($resultsql)) {
    ?>
      <tr>
        <td align="center" width="8%"> <?php  echo $row["INJ_ID"] ?> </td>
        <td align="center" width="8%"> <?php  echo $row["INJ_DATE"] ?> </td>
        <td align="center" width="8%"> <?php  echo $row["PRO_ID"] ?> </td>
        <td> <?php  echo $row["PRO_NAME"] ?> </td>
        <td align="center"> <?php  echo $row["INJ_AMOUNT"] ?> </td>
        <td align="center"> <?php  echo $row["INJ_COST"] ?> </td>
        <td align="center"> <?php  echo $row["REP_ID"] ?> </td>
        <td align="center"> <?php  echo $row["EMP_FNAME"]." ".$row['EMP_LNAME'] ?> </td>
        <td align="center"> <?php  echo $row["INJ_DESCRIPTION"] ?> </td>
        <th><button class="btn btn-danger btn-block shadow-sm btn-sm" data-toggle = "modal" data-target="#delInjury" data-id="<?php echo $row['INJ_ID'] ?>">ลบ</button></th>
      </tr>
    <?php
    }
    ?>
  </table>
  </small>
</div>

<!--delete injury-->
<form  method="post" action="delete.data.php">
  <div class="modal fade" id="delInjury">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header align-items-center">
          <i class='fas fa-wrench m-1' style='font-size:35px;color:green'></i>
          <h4 class="modal-title" align="center">ยืนยันการลบ</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <input type="hidden" name="action" value="delinjury">
          <div class="col mr-3 ml-3">
            <div class="row">
                <div class="form-group">
                  <label for="repid">รหัสชำรุด : </label>
                  <input  class ="form-control" type="text" name="inj_id" id="injid" value="" style="border:none; font-weight: bold; background-color: white;" readonly>
                </div>
            </div>

          </div>

        </div>

        <!-- Modal footer -->
        <div class="modal-footer justify-content-center">
          <button type="button" class="btn default" data-dismiss="modal">ปิด</button>
          <button name="save" type="submit" class="btn btn-success" id="submit" >บันทึก</button>
        </div>
      </div>
    </div>
  </div>
</form>


<script>
$(document).ready(function() {
	$('#delInjury').on('show.bs.modal', function (event) {
	  var button = $(event.relatedTarget);
	  var id= button.data('id');
	  var modal = $(this);
	  modal.find('#injid').val(id);
  });
});

</script>


</body>
</html>

<?php

  disconnect();
?>
