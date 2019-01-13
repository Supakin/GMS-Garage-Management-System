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
  <div class="row mt-3 mb-3 align-items-center">
    <div class="col-1">
        <i class="fas fa-wrench" style='font-size:65px;color:black'></i>
    </div>
    <div class="col-9">
      <h1>บริการซ่อม</h1>
    </div>
    <div class="col-2">
      <button type="button" class="btn btn-info btn-block mt-2 shadow-sm" onClick = "window.location.replace('service.php')">
        จัดการบริการ
      </button>
    </div>
  </div>
  <div class="row mt-3 mb-3 justify-content-center" >
    <div class="col-1.5">
      <button type="button" class="btn btn-success  m-1" onClick = "window.location.replace('repairslip.newcus.php')">
        <i class='fas fa-plus' style='font-size:10px;color:white'></i>
        สำหรับลูกค้าใหม่
      </button>
    </div>
    <div class="col-1.5">
      <button type="button" class="btn btn-success  m-1" onClick = "window.location.replace('repairslip.oldcus.php')">
        <i class='fas fa-plus' style='font-size:10px;color:white'></i>
        สำหรับลูกค้าที่เคยใช้บริการ
      </button>
    </div>
  </div>
  <div class="tab-example">
    <ul class="tabs" >
      <li class="tab-link current active" data-tab="menu1">การซ่อมที่กำลังดำเนินการ</li>
      <li class="tab-link" data-tab="menu2">การซ่อมที่เรียบร้อยแล้ว</li>
    </ul>

    <div class="tab-contents">
      <!--pepairing-->
      <div id="menu1" class="tab-pane current"><br>
        <div id="accordion1">
        <?php
          $sql = "SELECT * FROM ((REPAIRSLIP NATURAL JOIN CUSTOMER) NATURAL JOIN CARS) NATURAL JOIN EMPLOYEE WHERE REP_REPAIRSTATUS = 'N' OR REP_PAYMENTSTATUS='N' ORDER BY REP_ID ";
          $sql_query = mysql_query($sql);
          while($row = mysql_fetch_array($sql_query)){
        ?>
          <div class="card">
            <div class="card-header bg-transparent">
              <div class="row">
                <div class="col-4">
                  <a class="card-link" data-toggle="collapse" href="#<?php echo "show".$row['REP_ID']."repairslip";?>">
                    <center><?php echo "<b>เลขที่ใบซ่อม : ".$row['REP_ID']."</b>";?></center>
                  </a>
                </div>
                <div class="col-3">
                  <?php echo "ลูกค้า : <b>".$row['CUS_FNAME']."  ".$row['CUS_LNAME']."</b>" ?>
                </div>
                <div class="col-3">
                  <?php echo "ทะเบียนรถ : <b>".$row['CAR_LICENSE']."  ".$row['CAR_PROVINCE']."</b>" ?>
                </div>
                <div class="col-2">
                  <?php
                  if ($row["REP_PAYMENTSTATUS"]=='Y' && $row['REP_REPAIRSTATUS']=='Y' ){
                    echo "<span class='badge badge-success '>";
                    echo "เรียบร้อย";
                    echo "</span>";
                  }else{
                    echo "<span class='badge badge-danger'>";
                    echo "ยังไม่เรียบร้อย";
                    echo "</span>";
                  }
                  ?>
                </div>
              </div>
            </div>

            <div id="<?php echo "show".$row['REP_ID']."repairslip"; ?>" class="collapse" data-parent="#accordion1">
              <div class="card-body">
                <div class="row mt-3 mb-3 justify-content-end">
                  <button class="btn btn-success m-1" data-toggle = "modal" data-target="#cfPayment" data-id="<?php echo $row['REP_ID'] ?>" data-fname="<?php echo $row['CUS_FNAME'] ?>" data-lname="<?php echo $row['CUS_LNAME'] ?>"  data-car="<?php echo $row['CAR_LICENSE'] ?>" data-province="<?php echo $row['CAR_PROVINCE'] ?>" data-ntotalcost="<?php echo $row['REP_NETTOTALCOST'] ?>">
                    ยืนยันการชำระเงิน
                  </button>
                </div>
                <div class="row mt-3 mb-1">
                  <div class="col-8">
                    <label><h5>ข้อมูลลูกค้า</h5></label>
                  </div>
                  <div class="col-4">
                    <label><h5>ข้อมูลรับเข้ารับรถ</h5></label>
                  </div>
                </div>
                <div class="row m-1">
                  <div class="col-8">
                    <div class="row">
                      <div class="col-3">
                        <label for="cus_id"><small>หมายเลขบัตรประชาชน</small></label><br>
                        <b class="text-primary"><?php echo $row['CUS_ID'] ?></b>
                      </div>
                      <div class="col-4">
                        <label for="cus_fname"><small>ชื่อ</small></label><br>
                        <b class="text-primary"><?php echo $row['CUS_FNAME'] ?></b>
                      </div>
                      <div class="col-4">
                        <label for="cus_lname"><small>นามสกุล</small></label><br>
                        <b class="text-primary"><?php echo $row['CUS_LNAME'] ?></b>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-3">
                        <label for="cus_tel"><small>เบอร์โทรติดต่อ</small></label><br>
                        <b class="text-primary"><?php echo $row['CUS_TEL'] ?></b>
                      </div>
                      <div class="col">
                        <label for="cus_address"><small>ที่อยู่</small></label><br>
                        <b class="text-primary"><?php echo $row['CUS_ADDRESS'] ?></b>
                      </div>
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="row m-1">
                      <div class="col">
                        <label for="date"><small>วันแจ้งซ่อม</small></label> <br>
                        <b class="text-primary"><?php echo $row['REP_DATE'] ?></b>
                      </div>
                    </div>
                    <div class="row m-1">
                      <div class="col">
                        <label for="getdate"><small>วันรับรถ</small></label> <br>
                        <b class="text-primary"><?php echo $row['REP_DATE_GETCAR'] ?></b>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row mt-2 mb-1">
                  <div class="col">
                    <label><h5>ข้อมูลรถของลูกค้า</h5></label>
                  </div>
                </div>
                <div class="row m-1">
                  <div class="col-2">
                    <label for="car_license"><small>ทะเบียนรถ</small></label><br>
                    <b class="text-primary"><?php echo $row['CAR_LICENSE'] ?></b>
                  </div>
                  <div class="col-2">
                    <label for="car_province"><small>จังหวัด</small></label><br>
                    <b class="text-primary"><?php echo $row['CAR_PROVINCE'] ?></b>
                  </div>
                  <div class="col-2">
                    <label for="car_brand"><small>ยี่ห้อ</small></label><br>
                    <b class="text-primary"><?php echo $row['CAR_BRAND'] ?></b>
                  </div>
                  <div class="col-2">
                    <label for="car_model"><small>รุ่น</small></label><br>
                    <b class="text-primary"><?php echo $row['CAR_MODEL'] ?></b>
                  </div>
                  <div class="col-2">
                    <label for="car_color"><small>สี</small></label><br>
                    <b class="text-primary"><?php echo $row['CAR_COLOR'] ?></b>
                  </div>
                </div>
                <div class="row m-1">
                  <div class="col-3">
                    <label for="car_engine"><small>หมายเลขเครื่องยนต์</small></label><br>
                    <b class="text-primary"><?php echo $row['CAR_ENGINE_ID'] ?></b>
                  </div>
                  <div class="col-3">
                    <label for="car_vin"><small>หมายเลขตัวถัง</small></label><br>
                    <b class="text-primary"><?php echo $row['CAR_VIN'] ?></b>
                  </div>
                  <div class="col-3">
                    <label for="rep_kilomater"><small>เลขกิโล</small></label><br>
                    <b class="text-primary"><?php echo $row['REP_KILOMATER'] ?></b>
                  </div>
                </div>
                <div class="row mt-2 mb-1 ">
                  <div class="col">
                    <label><h5>ข้อมูลบริการ</h5></label>
                  </div>
                </div>
                <div class="row m-1">
                  <div class="col-8">
                    <label for="rep_detail"><small>รายละเอียดความเสียหาย</small></label>
                  </div>
                  <div class="col-4">
                    <label for="empleader"><small>ช่างควบคุมการซ่อม</small></label>
                  </div>
                </div>
                <div class="row m-1">
                  <div class="col-8">
                    <b class="text-primary"><?php echo $row['REP_DETAIL'] ?></b>
                  </div>
                  <div class="col-4">
                    <b class="text-primary"><?php echo $row['EMP_FNAME']."   ".$row['EMP_LNAME'] ?></b>
                  </div>
                </div>
                <div class="row m-2 justify-content-center">
                  <div class="col">
                    <h5>บริการ/อะไหล่</h5>
                  </div>
                </div>
                <div class="row">
                  <div class="col-6">
                    <table class="table table-bordered table-sm">
                      <thead>
                        <tr align="center">
                          <th width="5%">ลำดับ</th>
                          <th>รหัส</th>
                          <th width="35%">บริการ</th>
                          <th width= "5%">จำนวน</th>
                          <th width= "10%">ราคา</th>
                          <th width="20%">ผู้ซ่อม</th>
                        </tr>
                      </thead>
                      <?php
                        $rep_id = $row['REP_ID'];
                        $sqlt1 = "SELECT *  FROM (EMPLOYEE NATURAL JOIN SERVICE_DETAIL) NATURAL JOIN SERVICE  WHERE REP_ID = $rep_id";
                        $sqlt1_query = mysql_query($sqlt1) or die(mysql_error());
                        $i = 1;
                        while($row2 = mysql_fetch_array($sqlt1_query)){
                      ?>
                          <tr>
                            <td align="center"><?php echo $i+1; ?></td>
                            <td align="center"><?php echo $row2['SER_ID'] ?></td>
                            <td><?php echo $row2['SER_NAME'] ?></td>
                            <td align="center"<?php echo $row2['SERD_AMOUNT'] ?></td>
                            <td align="center"><?php echo $row2['SERD_COST'] ?></td>
                            <td><?php echo $row2['EMP_FNAME']."  ".$row2['EMP_LNAME'] ?></td>
                          </tr>
                      <?php
                      $i++;
                      }
                      ?>
                    </table>
                  </div>
                  <div class="col-6">
                    <table class="table table-bordered table-sm" id="myTable">
                      <thead>
                        <tr align="center">
                          <th width="5%">ลำดับ</th>
                          <th>รหัส</th>
                          <th width="30%">อะไหล่</th>
                          <th width="10%">ราคาต่อชิ้น</th>
                          <th width= "5%">จำนวน</th>
                          <th width="10%">ราคารวม</th>
                        </tr>
                      </thead>
                      <?php
                        $sqlt2 = "SELECT * FROM REQUISITION NATURAL JOIN PRODUCT WHERE REP_ID = $rep_id";
                        $sqlt2_query = mysql_query($sqlt2) or die(mysql_error());
                        $j=1;
                        while($row2 = mysql_fetch_array($sqlt2_query)){
                      ?>
                          <tr>
                            <td align="center"><?php echo $i+1; ?></td>
                            <td align="center"><?php echo $row2['PRO_ID'] ?></td>
                            <td><?php echo $row2['PRO_NAME'] ?></td>
                            <td align="center"<?php echo $row2['REQ_AMOUNT'] ?></td>
                            <td align="center"><?php echo $row2['REQ_TOTALPRICE'] ?></td>
                          </tr>

                      <?php
                        $j++;
                        }
                      ?>
                    </table>
                  </div>
                </div>

                <div class="row mt-2  justify-content-end">
                  <div class="col-5">
                    <div class="row">
                      <div class="col-4">
                        <small>จำนวนรายการบริการ</small>
                      </div>
                      <div class="col-3 text-right">
                        <b class="text-primary"><?php echo $i ?></b>
                      </div>
                      <div class="col-4">
                        <small>รายการ</small>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-4">
                        <small>รวมค่าบริการ</small>
                      </div>
                      <div class="col-3 text-right">
                        <?php
                          $ss_sql = "SELECT SUM(SERD_COST) FROM SERVICE_DETAIL WHERE REP_ID = $rep_id";
                          $ss_query  = mysql_query($ss_sql);
                          $sresult = mysql_fetch_array($ss_query);
                         ?>
                        <b class="text-primary"><?php echo $sresult['SUM(SERD_COST)'] ?></b>
                      </div>
                      <div class="col-4">
                        <small>บาท</small>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-4">
                        <small>จำนวนรายการอะไหล่</small>
                      </div>
                      <div class="col-3 text-right">
                        <b class="text-primary"><?php echo $j ?></b>
                      </div>
                      <div class="col-4">
                        <small>รายการ</small>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-4">
                        <small>รวมค่าอะไหล่</small>
                      </div>
                      <div class="col-3 text-right">
                        <?php
                          $sr_sql = "SELECT SUM(REQ_TOTALPRICE) FROM REQUISITION WHERE REP_ID = $rep_id";
                          $sr_query  = mysql_query($sr_sql);
                          $srresult = mysql_fetch_array($sr_query);
                        ?>
                        <b class="text-primary"><?php echo  $srresult['SUM(REQ_TOTALPRICE)']  ?></b>
                      </div>
                      <div class="col-4">
                        <small>บาท</small>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-4">
                        <small>รวมค่าใช้จ่าย</small>
                      </div>
                      <div class="col-3 text-right">
                        <b class="text-primary"><?php echo $row['REP_TOTALCOST'] ?></b>
                      </div>
                      <div class="col-4">
                        <small>บาท</small>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-4">
                        <small>ภาษีมูลค่าเพิ่ม</small>
                      </div>
                      <div class="col-3 text-right">
                        <b class="text-primary"><?php echo "7"; ?></b>
                      </div>
                      <div class="col-4">
                        <small>%</small>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-4 ">
                        <small>รวมค่าใช้จ่ายสุทธิ</small>
                      </div>
                      <div class="col-3 text-right">
                        <h5 class="text-primary">
                          <b>
                          <?php echo $row['REP_NETTOTALCOST'] ?>
                          </b>
                        </h5>
                      </div>
                      <div class="col-4">
                        <small>บาท</small>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <?php
            }
          ?>

        </div>
      </div>

      <!--ordered-->
      <div id="menu2" class="tab-pane"><br>
        <div id="accordion2">
        <?php
          $sql = "SELECT * FROM ((REPAIRSLIP NATURAL JOIN CUSTOMER) NATURAL JOIN CARS) NATURAL JOIN EMPLOYEE WHERE REP_REPAIRSTATUS = 'Y' AND REP_PAYMENTSTATUS='Y' ORDER BY REP_ID ";
          $sql_query = mysql_query($sql);
          while($row = mysql_fetch_array($sql_query)){
        ?>
          <div class="card">
            <div class="card-header bg-transparent">
              <div class="row">
                <div class="col-4">
                  <a class="card-link" data-toggle="collapse" href="#<?php echo "show".$row['REP_ID']."repairsliped";?>">
                    <center><?php echo "<b>เลขที่ใบซ่อม : ".$row['REP_ID']."</b>";?></center>
                  </a>
                </div>
                <div class="col-6">
                  <?php echo "ลูกค้า : <b>".$row['CUS_FNAME']."  ".$row['CUS_LNAME']."</b>" ?>
                </div>
                <div class="col-2">
                  <?php
                  if ($row["REP_PAYMENTSTATUS"]=='Y' && $row['REP_REPAIRSTATUS']=='Y' ){
                    echo "<span class='badge badge-success '>";
                    echo "เรียบร้อย";
                    echo "</span>";
                  }else{
                    echo "<span class='badge badge-danger'>";
                    echo "ยังไม่เรียบร้อย";
                    echo "</span>";
                  }
                  ?>
                </div>
              </div>
            </div>

            <div id="<?php echo "show".$row['REP_ID']."repairsliped"; ?>" class="collapse" data-parent="#accordion2">
              <div class="card-body">
                <div class="row mt-3 mb-1">
                  <div class="col-8">
                    <label><h5>ข้อมูลลูกค้า</h5></label>
                  </div>
                  <div class="col-4">
                    <label><h5>ข้อมูลรับเข้ารับรถ</h5></label>
                  </div>
                </div>
                <div class="row m-1">
                  <div class="col-8">
                    <div class="row">
                      <div class="col-3">
                        <label for="cus_id"><small>หมายเลขบัตรประชาชน</small></label><br>
                        <b class="text-primary"><?php echo $row['CUS_ID'] ?></b>
                      </div>
                      <div class="col-4">
                        <label for="cus_fname"><small>ชื่อ</small></label><br>
                        <b class="text-primary"><?php echo $row['CUS_FNAME'] ?></b>
                      </div>
                      <div class="col-4">
                        <label for="cus_lname"><small>นามสกุล</small></label><br>
                        <b class="text-primary"><?php echo $row['CUS_LNAME'] ?></b>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-3">
                        <label for="cus_tel"><small>เบอร์โทรติดต่อ</small></label><br>
                        <b class="text-primary"><?php echo $row['CUS_TEL'] ?></b>
                      </div>
                      <div class="col">
                        <label for="cus_address"><small>ที่อยู่</small></label><br>
                        <b class="text-primary"><?php echo $row['CUS_ADDRESS'] ?></b>
                      </div>
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="row m-1">
                      <div class="col">
                        <label for="date"><small>วันแจ้งซ่อม</small></label> <br>
                        <b class="text-primary"><?php echo $row['REP_DATE'] ?></b>
                      </div>
                    </div>
                    <div class="row m-1">
                      <div class="col">
                        <label for="getdate"><small>วันรับรถ</small></label> <br>
                        <b class="text-primary"><?php echo $row['REP_DATE_GETCAR'] ?></b>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row mt-2 mb-1">
                  <div class="col">
                    <label><h5>ข้อมูลรถของลูกค้า</h5></label>
                  </div>
                </div>
                <div class="row m-1">
                  <div class="col-2">
                    <label for="car_license"><small>ทะเบียนรถ</small></label><br>
                    <b class="text-primary"><?php echo $row['CAR_LICENSE'] ?></b>
                  </div>
                  <div class="col-2">
                    <label for="car_province"><small>จังหวัด</small></label><br>
                    <b class="text-primary"><?php echo $row['CAR_PROVINCE'] ?></b>
                  </div>
                  <div class="col-2">
                    <label for="car_brand"><small>ยี่ห้อ</small></label><br>
                    <b class="text-primary"><?php echo $row['CAR_BRAND'] ?></b>
                  </div>
                  <div class="col-2">
                    <label for="car_model"><small>รุ่น</small></label><br>
                    <b class="text-primary"><?php echo $row['CAR_MODEL'] ?></b>
                  </div>
                  <div class="col-2">
                    <label for="car_color"><small>สี</small></label><br>
                    <b class="text-primary"><?php echo $row['CAR_COLOR'] ?></b>
                  </div>
                </div>
                <div class="row m-1">
                  <div class="col-3">
                    <label for="car_engine"><small>หมายเลขเครื่องยนต์</small></label><br>
                    <b class="text-primary"><?php echo $row['CAR_ENGINE_ID'] ?></b>
                  </div>
                  <div class="col-3">
                    <label for="car_vin"><small>หมายเลขตัวถัง</small></label><br>
                    <b class="text-primary"><?php echo $row['CAR_VIN'] ?></b>
                  </div>
                  <div class="col-3">
                    <label for="rep_kilomater"><small>เลขกิโล</small></label><br>
                    <b class="text-primary"><?php echo $row['REP_KILOMATER'] ?></b>
                  </div>
                </div>
                <div class="row mt-2 mb-1 ">
                  <div class="col">
                    <label><h5>ข้อมูลบริการ</h5></label>
                  </div>
                </div>
                <div class="row m-1">
                  <div class="col-8">
                    <label for="rep_detail"><small>รายละเอียดความเสียหาย</small></label>
                  </div>
                  <div class="col-4">
                    <label for="empleader"><small>ช่างควบคุมการซ่อม</small></label>
                  </div>
                </div>
                <div class="row m-1">
                  <div class="col-8">
                    <b class="text-primary"><?php echo $row['REP_DETAIL'] ?></b>
                  </div>
                  <div class="col-4">
                    <b class="text-primary"><?php echo $row['EMP_FNAME']."   ".$row['EMP_LNAME'] ?></b>
                  </div>
                </div>
                <div class="row m-2 justify-content-center">
                  <div class="col">
                    <h5>บริการ/อะไหล่</h5>
                  </div>
                </div>
                <div class="row">
                  <div class="col-6">
                    <table class="table table-bordered table-sm">
                      <thead>
                        <tr align="center">
                          <th width="5%">ลำดับ</th>
                          <th>รหัส</th>
                          <th width="35%">บริการ</th>
                          <th width= "5%">จำนวน</th>
                          <th width= "10%">ราคา</th>
                          <th width="20%">ผู้ซ่อม</th>
                        </tr>
                      </thead>
                      <?php
                        $rep_id = $row['REP_ID'];
                        $sqlt1 = "SELECT *  FROM (EMPLOYEE NATURAL JOIN SERVICE_DETAIL) NATURAL JOIN SERVICE  WHERE REP_ID = $rep_id";
                        $sqlt1_query = mysql_query($sqlt1) or die(mysql_error());
                        $i = 1;
                        while($row2 = mysql_fetch_array($sqlt1_query)){
                      ?>
                          <tr>
                            <td align="center"><?php echo $i+1; ?></td>
                            <td align="center"><?php echo $row2['SER_ID'] ?></td>
                            <td><?php echo $row2['SER_NAME'] ?></td>
                            <td align="center"<?php echo $row2['SERD_AMOUNT'] ?></td>
                            <td align="center"><?php echo $row2['SERD_COST'] ?></td>
                            <td><?php echo $row2['EMP_FNAME']."  ".$row2['EMP_LNAME'] ?></td>
                          </tr>
                      <?php
                      $i++;
                      }
                      ?>
                    </table>
                  </div>
                  <div class="col-6">
                    <table class="table table-bordered table-sm" id="myTable">
                      <thead>
                        <tr align="center">
                          <th width="5%">ลำดับ</th>
                          <th>รหัส</th>
                          <th width="30%">อะไหล่</th>
                          <th width="10%">ราคาต่อชิ้น</th>
                          <th width= "5%">จำนวน</th>
                          <th width="10%">ราคารวม</th>
                        </tr>
                      </thead>
                      <?php
                        $sqlt2 = "SELECT * FROM REQUISITION NATURAL JOIN PRODUCT WHERE REP_ID = $rep_id";
                        $sqlt2_query = mysql_query($sqlt2) or die(mysql_error());
                        $j=1;
                        while($row2 = mysql_fetch_array($sqlt2_query)){
                      ?>
                          <tr>
                            <td align="center"><?php echo $i+1; ?></td>
                            <td align="center"><?php echo $row2['PRO_ID'] ?></td>
                            <td><?php echo $row2['PRO_NAME'] ?></td>
                            <td align="center"<?php echo $row2['REQ_AMOUNT'] ?></td>
                            <td align="center"><?php echo $row2['REQ_TOTALPRICE'] ?></td>
                          </tr>

                      <?php
                        $j++;
                        }
                      ?>
                    </table>
                  </div>
                </div>

                <div class="row mt-2  justify-content-end">
                  <div class="col-5">
                    <div class="row">
                      <div class="col-4">
                        <small>จำนวนรายการบริการ</small>
                      </div>
                      <div class="col-3 text-right">
                        <b class="text-primary"><?php echo $i ?></b>
                      </div>
                      <div class="col-4">
                        <small>รายการ</small>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-4">
                        <small>รวมค่าบริการ</small>
                      </div>
                      <div class="col-3 text-right">
                        <?php
                          $ss_sql = "SELECT SUM(SERD_COST) FROM SERVICE_DETAIL WHERE REP_ID = $rep_id";
                          $ss_query  = mysql_query($ss_sql);
                          $sresult = mysql_fetch_array($ss_query);
                         ?>
                        <b class="text-primary"><?php echo $sresult['SUM(SERD_COST)'] ?></b>
                      </div>
                      <div class="col-4">
                        <small>บาท</small>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-4">
                        <small>จำนวนรายการอะไหล่</small>
                      </div>
                      <div class="col-3 text-right">
                        <b class="text-primary"><?php echo $j ?></b>
                      </div>
                      <div class="col-4">
                        <small>รายการ</small>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-4">
                        <small>รวมค่าอะไหล่</small>
                      </div>
                      <div class="col-3 text-right">
                        <?php
                          $sr_sql = "SELECT SUM(REQ_TOTALPRICE) FROM REQUISITION WHERE REP_ID = $rep_id";
                          $sr_query  = mysql_query($sr_sql);
                          $srresult = mysql_fetch_array($sr_query);
                        ?>
                        <b class="text-primary"><?php echo  $srresult['SUM(REQ_TOTALPRICE)']  ?></b>
                      </div>
                      <div class="col-4">
                        <small>บาท</small>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-4">
                        <small>รวมค่าใช้จ่าย</small>
                      </div>
                      <div class="col-3 text-right">
                        <b class="text-primary"><?php echo $row['REP_TOTALCOST'] ?></b>
                      </div>
                      <div class="col-4">
                        <small>บาท</small>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-4">
                        <small>ภาษีมูลค่าเพิ่ม</small>
                      </div>
                      <div class="col-3 text-right">
                        <b class="text-primary"><?php echo "7"; ?></b>
                      </div>
                      <div class="col-4">
                        <small>%</small>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-4 ">
                        <small>รวมค่าใช้จ่ายสุทธิ</small>
                      </div>
                      <div class="col-3 text-right">
                        <h5 class="text-primary">
                          <b>
                          <?php echo $row['REP_NETTOTALCOST'] ?>
                          </b>
                        </h5>
                      </div>
                      <div class="col-4">
                        <small>บาท</small>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <?php
            }
          ?>

        </div>
      </div>
    </div>
  </div>

</div>

<!--cf.Payment Repairslip-->
<form  method="post" action="update.data.php">
  <div class="modal fade" id="cfPayment">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header align-items-center">
          <i class='fab fa-bitcoin m-1' style='font-size:35px;color:green'></i>
          <h4 class="modal-title" align="center">ยืนยันการชำระเงิน</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <input type="hidden" name="action" value="updatePaymentREP">
          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <label for="repid">รหัสการซ่อม : </label>
                <input  class ="form-control" type="text" name="repid" id="repid" value="" style="border:none; font-weight: bold; background-color: white;" readonly>
              </div>
              <div class="form-group">
                <label for="repid">ลูกค้า : </label>
                <input  class ="form-control" type="text" name="repid" id="cusname" value="" style="border:none; font-weight: bold; background-color: white;" readonly>
              </div>
              <div class="form-group">
                <label for="repid">ทะเบียนรถ : </label>
                <input  class ="form-control" type="text" name="repid" id="cars" value="" style="border:none; font-weight: bold; background-color: white;" readonly>
              </div>
              <div class="form-group">
                <label for="repid">รวมค่าใช้จ่าย : </label>
                <input  class ="form-control" type="text" name="repid" id="netcost" value="" style="border:none; font-weight: bold; background-color: white;" readonly>
              </div>
              </div>
            <div class="col align-items-center">
                <div class="row mb-5"></div>
                <div class="row mb-3"></div>
                <i class='fab fa-bitcoin' style='font-size:200px;color:green'></i>

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
$(function() {
    $('.tabs li').on('click', function() {
        var tabId = $(this).attr('data-tab');

        $('.tabs li').removeClass('current');
        $('.tab-pane').removeClass('current');

        $(this).addClass('current');
        $('#' + tabId).addClass('current');
    });
});


$(document).ready(function() {
	$('#cfPayment').on('show.bs.modal', function (event) {
	  var button = $(event.relatedTarget);
	  var id= button.data('id');
    var name = button.data('fname')+"  "+button.data('lname');
    var cars = button.data('car')+"  "+button.data('province');
    var netcost = button.data('ntotalcost')+"  บาท";
	  var modal = $(this);
	  modal.find('#repid').val(id);
    modal.find('#cusname').val(name);
    modal.find('#cars').val(cars);
    modal.find('#netcost').val(netcost);
  });
});

</script>

</body>
</html>
<?php
  disconnect();
?>
