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

<style media="screen">
html {overflow-y: scroll;}

.tabs {
    list-style: none;
    margin: 0;
    padding: 0;
}

.tabs li {
    display: inline-block;
    padding: 15px 25px;
    background: none;
    text-transform: uppercase;
    cursor: pointer;
}

.tabs li.current {
    background: #e9e9e9;
}

.tab-contents {
    background: #e9e9e9;
    padding: 20px;
}

.tab-pane {
    display: none;
}

.tab-pane.current {
    display: block;
}
</style>
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
    <div class="col-4">
      <h1>พนักงาน</h1>
    </div>

    <div class="col-7 justify-content-end">
      <button type="button" class="btn btn-success  shadow-sm" data-toggle="modal" data-target="#addemployee">
        <i class='fas fa-user-plus' style='font-size:10px;color:white'></i>
        เพิ่มพนักงาน
      </button>
      <button type="button" class="btn btn-success shadow-sm" data-toggle="modal" data-target="#editemployee">
        <i class='fas fa-user-edit' style='font-size:10px;color:white'></i>
        แก้ไขพนักงาน</button>
      <button type="button" class="btn btn-success shadow-sm" data-toggle="modal" data-target="#addtakedayoff">
        <i class='fas fa-user-edit' style='font-size:10px;color:white'></i>
        ลางาน</button>
      <button type="button" class="btn btn-success shadow-sm" data-toggle="modal" data-target="#addsalary">
        <i class='fab fa-bitcoin' style='font-size:10px;color:white'></i>
        ออกเงินเดือน</button>

      <button type="button" class="btn btn-success shadow-sm" onclick='window.location.assign("main_employee_rolecall.php")'>
        <i class='fas fa-calendar-check' style='font-size:10px;color:white'></i>
        เช็คชื่อ</button>

    </div>
  </div>
  <div class="tab-example">
    <ul class="tabs" >
      <li class="tab-link current active" data-tab="menu1">พนักงาน</li>
      <li class="tab-link" data-tab="menu2">ประวัติการลา</li>
      <li class="tab-link" data-tab="menu3">ประวัติการออกเงินเดือน</li>
    </ul>

    <div class="tab-contents">
      <div id="menu1" class="tab-pane current"><br>
        <div class="card">
          <div class="card-body">
            <table class="table table-hover table-bordered table-sm">
              <thead class="thead-dark">
                <tr align="center">
                  <th width="8%">รหัสพนักงาน</th>
                  <th>ชื่อ</th>
                  <th>นามสกุล</th>
                  <th width="5%">เพศ</th>
                  <th width="10%">เบอร์โทรติดต่อ</th>
                  <th>ที่อยู่</th>
                  <th width="10%">วันเริ่มงาน</th>
                  <th>เงินเดือน</th>
                  <th width="5%">สถานะ</th>
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
                  <td align="center">
                    <?php
                      if($row['EMP_GENDER']=='M'){
                        echo "ชาย";
                      }else{
                        echo "หญิง";
                      }
                    ?>
                  </td>
                  <td align="center"> <?php  echo $row["EMP_TEL"] ?> </td>
                  <td align="center"> <?php  echo $row["EMP_ADDRESS"] ?> </td>
                  <td align="center"> <?php  echo $row["EMP_DATE_BEGINWORK"] ?> </td>
                  <td align="center"> <?php  echo $row["EMP_SALARY"] ?> </td>
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
      </div>

      <div id="menu2" class="tab-pane"><br>
        <div class="card">
          <div class="card-body">
            <table class="table table-hover table-bordered table-sm">
              <thead class="thead-dark">
                <tr align="center">
                  <th>รหัสลา</th>
                  <th>รหัสพนักงาน</th>
                  <th>ชื่อ</th>
                  <th>นามสกุล</th>
                  <th>วันเริ่มต้น</th>
                  <th>วันสิ้นสุด</th>
                  <th>หมายเหตุ</th>
                </tr>
              </thead>
              <?php
              $sql = "SELECT * FROM TAKEDAYOFF NATURAL JOIN EMPLOYEE";
              $sql_query = mysql_query($sql);
              while($row = mysql_fetch_array($sql_query)) {
              ?>
                <tr>
                  <td align="center"> <?php  echo $row["TAK_ID"] ?> </td>
                  <td align="center"> <?php  echo $row["EMP_ID"] ?> </td>
                  <td > <?php  echo $row["EMP_FNAME"] ?> </td>
                  <td > <?php  echo $row["EMP_LNAME"] ?> </td>
                  <td > <?php  echo $row["TAK_DATEBEGIN"] ?> </td>
                  <td > <?php  echo $row["TAK_DATEEND"] ?> </td>
                  <td > <?php  echo $row["TAK_DESCRIPT"] ?> </td>
                </tr>
              <?php
              }
              ?>
            </table>
          </div>
        </div>
      </div>

      <div id="menu3" class="tab-pane">
        <div class="card">
          <div class="card-body">
            <table class="table table-hover table-bordered table-sm">
              <thead class="thead-dark">
                <tr align="center">
                  <th>รหัสเงินเดือน</th>
                  <th>รหัสพนักงาน</th>
                  <th>ชื่อ</th>
                  <th>นามสกุล</th>
                  <th>เงินเดือน</th>
                  <th>หักเงิน</th>
                  <th>เงินสุทธิ</th>
                  <th>วันที่จ่าย</th>
                  <th>รอบการจ่าย</th>
                </tr>
              </thead>
              <?php
              $sql = "SELECT * FROM SALARY NATURAL JOIN EMPLOYEE";
              $sql_query = mysql_query($sql);
              while($row = mysql_fetch_array($sql_query)) {
              ?>
                <tr>
                  <td align="center"> <?php  echo $row["SAL_ID"] ?> </td>
                  <td align="center"> <?php  echo $row["EMP_ID"] ?> </td>
                  <td > <?php  echo $row["EMP_FNAME"] ?> </td>
                  <td > <?php  echo $row["EMP_LNAME"] ?> </td>
                  <td > <?php  echo $row["SAL_SALARY"] ?> </td>
                  <td > <?php  echo $row["SAL_FINE"] ?> </td>
                  <td > <?php  echo $row["SAL_NETSALARY"] ?> </td>
                  <td > <?php  echo $row["SAL_PAYDATE"] ?> </td>
                  <td > <?php  echo $row["SAL_PAYROUNDDATE"] ?> </td>
                </tr>
              <?php
              }
              ?>
            </table>
          </div>
        </div>
      </div>

    </div>
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
            <input name="emp_fname" type="text" class="form-control form-control-sm" id="emp_fname" required  autocomplete="off">
          </div>
          <div class="form-group">
            <label for="emp_lname">นามสกุล :</label>
            <input name="emp_lname" type="text" class="form-control form-control-sm" id="emp_lname" required  autocomplete="off">
          </div>
          <div class="form-group">
              <label for="emp_gender">เพศ :</label>
              <select class="form-control form-control-sm"  id="emp_gender" name="emp_gender" required >
                  <option value="">กรุณาเลือกเพศ</option>
                  <option value="M">ชาย</option>
                  <option value="F">หญิง</option>
              </select>
          </div>
          <div class="form-group">
            <label for="emp_tel">เบอร์โทรติดต่อ :</label>
            <input name="emp_tel" type="text" class="form-control form-control-sm"  id="emp_tel" required  autocomplete="off">
          </div>
          <div clas="form-group">
            <label for="emp_address">ที่อยู่ :</label>
            <input name="emp_address" type="text" class="form-control form-control-sm"  id="emp_address" required  autocomplete="off">
          </div>
          <div class="form-group">
            <label for="emp_date_beginwork">วันเริ่มงาน :</label>
            <div>
              <input class="form-control form-control-sm" type="date" name="emp_date_beginwork" id="emp_date_beginwork" required>
            </div>
          </div>
          <div class="form-group">
            <label for="emp_salary">เงินเดือน :</label>
            <input name="emp_salary" type="number" min="5000" max="999999" class="form-control form-control-sm" id="emp_salary" required  autocomplete="off">
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
            <select class="form-control"  id="emp_id" name="emp_id" required>
              <option value="">กรุณาเลือกพนักงานที่ต้องการแก้ไขข้อมูล</option>
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

<!--takedayoff-->
<form  method="post" action="insert.data.php">
  <div class="modal fade" id="addtakedayoff">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">ลางาน</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <input type="hidden" name="action" value="addtakedayoff">
          <div class="form-group">
            <label for="emp_id">รหัสพนักงาน :</label>
            <select class="form-control"  id="emp_id" name="emp_id" required>
              <option value="">กรุณาเลือกพนักงาน</option>
              <?php
                $sql = "SELECT EMP_ID,EMP_FNAME,EMP_LNAME FROM EMPLOYEE WHERE EMP_STATUS='Y' ORDER BY EMP_ID";
                $sql_query = mysql_query($sql) or die(mysql_error());

                while ($row = mysql_fetch_array($sql_query)){
              ?>
                  <option value="<?php echo $row['EMP_ID'] ?>"> <?php echo $row['EMP_ID']." --- ".$row['EMP_FNAME']."  ".$row['EMP_LNAME'] ?></option>

              <?php
                }
              ?>
            </select>
          </div>
          <div class="form-group">
            <label for="emp_id">วันเริ่มลา :</label>
            <input type="date" name="datebegin" class="form-control">
          </div>
          <div class="form-group">
            <label for="emp_id">วันสิ้นสุดการลา :</label>
            <input type="date" name="dateend" class="form-control">
          </div>
          <div class="form-group">
            <label for="emp_id">รายละเอียดการลา :</label>
            <input type="text" name="descript" class="form-control">
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

<!--addSalary-->
<form  method="post" action="insert.data.php">
  <div class="modal fade" id="addsalary">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">ออกเงินเดือน</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <?php
          $date_sql = "SELECT CURDATE(),MONTH(CURDATE()) AS month,YEAR(CURDATE()) AS year ";
          $date_query = mysql_query($date_sql);
          $datenow = mysql_fetch_array($date_query);

          $month1 = $datenow['month'];
          $year1 = $datenow['year'];
          $month2 = $datenow['month'];
          $year2 = $datenow['year'];
          if((int)$month1-1 == 0){
            $month1 = '12';
            $year1 = (int)$year1-1;
          }
          if(strlen($month1)<2){
            $month1 = '0'.$month1;
          }
          if(strlen($month2)<2){
            $month2 = '0'.$month2;
          }

          $datebefore = $year1."-".$month1."-23";
          $dateafter = $year2."-".$month2."-22";


        ?>
        <div class="modal-body">
          <input type="hidden" name="action" value="addsalary">
          <div class="row mt-1 mb-1">
            <div class="col-5">
              <label for="date1">ตั้งแต่</label>
              <input type="date" name="date1"  class="form-control" value="<?php echo $datebefore; ?>" readonly>
            </div>
            <div class="col-2 ">
              <label for="">ถึง</label>
            </div>
            <div class="col-5">
              <label for="dat2">สิ้นสุด</label>
              <input type="date" name="date2"  class="form-control" value="<?php echo $dateafter; ?>" readonly>
            </div>
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



<script>
$(function() {
    $('.tabs li').on('click', function() {
        var tabId = $(this).attr('data-tab');

        $('.tabs li').removeClass('current');
        $('.tab-pane').removeClass('current');

        $(this).addClass('current');
        $('#' + tabId).addClass('current');
    });
});


</script>


</body>
</html>

<?php
  disconnect();
 ?>
