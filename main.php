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
<body class="h-100 w-100 pr-3 bg-dark ">
  <div class="row">
    <div class="col-3">
      <div class="container-fuild bg-dark mt-3">
        <div class="row m-1">
          <div class="col bg-dark p-1">
            <div class="row align-items-center justify-content-center">
              <b><h5 class="text-white">รายงานประจำวัน</h5></b><br>
              <?php
                $sql = "SELECT CURDATE() ";
                $query = mysql_query($sql);
                $date = mysql_fetch_array($query);
              ?>

            </div>
            <div class="row align-items-center justify-content-center">
              <b> <h3 class="text-white"><?php echo $date['CURDATE()'] ?></h3> </b>
            </div>
          </div>
        </div>

        <div class="row mt-2 mb-2 ml-1 shadow-sm ">
          <div class="col bg-warning p-3">
            <div class="row align-items-center">
              <div class="col-7">
                <h3 class="text-white">การซ่อม</h3>
                <h3 class="text-white">กำลังดำเนินการ</h3>
              </div>
              <div class="col">
                <?php
                  $repairing = "SELECT COUNT(REP_REPAIRSTATUS) AS CR FROM REPAIRSLIP WHERE REP_REPAIRSTATUS = 'N'";
                  $query = mysql_query($repairing) or die(mysql_error());
                  $repair = mysql_fetch_array($query);
                ?>
                <h1 class="text-white" style="font-size: 80px;"><?php echo $repair['CR'] ?></h1>
              </div>
            </div>
          </div>
        </div>

        <div class="row mt-2 mb-2 ml-1 shadow-sm">
          <div class="col bg-success p-3">
            <div class="row align-items-center">
              <div class="col-7">
                <h3 class="text-white">ลูกค้า</h3>
                <h3 class="text-white">มาซ่อมรถ</h3>
              </div>
              <div class="col">
                <?php
                  $cus = "SELECT COUNT(REP_ID) AS REP FROM REPAIRSLIP WHERE REP_DATE = CURDATE()";
                  $query = mysql_query($cus) or die(mysql_error());
                  $customer = mysql_fetch_array($query);
                ?>
                <h1 class="text-white" style="font-size: 80px;"><?php echo $customer['REP'] ?></h1>
              </div>
            </div>
          </div>
        </div>

        <div class="row mt-2 mb-2 ml-1 shadow-sm ">
          <div class="col bg-danger p-3">
            <div class="row align-items-center">
              <div class="col-7">
                <h3 class="text-white">ใบเสร็จ</h3>
                <h3 class="text-white">ขายอะไหล่</h3>
              </div>
              <div class="col">
                <?php
                  $buy = "SELECT COUNT(BUY_ID) AS BUY FROM BUYSLIP WHERE BUY_DATE = CURDATE()";
                  $query = mysql_query($buy) or die(mysql_error());
                  $buyed = mysql_fetch_array($query);
                ?>
                <h1 class="text-white" style="font-size: 80px;"><?php echo $buyed['BUY'] ?></h1>
              </div>
            </div>
          </div>
        </div>

        <div class="row mt-2 mb-2 ml-1  shadow-sm ">
          <div class="col bg-primary p-3">
            <div class="row align-items-center">
              <div class="col-7">
                <h3 class="text-white">พนักงาน</h3>
                <h3 class="text-white">เข้าทำงาน</h3>
              </div>
              <div class="col">
                <?php
                  $sch = "SELECT COUNT(SCH_ID) AS SCH FROM SCHEDULE WHERE SCH_DATE = CURDATE()";
                  $query = mysql_query($sch) or die(mysql_error());
                  $sching = mysql_fetch_array($query);
                ?>
                <h1 class="text-white" style="font-size: 80px;"><?php echo $sching['SCH'] ?></h1>
              </div>
            </div>
          </div>
        </div>

        <div class="row m-1 ">
          <div class="col bg-dark p-1">
            <div class="row align-items-center justify-content-center">
              <b><h5 class="text-dark">รายงานประจำวัน</h5></b><br>

            </div>
            <div class="row align-items-center justify-content-center">
              <b> <h3 class="text-dark">TEST</h3> </b>
            </div>
          </div>
        </div>

      </div>
    </div>
    <div class="col">
      <div class="container-fuild">
        <div class="row justify-content-center align-items-center p-2 mt-5">
          <h1 class="text-white" style="font-size: 50px"><b>ระบบบริหารจัดการอู่ซ่อมรถขนาดเล็ก</b></h1>
        </div>

        <div class="row justify-content-center mt-5 mb-5">
          <button type="button" class="btn btn-info  shadow  w-25  mr-4 ml-4 p-1" onClick = "window.location.assign('main_product.php')">
            <div class="row justify-content-center align-items-center">
              <div class="col p-1">
                <i class="	fas fa-cogs" style='font-size:80px;color:white'></i>
              </div>
              <div class="col">
                <h2>อะไหล่</h2>
              </div>
            </div>
          </button>
          <button type="button" class="btn btn-secondary  shadow  w-25 mr-4 ml-4 p-1" onClick = "window.location.assign('main_seller.php')">
            <div class="row justify-content-center align-items-center">
              <div class="col p-1">
                <i class="fas fa-hands-helping" style='font-size:80px;color:white'></i>
              </div>
              <div class="col">
                <h2>คู่ค้า</h2>
              </div>
            </div>
          </button>
          <button type="button" class="btn btn-primary  shadow  w-25  mr-4 ml-4 p-1" onClick = "window.location.assign('main_employee.php')">
            <div class="row justify-content-center align-items-center">
              <div class="col p-1">
                <i class="fas fa-user" style='font-size:80px;color:white'></i>
              </div>
              <div class="col">
                <h2>พนักงาน</h2>
              </div>
            </div>
          </button>
        </div>

        <div class="row  justify-content-center mt-5 mb-5">
          <button type="button" class="btn btn-warning text-white  shadow  w-25 mr-4 ml-4 p-1" onClick = "window.location.assign('main_service.php')">
            <div class="row justify-content-center align-items-center">
              <div class="col p-1">
                <i class="fas fa-wrench" style='font-size:80px;color:white'></i>
              </div>
              <div class="col">
                <h2>บริการซ่อม</h2>
              </div>
            </div>
          </button>
          <button type="button" class="btn btn-success  shadow  w-25 mr-4 ml-4 p-1" onClick = "window.location.assign('main_customer.php')">
            <div class="row justify-content-center align-items-center">
              <div class="col p-1">
                <i class="fas fa-user-circle" style='font-size:80px;color:white'></i>
              </div>
              <div class="col">
                <h2>ลูกค้า</h2>
              </div>
            </div>
          </button>
          <button type="button" class="btn btn-danger  shadow  w-25 mr-4 ml-4 p-1" onClick = "window.location.assign('main_buy.php')">
            <div class="row justify-content-center align-items-center">
              <div class="col p-1">
                <i class="fab fa-bitcoin" style='font-size:80px;color:white'></i>
              </div>
              <div class="col">
                <h2>ขายอะไหล่</h2>
              </div>
            </div>
          </button>
          </div>

          <div class="row justify-content-center mt-5 mb-5">
            <button type="button" class="btn btn-primary  shadow  w-25  mr-4 ml-4 p-1" onClick = "window.location.assign('injury.php')">
              <div class="row justify-content-center align-items-center">
                <div class="col p-1">
                  <i class="fas fa-trash-alt" style='font-size:80px;color:white'></i>
                </div>
                <div class="col">
                  <h2>แจ้งอะไหล่ชำรุด</h2>
                </div>
              </div>
            </button>
            <button type="button" class="btn btn-info  shadow  w-25  mr-4 ml-4 p-1" onClick = "window.location.assign('main_clear.php')">
              <div class="row justify-content-center align-items-center">
                <div class="col p-1">
                  <i class="fas fa-eraser" style='font-size:80px;color:white'></i>
                </div>
                <div class="col">
                  <h2>เคลียร์อะไหล่</h2>
                </div>
              </div>
            </button>
          </div>


        </div>
      </div>
    </div>


</body>
</html>
<?php
  disconnect();
?>
