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
<div class="container">
  <div class="row justify-content-center align-content-center">
    <button type="button" class="btn btn-info btn-block mt-2 shadow-sm" onClick = "window.location.replace('main.php')">
      <i class='fas fa-home' style='font-size:10px;color:white'></i>
      กลับหน้าหลัก
    </button>
  </div>
  <div class="row mt-3 mb-5 align-items-center">
    <div class="col-1">
        <i class="fas fa-user-circle" style='font-size:65px;color:black'></i>
    </div>
    <div class="col-9">
      <h1>ลูกค้า</h1>
    </div>
    <div class="col-2">
      <button type="button" class="btn btn-success  shadow-sm" data-toggle="modal" data-target="#selcustomer">
        ดูเฉพาะรายคน
      </button>
    </div>
  </div>
  <div class="tab-example">
    <ul class="tabs" >
      <li class="tab-link current active" data-tab="menu1">ลูกค้า</li>
      <li class="tab-link" data-tab="menu2">รถของลูกค้า</li>
    </ul>

    <div class="tab-contents">
      <!--pepairing-->
      <div id="menu1" class="tab-pane current"><br>
        <div class="card">
          <div class="card-body">
            <table class="table table-hover table-bordered table-sm">
              <thead class="thead-dark">
                <tr align="center">
                  <th width="8%">รหัสลูกค้า</th>
                  <th>ชื่อ</th>
                  <th>นามสกุล</th>
                  <th width="10%">เบอร์โทรติดต่อ</th>
                  <th>ที่อยู่</th>
                  <th>จำนวนรถ</th>
                  <th>จำนวนครั้งที่เคยมาใช้บริการ</th>
                  <th>ยอดเงินชำระรวม</th>
                </tr>
              </thead>
              <?php
              $cus_sql = "SELECT * FROM CUSTOMER ORDER BY CUS_ID";
              $cus_query = mysql_query($cus_sql) or die (mysql_error());

              while($row = mysql_fetch_array($cus_query)) {
              ?>
                <tr>
                  <td align="center"> <?php  echo $row["CUS_ID"] ?> </td>
                  <td > <?php  echo $row["CUS_FNAME"] ?> </td>
                  <td > <?php  echo $row["CUS_LNAME"] ?> </td>
                  <td align="center"> <?php  echo $row["CUS_TEL"] ?> </td>
                  <td align="center"> <?php  echo $row["CUS_ADDRESS"] ?> </td>
                  <td align="center">
                    <?php
                      $ccar_sql = "SELECT COUNT(CAR_VIN) AS ccar FROM CARS WHERE CUS_ID = '".$row['CUS_ID']."'";
                      $ccar_query = mysql_query($ccar_sql);
                      $ccar = mysql_fetch_array($ccar_query);
                      echo $ccar['ccar'];
                    ?>
                  </td>
                  <td align="center">
                    <?php
                      $rep_sql = "SELECT COUNT(REP_ID) AS crep , SUM(REP_NETTOTALCOST) AS srep FROM REPAIRSLIP WHERE CUS_ID = '".$row['CUS_ID']."'";
                      $rep_query = mysql_query($rep_sql);
                      $rep = mysql_fetch_array($rep_query);
                      echo $rep['crep'];
                    ?>
                  </td>
                  <td align ="right"><?php echo $rep['srep']  ?> </td>
                </tr>
              <?php
              }
              ?>
            </table>
          </div>
        </div>
      </div>

      <!--ordered-->
      <div id="menu2" class="tab-pane"><br>
        <div class="card">
          <div class="card-body">
            <table class="table table-hover table-bordered table-sm">
              <thead class="thead-dark">
                <tr align="center">
                  <th width="8%">ทะเบียนรถ</th>
                  <th>จังหวัด</th>
                  <th>ยี่ห้อ</th>
                  <th>รุ่น</th>
                  <th>สี</th>
                  <th>เลขตัวถัง</th>
                  <th>หมายเลขเครื่องยนต์</th>
                  <th>เจ้าของ</th>
                  <th>จำนวนครั้งที่เคยใช้บริการ</th>
                </tr>
              </thead>
              <?php
              $cus_sql = "SELECT * FROM CARS NATURAL JOIN CUSTOMER ORDER BY CAR_PROVINCE";
              $cus_query = mysql_query($cus_sql) or die (mysql_error());

              while($row = mysql_fetch_array($cus_query)) {
              ?>
                <tr>
                  <td align="center"> <?php  echo $row["CAR_LICENSE"] ?> </td>
                  <td align="center"> <?php  echo $row["CAR_PROVINCE"] ?> </td>
                  <td align="center"> <?php  echo $row["CAR_BRAND"] ?> </td>
                  <td align="center"> <?php  echo $row["CAR_MODEL"] ?> </td>
                  <td align="center"> <?php  echo $row["CAR_COLOR"] ?> </td>
                  <td align="center"> <?php  echo $row["CAR_VIN"] ?> </td>
                  <td align="center"> <?php  echo $row["CAR_ENGINE_ID"] ?> </td>
                  <td align="center"> <?php  echo $row["CUS_FNAME"]." ".$row['CUS_LNAME'] ?> </td>
                  <td align="center">
                    <?php
                      $rep_sql = "SELECT COUNT(REP_ID) AS crep , SUM(REP_NETTOTALCOST) AS srep FROM REPAIRSLIP WHERE CAR_VIN = '".$row['CAR_VIN']."'";
                      $rep_query = mysql_query($rep_sql);
                      $rep = mysql_fetch_array($rep_query);
                      echo $rep['crep'];
                    ?>
                  </td>
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

<!--select customer-->
<form  method="post" action="selectcustomer.php">
  <div class="modal fade" id="selcustomer">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">ดูข้อมูลลูกค้า</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="form-group">
            <label for="emp_id">รหัสลูกค้า :</label>
            <select class="form-control"  id="cus_id" name="cus_id" required>
              <option value="">กรุณาเลือกลูกค้าที่ต้องการดูข้อมูล</option>
              <?php
                $sql = "SELECT CUS_ID,CUS_FNAME,CUS_LNAME FROM CUSTOMER ORDER BY CUS_ID";
                $sql_query = mysql_query($sql) or die(mysql_error());
                while ($row = mysql_fetch_array($sql_query)){
              ?>
                <option value="<?php echo $row['CUS_ID'] ?>"> <?php echo $row['CUS_ID']." --- ".$row['CUS_FNAME']."  ".$row['CUS_LNAME'] ?></option>

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
