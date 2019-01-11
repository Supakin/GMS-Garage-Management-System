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
<div class = "container" >
  <div class="row justify-content-center align-content-center">
    <button type="button" class="btn btn-info btn-block mt-2 shadow-sm" onClick = "window.location.replace('main_product.php')">
      <i class='fas fa-cogs' style='font-size:10px;color:white'></i>
      กลับหน้าคลังอะไหล่
    </button>
  </div>
  <div class="row mt-3 mb-3 align-items-center">
    <div class="col-1">
        <i class="fas fa-scroll" style='font-size:65px;color:black'></i>
    </div>
    <div class="col-6">
      <h3>การจัดการอะไหล่</h3>
    </div>
    <div class="col-5 justify-content-end">

    </div>
  </div>
  <div class="row m-2 justify-content-center">
    <button type="button" class="btn btn-success m-1" data-toggle="modal" data-target="#addorder">
      <i class='fas fa-plus' style='font-size:10px;color:white'></i>
      นำเข้าอะไหล่
    </button>
    <button type="button" class="btn btn-success m-1" data-toggle="modal" data-target="#getorder">
      <i class='fas fa-edit' style='font-size:10px;color:white'></i>
      รับอะไหล่
    </button>
    <button type="button" class="btn btn-success m-1" data-toggle="modal" data-target="#claimorder">
      <i class='fas fa-ambulance' style='font-size:10px;color:white'></i>
      เคลมอะไหล่
    </button>
    <button type="button" class="btn btn-success m-1" data-toggle="modal" data-target="#getclaimorder">
      <i class='fas fa-truck' style='font-size:10px;color:white'></i>
      รับอะไหล่จากการเคลม
    </button>
    <button type="button" class="btn btn-success m-1" data-toggle="modal" data-target="#paymentorder">
      <i class='fas fa-wallet' style='font-size:10px;color:white'></i>
      ชำระเงิน
    </button>
  </div>

  <div class="tab-example">
    <ul class="tabs" >
      <li class="tab-link current active" data-tab="menu1">นำเข้าที่กำลังดำเนินการ</li>
      <li class="tab-link" data-tab="menu2">ประวัตินำเข้า</li>
      <li class="tab-link" data-tab="menu3">เคลมที่กำลังดำเนินการ</li>
      <li class="tab-link" data-tab="menu4">ประวัติการเคลม</li>
      <li class="tab-link" data-tab="menu5">ประวัติการรับ</li>
      <li class="tab-link" data-tab="menu6">ประวัติรับเคลม</li>
      <li class="tab-link" data-tab="menu7">ประวัติชำระเงิน</li>
    </ul>

    <div class="tab-contents">
      <!--ordering-->
      <div id="menu1" class="tab-pane current"><br>
        <div id="accordion1">
        <?php
          $sql = "SELECT * FROM ORDERS NATURAL JOIN SELLER WHERE ORD_STATUS = 'N' ORDER BY ORD_ID ";
          $sql_query = mysql_query($sql);
          while($row = mysql_fetch_array($sql_query)){
        ?>
          <div class="card">
            <div class="card-header bg-transparent">
              <div class="row">
                <div class="col-4">
                  <a class="card-link" data-toggle="collapse" href="#<?php echo "show".$row['ORD_ID']."ordering";?>">
                    <center><?php echo "<b>รหัสนำเข้า : ".$row['ORD_ID']."</b>";?></center>
                  </a>
                </div>
                <div class="col-6">
                </div>
                <div class="col-2">
                  <?php
                  if ($row["ORD_STATUS"]=='Y'){
                    echo "<span class='badge badge-success '>";
                    echo "เรียบร้อย";
                    echo "</span>";
                  }else if ($row["ORD_STATUS"]=='N'){
                    echo "<span class='badge badge-danger'>";
                    echo "ยังไม่เรียบร้อย";
                    echo "</span>";
                  }
                  ?>
                </div>
              </div>
            </div>

            <div id="<?php echo "show".$row['ORD_ID']."ordering"; ?>" class="collapse" data-parent="#accordion1">
              <div class="card-body">
                <!--line 1-->
                <div class="row justify-content-start">
                  <div class="col-2 ">
                    ผู้ขาย
                  </div>
                  <div class="col-5">
                    <b><?php echo $row['SEL_ID']."    ".$row['SEL_NAME']; ?></b>
                  </div>
                </div>

                <!--line 2-->
                <div class="row justify-content-start">
                  <div class="col-2 ">
                    วันที่สั่ง
                  </div>
                  <div class="col-2">
                    <b><?php echo $row['ORD_DATE']; ?></b>
                  </div>
                </div>

                <!--line 3-->
                <div class="row justify-content-start">
                  <div class="col-2 ">
                    กำหนดวันได้รับ
                  </div>
                  <div class="col-2">
                    <b><?php echo $row['ORD_GETDATE']; ?></b>
                  </div>
                  <div class="col-1">
                  </div>
                  <div class="col-2">
                    <b>สถานะการรับ</b>
                  </div>
                  <div class="col-1">
                    <?php
                    $check_get_sql = "SELECT COUNT(GPO_ID) AS CHECKGET,GPO_DATE  FROM GET_PRODUCT_ORDER WHERE ORD_ID = '".$row['ORD_ID']."' AND GPO_STATUS = 'Y'";
                    $check_get_query = mysql_query($check_get_sql);
                    $check_get = mysql_fetch_array($check_get_query) or die(mysql_error());
                    if ($check_get['CHECKGET']>0){
                      echo "<span class='badge badge-success'>";
                      echo "ครบแล้ว";
                      echo "</span>";
                    }else{
                      echo "<span class='badge badge-danger'>";
                      echo "ยังไม่ครบ";
                      echo "</span>";
                    }
                    ?>
                  </div>
                  <?php
                    if($check_get['CHECKGET']>0){
                      echo "<div class='col-2'><b>วันที่รับครบ</b></div>";
                      echo "<div class='col-2'>".$check_get['GPO_DATE']."</div>";
                    }
                  ?>
                </div>

                <!--line 4-->
                <div class="row justify-content-start">
                  <div class="col-2 ">
                    กำหนดชำระเงิน
                  </div>
                  <div class="col-2">
                    <b><?php echo $row['ORD_PAYDATE']; ?></b>
                  </div>
                  <div class="col-1">
                  </div>
                  <div class="col-2">
                    <b>สถานะการชำระเงิน</b>
                  </div>
                  <div class="col-1">
                    <?php
                    $check_pay_sql = "SELECT PAYO_ID,PAYO_DATE FROM PAYMENT_ORDER WHERE ORD_ID = '".$row['ORD_ID']."'";
                    $check_pay_query = mysql_query($check_pay_sql) or die(mysql_error());
                    $check_pay = mysql_fetch_array($check_pay_query) ;
                    if ($check_pay['PAYO_ID'] != null){
                      echo "<span class='badge badge-success'>";
                      echo "ชำระแล้ว";
                      echo "</span>";
                    }else{
                      echo "<span class='badge badge-danger'>";
                      echo "ยังไม่ชำระ";
                      echo "</span>";
                    }
                    ?>
                  </div>
                  <?php
                    if($check_pay['PAYO_ID'] != null){
                      echo "<div class='col-2'><b>วันที่ชำระเงิน</b></div>";
                      echo "<div class='col-2'>".$check_pay['PAYO_DATE']."</div>";
                    }
                  ?>
                </div>

                <div class="row">
                  <br>
                </div>
                <table class="table table-bordered">
                  <thead>
                    <tr align="center">
                      <th>ลำดับ</th>
                      <th>รหัสอะไหล่</th>
                      <th>ชื่อ</th>
                      <th>จำนวนที่สั่ง</th>
                      <th>ราคารวม</th>
                      <th>สถานะการรับ</th>
                    </tr>
                  </thead>
                  <?php
                    $ord_id = $row['ORD_ID'];
                    $sqlt = "SELECT * FROM (ORDERS NATURAL JOIN ORDER_DETAIL) NATURAL JOIN PRODUCT WHERE ORD_ID = $ord_id ORDER BY ORD_ID,ORDD_NUMBER";
                    $sqlt_query =mysql_query($sqlt);
                    $i=1;
                    while($row2 = mysql_fetch_array($sqlt_query)){
                  ?>
                      <tr>
                        <td align="center" width='5%'><?php echo $i ?></td>
                        <td align="center" width='10%'><?php echo $row2['PRO_ID'] ?></td>
                        <td><?php echo $row2['PRO_NAME'] ?></td>
                        <td align="center" width='10%'><?php echo $row2['ORDD_AMOUNT'] ?></td>
                        <td align="center"><?php echo $row2['ORDD_TOTALPRICE'] ?></td>
                        <td align="center" width='15%'>
                          <?php
                            if($row2['ORDD_STATUS']=='Y') {
                              echo "<span class='badge badge-success'>";
                              echo "ครบแล้ว";
                              echo "</span>";
                            }else{
                              echo "<span class='badge badge-danger'>";
                              echo "ยังไม่ครบ";
                              echo "</span>";
                            }
                          ?>
                        </td>
                      </tr>
                  <?php
                  $i++;
                    }
                  ?>
                </table>
                <div class="row">
                  <br>
                </div>
                <div class="row justify-content-end">
                  <div class="col-2 ">
                    ราคารวม
                  </div>
                  <div class="col-2 justify-content-end">
                    <?php echo "<h3>".$row['ORD_TOTALPRICE']."</h3>"; ?>
                  </div>
                  <div class="col-1 ">
                    บาท
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
          $sql = "SELECT * FROM ORDERS NATURAL JOIN SELLER WHERE ORD_STATUS = 'Y' ORDER BY ORD_ID ";
          $sql_query = mysql_query($sql);
          while($row = mysql_fetch_array($sql_query)){
        ?>
          <div class="card">
            <div class="card-header bg-transparent">
              <div class="row">
                <div class="col-4">
                  <a class="card-link" data-toggle="collapse" href="#<?php echo "show".$row['ORD_ID']."ordered";?>">
                    <center><?php echo "<b>รหัสนำเข้า : ".$row['ORD_ID']."</b>";?></center>
                  </a>
                </div>
                <div class="col-6">
                </div>
                <div class="col-2">
                  <?php
                  if ($row["ORD_STATUS"]=='Y'){
                    echo "<span class='badge badge-success '>";
                    echo "เรียบร้อย";
                    echo "</span>";
                  }else if ($row["ORD_STATUS"]=='N'){
                    echo "<span class='badge badge-danger'>";
                    echo "ยังไม่เรียบร้อย";
                    echo "</span>";
                  }
                  ?>
                </div>
              </div>
            </div>

            <div id="<?php echo "show".$row['ORD_ID']."ordered"; ?>" class="collapse" data-parent="#accordion2">
              <div class="card-body">
                <!--line 1-->
                <div class="row justify-content-start">
                  <div class="col-2 ">
                    ผู้ขาย
                  </div>
                  <div class="col-5">
                    <b><?php echo $row['SEL_ID']."    ".$row['SEL_NAME']; ?></b>
                  </div>
                </div>

                <!--line 2-->
                <div class="row justify-content-start">
                  <div class="col-2 ">
                    วันที่สั่ง
                  </div>
                  <div class="col-2">
                    <b><?php echo $row['ORD_DATE']; ?></b>
                  </div>
                </div>

                <!--line 3-->
                <div class="row justify-content-start">
                  <div class="col-2 ">
                    กำหนดวันได้รับ
                  </div>
                  <div class="col-2">
                    <b><?php echo $row['ORD_GETDATE']; ?></b>
                  </div>
                  <div class="col-1">
                  </div>
                  <div class="col-2">
                    <b>สถานะการรับ</b>
                  </div>
                  <div class="col-1">
                    <?php
                    $check_get_sql = "SELECT COUNT(GPO_ID) AS CHECKGET,GPO_DATE  FROM GET_PRODUCT_ORDER WHERE ORD_ID = '".$row['ORD_ID']."' AND GPO_STATUS = 'Y'";
                    $check_get_query = mysql_query($check_get_sql);
                    $check_get = mysql_fetch_array($check_get_query) or die(mysql_error());
                    if ($check_get['CHECKGET']>0){
                      echo "<span class='badge badge-success'>";
                      echo "ครบแล้ว";
                      echo "</span>";
                    }else{
                      echo "<span class='badge badge-danger'>";
                      echo "ยังไม่ครบ";
                      echo "</span>";
                    }
                    ?>
                  </div>
                  <?php
                    if($check_get['CHECKGET']>0){
                      echo "<div class='col-2'><b>วันที่รับครบ</b></div>";
                      echo "<div class='col-2'>".$check_get['GPO_DATE']."</div>";
                    }
                  ?>
                </div>

                <!--line 4-->
                <div class="row justify-content-start">
                  <div class="col-2 ">
                    กำหนดชำระเงิน
                  </div>
                  <div class="col-2">
                    <b><?php echo $row['ORD_PAYDATE']; ?></b>
                  </div>
                  <div class="col-1">
                  </div>
                  <div class="col-2">
                    <b>สถานะการชำระเงิน</b>
                  </div>
                  <div class="col-1">
                    <?php
                    $check_pay_sql = "SELECT PAYO_ID,PAYO_DATE FROM PAYMENT_ORDER WHERE ORD_ID = '".$row['ORD_ID']."'";
                    $check_pay_query = mysql_query($check_pay_sql) or die(mysql_error());
                    $check_pay = mysql_fetch_array($check_pay_query) ;
                    if ($check_pay['PAYO_ID'] != null){
                      echo "<span class='badge badge-success'>";
                      echo "ชำระแล้ว";
                      echo "</span>";
                    }else{
                      echo "<span class='badge badge-danger'>";
                      echo "ยังไม่ชำระ";
                      echo "</span>";
                    }
                    ?>
                  </div>
                  <?php
                    if($check_pay['PAYO_ID'] != null){
                      echo "<div class='col-2'><b>วันที่ชำระเงิน</b></div>";
                      echo "<div class='col-2'>".$check_pay['PAYO_DATE']."</div>";
                    }
                  ?>
                </div>

                <div class="row">
                  <br>
                </div>
                <table class="table table-bordered">
                  <thead>
                    <tr align="center">
                      <th>ลำดับ</th>
                      <th>รหัสอะไหล่</th>
                      <th>ชื่อ</th>
                      <th>จำนวนที่สั่ง</th>
                      <th>ราคารวม</th>
                      <th>สถานะการรับ</th>
                    </tr>
                  </thead>
                  <?php
                    $ord_id = $row['ORD_ID'];
                    $sqlt = "SELECT * FROM (ORDERS NATURAL JOIN ORDER_DETAIL) NATURAL JOIN PRODUCT WHERE ORD_ID = $ord_id ORDER BY ORD_ID,ORDD_NUMBER";
                    $sqlt_query =mysql_query($sqlt);
                    $i=1;
                    while($row2 = mysql_fetch_array($sqlt_query)){
                  ?>
                      <tr>
                        <td align="center" width='5%'><?php echo $i ?></td>
                        <td align="center" width='10%'><?php echo $row2['PRO_ID'] ?></td>
                        <td><?php echo $row2['PRO_NAME'] ?></td>
                        <td align="center" width='10%'><?php echo $row2['ORDD_AMOUNT'] ?></td>
                        <td align="center"><?php echo $row2['ORDD_TOTALPRICE'] ?></td>
                        <td align="center" width='15%'>
                          <?php
                            if($row2['ORDD_STATUS']=='Y') {
                              echo "<span class='badge badge-success'>";
                              echo "ครบแล้ว";
                              echo "</span>";
                            }else{
                              echo "<span class='badge badge-danger'>";
                              echo "ยังไม่ครบ";
                              echo "</span>";
                            }
                          ?>
                        </td>
                      </tr>
                  <?php
                  $i++;
                    }
                  ?>
                </table>
                <div class="row">
                  <br>
                </div>
                <div class="row justify-content-end">
                  <div class="col-2 ">
                    ราคารวม
                  </div>
                  <div class="col-2 justify-content-end">
                    <?php echo "<h3>".$row['ORD_TOTALPRICE']."</h3>"; ?>
                  </div>
                  <div class="col-1 ">
                    บาท
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

      <!--claiming-->
      <div id="menu3" class="tab-pane"><br>
        <div id="accordion3">
        <?php
          $sql = "SELECT * FROM (CLAIMSLIP_ORDER NATURAL JOIN ORDERS) NATURAL JOIN SELLER  WHERE CLO_STATUS = 'N' ORDER BY CLO_ID ";
          $sql_query = mysql_query($sql);
          while($row = mysql_fetch_array($sql_query)){
        ?>
          <div class="card">
            <div class="card-header bg-transparent">
              <div class="row">
                <div class="col-4">
                  <a class="card-link" data-toggle="collapse" href="#<?php echo "show".$row['CLO_ID']."claiming";?>">
                    <center><?php echo "<b>รหัสการเคลม : ".$row['CLO_ID']."</b>";?></center>
                  </a>
                </div>
                <div class="col-6">
                </div>
                <div class="col-2">
                  <?php
                  if ($row["CLO_STATUS"]=='Y'){
                    echo "<span class='badge badge-success '>";
                    echo "เรียบร้อย";
                    echo "</span>";
                  }else if ($row["CLO_STATUS"]=='N'){
                    echo "<span class='badge badge-danger'>";
                    echo "ยังไม่เรียบร้อย";
                    echo "</span>";
                  }
                  ?>
                </div>
              </div>
            </div>

            <div id="<?php echo "show".$row['CLO_ID']."claiming"; ?>" class="collapse" data-parent="#accordion3">
              <div class="card-body">
                <!--line 1-->
                <div class="row justify-content-start">
                  <div class="col-2 ">
                    รหัสนำเข้า
                  </div>
                  <div class="col-5">
                    <b><?php echo $row['ORD_ID']; ?></b>
                  </div>
                </div>

                <!--line 2-->
                <div class="row justify-content-start">
                  <div class="col-2 ">
                    ผู้ขาย
                  </div>
                  <div class="col-5">
                    <b><?php echo $row['SEL_ID']."    ".$row['SEL_NAME']; ?></b>
                  </div>
                </div>

                <!--line 3-->
                <div class="row justify-content-start">
                  <div class="col-2 ">
                    วันที่เคลม
                  </div>
                  <div class="col-2">
                    <b><?php echo $row['CLO_DATE']; ?></b>
                  </div>
                </div>

                <!--line 4-->
                <div class="row justify-content-start">
                  <div class="col-2 ">
                    กำหนดวันได้รับ
                  </div>
                  <div class="col-2">
                    <b><?php echo $row['CLO_GETDATE']; ?></b>
                  </div>
                  <div class="col-1">
                  </div>
                  <div class="col-2">
                    <b>สถานะการรับ</b>
                  </div>
                  <div class="col-1">
                    <?php
                    $check_get_sql = "SELECT COUNT(GPCO_ID) AS CHECKGET,GPCO_DATE  FROM GET_PRODUCT_CLAIM_ORDER WHERE CLO_ID = '".$row['CLO_ID']."' AND GPCO_STATUS = 'Y'";
                    $check_get_query = mysql_query($check_get_sql);
                    $check_get = mysql_fetch_array($check_get_query) or die(mysql_error());
                    if ($check_get['CHECKGET']>0){
                      echo "<span class='badge badge-success'>";
                      echo "ครบแล้ว";
                      echo "</span>";
                    }else{
                      echo "<span class='badge badge-danger'>";
                      echo "ยังไม่ครบ";
                      echo "</span>";
                    }
                    ?>
                  </div>
                  <?php
                    if($check_get['CHECKGET']>0){
                      echo "<div class='col-2'><b>วันที่รับครบ</b></div>";
                      echo "<div class='col-2'>".$check_get['GPCO_DATE']."</div>";
                    }
                  ?>
                </div>
                <div class="row">
                  <br>
                </div>
                <table class="table table-bordered">
                  <thead>
                    <tr align="center">
                      <th>ลำดับ</th>
                      <th>รหัสอะไหล่</th>
                      <th>ชื่อ</th>
                      <th>จำนวนที่เคลม</th>
                      <th>สถานะการรับ</th>
                    </tr>
                  </thead>
                  <?php
                    $clo_id = $row['CLO_ID'];
                    $sqlt = "SELECT * FROM (CLAIMSLIP_ORDER NATURAL JOIN CLAIM_ORDER_DETAIL) NATURAL JOIN PRODUCT WHERE CLO_ID = $clo_id ORDER BY CLO_ID,CLAD_NUMBER";
                    $sqlt_query =mysql_query($sqlt);
                    $i=1;
                    while($row2 = mysql_fetch_array($sqlt_query)){
                  ?>
                      <tr>
                        <td align="center" width='5%'><?php echo $i ?></td>
                        <td align="center" width='10%'><?php echo $row2['PRO_ID'] ?></td>
                        <td><?php echo $row2['PRO_NAME'] ?></td>
                        <td align="center" width='20%'><?php echo $row2['CLAD_AMOUNT'] ?></td>
                        <td align="center" width='15%'>
                          <?php
                            if($row2['CLAD_STATUS']=='Y') {
                              echo "<span class='badge badge-success'>";
                              echo "ครบแล้ว";
                              echo "</span>";
                            }else{
                              echo "<span class='badge badge-danger'>";
                              echo "ยังไม่ครบ";
                              echo "</span>";
                            }
                          ?>
                        </td>
                      </tr>
                  <?php
                  $i++;
                    }
                  ?>
                </table>
              </div>
            </div>
          </div>
            <?php
            }
            ?>
        </div>
      </div>

      <!--claimed--->
      <div id="menu4" class="tab-pane"><br>
        <div id="accordion4">
        <?php
          $sql = "SELECT * FROM (CLAIMSLIP_ORDER NATURAL JOIN ORDERS) NATURAL JOIN SELLER  WHERE CLO_STATUS = 'Y' ORDER BY CLO_ID ";
          $sql_query = mysql_query($sql);
          while($row = mysql_fetch_array($sql_query)){
        ?>
          <div class="card">
            <div class="card-header bg-transparent">
              <div class="row">
                <div class="col-4">
                  <a class="card-link" data-toggle="collapse" href="#<?php echo "show".$row['CLO_ID']."claimed";?>">
                    <center><?php echo "<b>รหัสการเคลม : ".$row['CLO_ID']."</b>";?></center>
                  </a>
                </div>
                <div class="col-6">
                </div>
                <div class="col-2">
                  <?php
                  if ($row["CLO_STATUS"]=='Y'){
                    echo "<span class='badge badge-success '>";
                    echo "เรียบร้อย";
                    echo "</span>";
                  }else if ($row["CLO_STATUS"]=='N'){
                    echo "<span class='badge badge-danger'>";
                    echo "ยังไม่เรียบร้อย";
                    echo "</span>";
                  }
                  ?>
                </div>
              </div>
            </div>

            <div id="<?php echo "show".$row['CLO_ID']."claimed"; ?>" class="collapse" data-parent="#accordion4">
              <div class="card-body">
                <!--line 1-->
                <div class="row justify-content-start">
                  <div class="col-2 ">
                    รหัสนำเข้า
                  </div>
                  <div class="col-5">
                    <b><?php echo $row['ORD_ID']; ?></b>
                  </div>
                </div>

                <!--line 2-->
                <div class="row justify-content-start">
                  <div class="col-2 ">
                    ผู้ขาย
                  </div>
                  <div class="col-5">
                    <b><?php echo $row['SEL_ID']."    ".$row['SEL_NAME']; ?></b>
                  </div>
                </div>

                <!--line 3-->
                <div class="row justify-content-start">
                  <div class="col-2 ">
                    วันที่เคลม
                  </div>
                  <div class="col-2">
                    <b><?php echo $row['CLO_DATE']; ?></b>
                  </div>
                </div>

                <!--line 4-->
                <div class="row justify-content-start">
                  <div class="col-2 ">
                    กำหนดวันได้รับ
                  </div>
                  <div class="col-2">
                    <b><?php echo $row['CLO_GETDATE']; ?></b>
                  </div>
                  <div class="col-1">
                  </div>
                  <div class="col-2">
                    <b>สถานะการรับ</b>
                  </div>
                  <div class="col-1">
                    <?php
                    $check_get_sql = "SELECT COUNT(GPCO_ID) AS CHECKGET,GPCO_DATE  FROM GET_PRODUCT_CLAIM_ORDER WHERE CLO_ID = '".$row['CLO_ID']."' AND GPCO_STATUS = 'Y'";
                    $check_get_query = mysql_query($check_get_sql);
                    $check_get = mysql_fetch_array($check_get_query) or die(mysql_error());
                    if ($check_get['CHECKGET']>0){
                      echo "<span class='badge badge-success'>";
                      echo "ครบแล้ว";
                      echo "</span>";
                    }else{
                      echo "<span class='badge badge-danger'>";
                      echo "ยังไม่ครบ";
                      echo "</span>";
                    }
                    ?>
                  </div>
                  <?php
                    if($check_get['CHECKGET']>0){
                      echo "<div class='col-2'><b>วันที่รับครบ</b></div>";
                      echo "<div class='col-2'>".$check_get['GPCO_DATE']."</div>";
                    }
                  ?>
                </div>
                <div class="row">
                  <br>
                </div>
                <table class="table table-bordered">
                  <thead>
                    <tr align="center">
                      <th>ลำดับ</th>
                      <th>รหัสอะไหล่</th>
                      <th>ชื่อ</th>
                      <th>จำนวนที่เคลม</th>
                      <th>สถานะการรับ</th>
                    </tr>
                  </thead>
                  <?php
                    $clo_id = $row['CLO_ID'];
                    $sqlt = "SELECT * FROM (CLAIMSLIP_ORDER NATURAL JOIN CLAIM_ORDER_DETAIL) NATURAL JOIN PRODUCT WHERE CLO_ID = $clo_id ORDER BY CLO_ID,CLAD_NUMBER";
                    $sqlt_query =mysql_query($sqlt);
                    $i=1;
                    while($row2 = mysql_fetch_array($sqlt_query)){
                  ?>
                      <tr>
                        <td align="center" width='5%'><?php echo $i ?></td>
                        <td align="center" width='10%'><?php echo $row2['PRO_ID'] ?></td>
                        <td><?php echo $row2['PRO_NAME'] ?></td>
                        <td align="center" width='20%'><?php echo $row2['CLAD_AMOUNT'] ?></td>
                        <td align="center" width='15%'>
                          <?php
                            if($row2['CLAD_STATUS']=='Y') {
                              echo "<span class='badge badge-success'>";
                              echo "ครบแล้ว";
                              echo "</span>";
                            }else{
                              echo "<span class='badge badge-danger'>";
                              echo "ยังไม่ครบ";
                              echo "</span>";
                            }
                          ?>
                        </td>
                      </tr>
                  <?php
                  $i++;
                    }
                  ?>
                </table>
              </div>
            </div>
          </div>

        <?php
          }
        ?>

        </div>
      </div>


      <!--getorder-->
      <div id="menu5" class="tab-pane"><br>
          <div id="accordion5">
          <?php
            $sql = "SELECT * FROM (GET_PRODUCT_ORDER NATURAL JOIN ORDERS) NATURAL JOIN SELLER  ORDER BY GPO_ID ";
            $sql_query = mysql_query($sql);
            while($row = mysql_fetch_array($sql_query)){
          ?>
            <div class="card">
              <div class="card-header bg-transparent">
                <div class="row">
                  <div class="col-4">
                    <a class="card-link" data-toggle="collapse" href="#<?php echo "show".$row['GPO_ID']."getorder";?>">
                      <center><?php echo "<b>รหัสการรับ : ".$row['GPO_ID']."</b>";?></center>
                    </a>
                  </div>
                  <div class="col-8">
                  </div>
                </div>
              </div>

              <div id="<?php echo "show".$row['GPO_ID']."getorder"; ?>" class="collapse" data-parent="#accordion5">
                <div class="card-body">
                  <!--line 1-->
                  <div class="row justify-content-start">
                    <div class="col-2 ">
                      รหัสนำเข้า
                    </div>
                    <div class="col-5">
                      <b><?php echo $row['ORD_ID']; ?></b>
                    </div>
                  </div>

                  <!--line 2-->
                  <div class="row justify-content-start">
                    <div class="col-2 ">
                      ผู้ขาย
                    </div>
                    <div class="col-5">
                      <b><?php echo $row['SEL_ID']."    ".$row['SEL_NAME']; ?></b>
                    </div>
                  </div>

                  <!--line 3-->
                  <div class="row justify-content-start">
                    <div class="col-2 ">
                      วันกำหนดได้รับ
                    </div>
                    <div class="col-2">
                      <b><?php echo $row['ORD_GETDATE']; ?></b>
                    </div>
                  </div>

                  <!--line 4-->
                  <div class="row justify-content-start">
                    <div class="col-2 ">
                      วันที่รับ
                    </div>
                    <div class="col-2">
                      <b><?php echo $row['GPO_DATE']; ?></b>
                    </div>
                  </div>

                  <div class="row">
                    <br>
                  </div>
                  <table class="table table-bordered">
                    <thead>
                      <tr align="center">
                        <th>ลำดับ</th>
                        <th>รหัสอะไหล่</th>
                        <th>ชื่อ</th>
                        <th>จำนวนที่รับ</th>
                      </tr>
                    </thead>
                    <?php
                      $gpo_id = $row['GPO_ID'];
                      $sqlt = "SELECT * FROM (GET_PRODUCT_ORDER NATURAL JOIN GET_PRODUCT_ORDER_DETAIL) NATURAL JOIN PRODUCT WHERE GPO_ID = $gpo_id ORDER BY GPO_ID,GPOD_NUMBER";
                      $sqlt_query =mysql_query($sqlt);
                      $i=1;
                      while($row2 = mysql_fetch_array($sqlt_query)){
                    ?>
                        <tr>
                          <td align="center" width='5%'><?php echo $i ?></td>
                          <td align="center" width='10%'><?php echo $row2['PRO_ID'] ?></td>
                          <td><?php echo $row2['PRO_NAME'] ?></td>
                          <td align="center" width='20%'><?php echo $row2['GPOD_GETAMOUNT'] ?></td>
                        </tr>
                    <?php
                    $i++;
                      }
                    ?>
                  </table>
                </div>
              </div>
            </div>

          <?php
            }
          ?>

        </div>
      </div>

      <!--getclaimorder-->
      <div id="menu6" class="tab-pane"><br>
            <div id="accordion6">
            <?php
              $sql = "SELECT * FROM ((GET_PRODUCT_CLAIM_ORDER NATURAL JOIN CLAIMSLIP_ORDER) NATURAL JOIN ORDERS) NATURAL JOIN SELLER ORDER BY GPCO_ID ";
              $sql_query = mysql_query($sql);
              while($row = mysql_fetch_array($sql_query)){
            ?>
              <div class="card">
                <div class="card-header bg-transparent">
                  <div class="row">
                    <div class="col-4">
                      <a class="card-link" data-toggle="collapse" href="#<?php echo "show".$row['GPCO_ID']."getclaimorder";?>">
                        <center><?php echo "<b>รหัสการรับเคลม : ".$row['GPCO_ID']."</b>";?></center>
                      </a>
                    </div>
                    <div class="col-8">
                    </div>
                  </div>
                </div>

                <div id="<?php echo "show".$row['GPCO_ID']."getclaimorder"; ?>" class="collapse" data-parent="#accordion6">
                  <div class="card-body">
                    <!--line 1-->
                    <div class="row justify-content-start">
                      <div class="col-2 ">
                        รหัสการเคลม
                      </div>
                      <div class="col-5">
                        <b><?php echo $row['CLO_ID']; ?></b>
                      </div>
                    </div>

                    <!--line 2-->
                    <div class="row justify-content-start">
                      <div class="col-2 ">
                        รหัสนำเข้า
                      </div>
                      <div class="col-5">
                        <b><?php echo $row['ORD_ID']; ?></b>
                      </div>
                    </div>

                    <!--line 3-->
                    <div class="row justify-content-start">
                      <div class="col-2 ">
                        ผู้ขาย
                      </div>
                      <div class="col-5">
                        <b><?php echo $row['SEL_ID']."    ".$row['SEL_NAME']; ?></b>
                      </div>
                    </div>

                    <!--line 4-->
                    <div class="row justify-content-start">
                      <div class="col-2 ">
                        วันกำหนดได้รับ
                      </div>
                      <div class="col-2">
                        <b><?php echo $row['CLO_GETDATE']; ?></b>
                      </div>
                    </div>

                    <!--line 5-->
                    <div class="row justify-content-start">
                      <div class="col-2 ">
                        วันที่รับ
                      </div>
                      <div class="col-2">
                        <b><?php echo $row['GPCO_DATE']; ?></b>
                      </div>
                    </div>

                    <div class="row">
                      <br>
                    </div>
                    <table class="table table-bordered">
                      <thead>
                        <tr align="center">
                          <th>ลำดับ</th>
                          <th>รหัสอะไหล่</th>
                          <th>ชื่อ</th>
                          <th>จำนวนที่รับ</th>
                        </tr>
                      </thead>
                      <?php
                        $gpco_id = $row['GPCO_ID'];
                        $sqlt = "SELECT * FROM (GET_PRODUCT_CLAIM_ORDER NATURAL JOIN GET_PRODUCT_CLAIM_ORDER_DETAIL) NATURAL JOIN PRODUCT WHERE GPCO_ID = $gpco_id ORDER BY GPCO_ID,GPCOD_NUMBER";
                        $sqlt_query =mysql_query($sqlt);
                        $i=1;
                        while($row2 = mysql_fetch_array($sqlt_query)){
                      ?>
                          <tr>
                            <td align="center" width='5%'><?php echo $i ?></td>
                            <td align="center" width='10%'><?php echo $row2['PRO_ID'] ?></td>
                            <td><?php echo $row2['PRO_NAME'] ?></td>
                            <td align="center" width='20%'><?php echo $row2['GPCOD_GETAMOUNT'] ?></td>
                          </tr>
                      <?php
                      $i++;
                        }
                      ?>
                    </table>
                  </div>
                </div>
              </div>

            <?php
              }
            ?>

          </div>
      </div>

      <!--payment-->
      <div id="menu7" class="tab-pane"><br>
        <div id="accordion7">
        <?php
          $sql = "SELECT * FROM (PAYMENT_ORDER NATURAL JOIN ORDERS) NATURAL JOIN SELLER ORDER BY PAYO_ID ";
          $sql_query = mysql_query($sql);
          while($row = mysql_fetch_array($sql_query)){
        ?>
          <div class="card">
            <div class="card-header bg-transparent">
              <div class="row">
                <div class="col-4">
                  <a class="card-link" data-toggle="collapse" href="#<?php echo "show".$row['PAYO_ID']."paymentorder";?>">
                    <center><?php echo "<b>รหัสการชำระเงิน : ".$row['PAYO_ID']."</b>";?></center>
                  </a>
                </div>
                <div class="col-8">
                </div>
              </div>
            </div>

            <div id="<?php echo "show".$row['PAYO_ID']."paymentorder"; ?>" class="collapse" data-parent="#accordion7">
              <div class="card-body">
                <!--line 1-->
                <div class="row justify-content-start">
                  <div class="col-2 ">
                    รหัสนำเข้า
                  </div>
                  <div class="col-5">
                    <b><?php echo $row['ORD_ID']; ?></b>
                  </div>
                </div>

                <!--line 2-->
                <div class="row justify-content-start">
                  <div class="col-2 ">
                    ผู้ขาย
                  </div>
                  <div class="col-5">
                    <b><?php echo $row['SEL_ID']."    ".$row['SEL_NAME']; ?></b>
                  </div>
                </div>

                <!--line 3-->
                <div class="row justify-content-start">
                  <div class="col-2 ">
                    วันกำหนดชำระเงิน
                  </div>
                  <div class="col-2">
                    <b><?php echo $row['ORD_PAYDATE']; ?></b>
                  </div>
                </div>

                <!--line 4-->
                <div class="row justify-content-start">
                  <div class="col-2 ">
                    วันที่ชำระเงิน
                  </div>
                  <div class="col-2">
                    <b><?php echo $row['PAYO_DATE']; ?></b>
                  </div>
                </div>

                <div class="row">
                  <br>
                </div>
                <table class="table table-bordered">
                  <thead>
                    <tr align="center">
                      <th>ลำดับ</th>
                      <th>รหัสอะไหล่</th>
                      <th>ชื่อ</th>
                      <th>จำนวนที่สั่ง</th>
                      <th>ราคารวม</th>
                    </tr>
                  </thead>
                  <?php
                    $ord_id = $row['ORD_ID'];
                    $sqlt = "SELECT * FROM (ORDERS NATURAL JOIN ORDER_DETAIL) NATURAL JOIN PRODUCT WHERE ORD_ID = $ord_id ORDER BY ORD_ID,ORDD_NUMBER";
                    $sqlt_query =mysql_query($sqlt);
                    $i=1;
                    while($row2 = mysql_fetch_array($sqlt_query)){
                  ?>
                      <tr>
                        <td align="center" width='5%'><?php echo $i ?></td>
                        <td align="center" width='10%'><?php echo $row2['PRO_ID'] ?></td>
                        <td><?php echo $row2['PRO_NAME'] ?></td>
                        <td align="center" width='10%'><?php echo $row2['ORDD_AMOUNT'] ?></td>
                        <td align="center"><?php echo $row2['ORDD_TOTALPRICE'] ?></td>
                      </tr>
                  <?php
                  $i++;
                    }
                  ?>
                </table>
                <div class="row">
                  <br>
                </div>
                <div class="row justify-content-end">
                  <div class="col-2 ">
                    ราคารวม
                  </div>
                  <div class="col-2 justify-content-end">
                    <h5 align="right"><?php echo $row['ORD_TOTALPRICE']; ?></h5>
                  </div>
                  <div class="col-1 ">
                    บาท
                  </div>
                </div>
                <div class="row justify-content-end">
                  <div class="col-2 align-items-center">
                    ยอดชำระ
                  </div>
                  <div class="col-2 justify-content-end bg-success ">
                    <h5 class="text-white" align="right"><?php echo $row['ORD_TOTALPRICE']; ?></h5>
                  </div>
                  <div class="col-1 ">
                    บาท
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


<!--Modal of Menu-->

<!--addorder-->
<form  method="post" action="order.php">
  <div class="modal fade" id="addorder">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">นำเข้าสินค้า</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="form-group">
            <label for="sel_id">เลือกรหัสผู้ขาย :</label>
            <select class="form-control" name="sel_id" required>
              <option value="">กรุณาเลือกรหัสผู้ขาย</option>
              <?php
                $sql = "SELECT SEL_ID,SEL_NAME FROM SELLER";
                $sql_query = mysql_query($sql) or die(mysql_error());
                while($row = mysql_fetch_array($sql_query)){
              ?>
                  <option value="<?php echo $row['SEL_ID'] ?>"> <?php echo $row['SEL_ID']."   ".$row['SEL_NAME'] ?></option>
              <?php
                }
              ?>
            </select>
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

<!--getorder-->
<form  method="post" action="getorder.php">
  <div class="modal fade" id="getorder">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">รับอะไหล่</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="form-group">
            <label for="ord_id">รหัสนำเข้า :</label>
            <select class="form-control" name="ord_id" required>
              <option value="">กรุณากรอกรหัสนำเข้า</option>
              <?php
                $sql = "SELECT ORD_ID AS O , COUNT(ORDD_NUMBER) AS C FROM ORDERS NATURAL JOIN ORDER_DETAIL GROUP BY ORD_ID ";
                $sql_query = mysql_query($sql) or die(mysql_error());
                while($row = mysql_fetch_array($sql_query)){
                  $sql2 = "SELECT COUNT(ORDD_NUMBER) AS C2 FROM ORDERS NATURAL JOIN ORDER_DETAIL WHERE ORD_ID = '".$row['O']."' AND ORDD_STATUS = 'Y'";
                  $sql2_query = mysql_query($sql2) or die(mysql_error());
                  $row2 = mysql_fetch_array($sql2_query);
                  if($row2['C2']<$row['C']){
              ?>
                    <option value="<?php echo $row['O'] ?>"> <?php echo $row['O'] ?></option>
              <?php
                  }
                }
              ?>
            </select>
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

<!--claimorder-->
<form  method="post" action="claimorder.php">
  <div class="modal fade" id="claimorder">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">เคลมอะไหล่</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="form-group">
            <label for="ord_id">รหัสนำเข้า :</label>
            <select class="form-control" name="ord_id" required>
              <option value="">กรุณากรอกรหัสนำเข้า</option>
              <?php
                $sql = "SELECT ORD_ID FROM GET_PRODUCT_ORDER WHERE GPO_STATUS = 'Y' ";
                $sql_query = mysql_query($sql) or die(mysql_error());
                while($row = mysql_fetch_array($sql_query)){
              ?>
                    <option value="<?php echo $row['ORD_ID'] ?>"> <?php echo $row['ORD_ID'] ?></option>
              <?php
                }
              ?>
            </select>
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

<!--getclaimorder-->
<form  method="post" action="getclaimorder.php">
  <div class="modal fade" id="getclaimorder">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">รับอะไหล่จากการเคลม</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="form-group">
            <label for="ord_id">รหัสการเคลม :</label>
            <select class="form-control" name="clo_id" required>
              <option value="">กรุณากรอกรหัสการเคลม</option>
              <?php
                $sql = "SELECT CLO_ID FROM CLAIMSLIP_ORDER WHERE CLO_STATUS = 'N' ";
                $sql_query = mysql_query($sql) or die(mysql_error());
                while($row = mysql_fetch_array($sql_query)){
              ?>
                    <option value="<?php echo $row['CLO_ID'] ?>"> <?php echo $row['CLO_ID'] ?></option>
              <?php

                }
              ?>
            </select>
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


<!--paymentOrder-->
<form  method="post" action="paymentorder.php">
  <div class="modal fade" id="paymentorder">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">ชำระเงิน</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="form-group">
            <label for="ord_id">รหัสนำเข้า :</label>
            <select class="form-control" name="ord_id" required>
              <option value="">กรุณากรอกรหัสนำเข้า</option>
              <?php
                $sql = "SELECT ORD_ID FROM  ORDERS  ";
                $sql_query = mysql_query($sql) or die(mysql_error());
                while($row = mysql_fetch_array($sql_query)){
                  $sql2 = "SELECT PAYO_ID FROM  PAYMENT_ORDER WHERE ORD_ID = '".$row['ORD_ID']."'";
                  $sql2_query = mysql_query ($sql2) or die(mysql_error());
                  $row2 = mysql_fetch_array($sql2_query);
                  if($row2 == null){
              ?>
                    <option value="<?php echo $row['ORD_ID'] ?>"> <?php echo $row['ORD_ID'] ?></option>
              <?php
                  }
                }
              ?>
            </select>
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
