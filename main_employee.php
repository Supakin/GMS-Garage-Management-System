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
<div class= "container">
  <div class="row">
    <div class="col-1">
      <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
    </div>
    <div class="col-7">
      <h3>พนักงานของเรา</h3>
    </div>
    <div class="col-4 justify-content-end">
      <button type="button" class="btn btn-success" onclick='location.replace("main_employee_rolecall.php")'>เช็คชื่อ</button>
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#editEmployee_selectID">แก้ไขข้อมูลพนักงาน</button>
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addEmployee">เพิ่มพนักงาน</button>
    </div>
  </div>
  <table class="table table-hover">
    <thead>
      <tr>
        <th>รหัสพนักงาน</th>
        <th>ชื่อพนักงาน</th>
        <th>เบอร์โทรติดต่อ</th>
        <th>สถานะ</th>
      </tr>
    </thead>
    <?php
      include('showEMPLOYEEtable.php');
    ?>
  </table>


</div>

<!------------------------------------------------------------------------>
<!--addEmployee-->
<form  method="post" action="addEMPLOYEE.php" >
  <div class="modal fade" id="addEmployee">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">เพิ่มพนักงานใหม่</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="form-group">
            <label for="emp_id">รหัสพนักงาน :</label>
            <input name="emp_id" type="text" class="form-control" id="emp_id" maxlength="6">
          </div>
          <div class="form-group">
            <label for="emp_fname">ชื่อ :</label>
            <input name="emp_fname" type="text" class="form-control" id="emp_fname">
          </div>
          <div class="form-group">
            <label for="emp_lname">นามสกุล :</label>
            <input name="emp_lname" type="text" class="form-control" id="emp_lname">
          </div>
          <div class="form-group">
            <div>
              <label for="emp_gender">เพศ :</label>
            </div>
            <div class ="row">
              <div class="col-1">
              </div>
              <div class="col-4 ">
                <input type="radio" name="emp_gender" class="form-check-input" value="M"> ชาย
              </div>
              <div class="col-4">
                <input type="radio" name="emp_gender" class="form-check-input" value="F"> หญิง<br>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="emp_tel">เบอร์โทรติดต่อ :</label>
            <input name="emp_tel" type="text" class="form-control" id="emp_tel">
          </div>
          <div clas="form-group">
            <label for="emp_address">ที่อยู่ :</label>
            <textarea name="emp_address" class="form-control" rows="2" id="emp_address"></textarea>
          </div>
          <div class="form-group">
            <label for="emp_date_beginwork">วันเริ่มงาน :</label>
            <div>
              <input class="form-group" type="date" name="emp_date_beginwork" id="emp_date_beginwork">
            </div>
          </div>
          <div class="form-group">
            <label for="emp_salary">เงินเดือน :</label>
            <input name="emp_salary" type="text" class="form-control" id="emp_salary">
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
<form  method="post" action="editEmployee.php">
  <div class="modal fade" id="editEmployee_selectID">
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
            <input name="emp_id" type="text" class="form-control" id="emp_id" maxlength="6">
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


<!---------------------------------------------------------------------------->
<!--Slide menu-->
<div id="mySidenav" class="sidenav" >
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="main.php">หน้าแรก</a>
  <a href="main_seller.php">คู่ค้าของเรา</a>
  <a href="main_product.php">สินค้าของเรา</a>
  <a href="main_employee.php">พนักงานของเรา</a>
</div>




</body>
</html>
