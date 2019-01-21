<?php
require_once('GMSdb/connect.inc.php');
connect();
  $rep_id = $_POST['rep_id'];
  $cus_id = $_POST['cus_id'];
  $cus_fname = $_POST['cus_fname'];
  $cus_lname = $_POST['cus_lname'];
  $cus_tel = $_POST['cus_tel'];
  $cus_address = $_POST['cus_address'];
  $date = $_POST['date'];
  $getdate = $_POST['getdate'];
  $car_license = $_POST['car_license'];
  $car_province = $_POST['car_province'];
  $car_brand = $_POST['car_brand'];
  $car_model = $_POST['car_model'];
  $car_color = $_POST['car_color'];
  $car_engine = $_POST['car_engine'];
  $car_vin = $_POST['car_vin'];
  $rep_kilomater = $_POST['rep_kilomater'];
  $rep_detail  = $_POST['rep_detail'];
  $empleader = $_POST['empleader'];
  $service = $_POST['service'];
  $seramount = $_POST['seramount'];
  $employee = $_POST['employee'];
  $product;
  $proamount;
  if(isset($_POST['product'])){
    $product = $_POST['product'];
    $proamount = $_POST['proamount'];
  }else{
    $product=null;
    $proamount= null;
  }
  $totalcostservice = 0;
  $totalcostproduct = 0;
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
    <button type="button" class="btn btn-info btn-block mt-2 shadow-sm" onClick = "window.history.go(-1);">
      <i class='fas fa-home' style='font-size:10px;color:white'></i>
      กลับก่อนหน้า
    </button>
  </div>
  <form  action="insert.data.php" method="post">
    <input type="hidden" name="action" value="addrepairslip_oldcus">
    <input type="hidden" name="checknewcar" value="<?php echo $_POST['checknewcar']; ?>">
  <div class="row mt-3 mb-3 align-items-center">
    <div class="col-1">
        <i class="fas fa-wrench" style='font-size:50px;color:black'></i>
    </div>
    <div class="col-10">
      <h3>เลขที่ใบซ่อม : <b class="text-primary"><?php echo $rep_id ?></b></h3>
      <input type="hidden" name="rep_id" value="<?php echo $rep_id ?>">
    </div>
  </div>
  <div class="row mt-3 mb-1">
    <div class="col-8">
      <label><h5>ข้อมูลลูกค้า</h5></label>
      <?php
        $updCUS = null;
        if(isset($_POST['updCUS'])){
          $updCUS = 'updCustomer';
        }else{
          $updCUS = 'notupdCustomer';
        }
      ?>
      <input type="hidden" name="updCustomer" value="<?php echo $updCUS ?>">
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
          <b class="text-primary"><?php echo $cus_id ?></b>
          <input type="hidden" name="cus_id" value="<?php echo $cus_id ?>">
        </div>
        <div class="col-4">
          <label for="cus_fname"><small>ชื่อ</small></label><br>
          <b class="text-primary"><?php echo $cus_fname ?></b>
          <input type="hidden" name="cus_fname" value="<?php echo $cus_fname ?>">
        </div>
        <div class="col-4">
          <label for="cus_lname"><small>นามสกุล</small></label><br>
          <b class="text-primary"><?php echo $cus_lname ?></b>
          <input type="hidden" name="cus_lname" value="<?php echo $cus_lname ?>">
        </div>
      </div>
      <div class="row">
        <div class="col-3">
          <label for="cus_tel"><small>เบอร์โทรติดต่อ</small></label><br>
          <b class="text-primary"><?php echo $cus_tel ?></b>
          <input type="hidden" name="cus_tel" value="<?php echo $cus_tel ?>">
        </div>
        <div class="col">
          <label for="cus_address"><small>ที่อยู่</small></label><br>
          <b class="text-primary"><?php echo $cus_address ?></b>
          <input type="hidden" name="cus_address" value="<?php echo $cus_address ?>">
        </div>
      </div>
    </div>
    <div class="col-4">
      <div class="row m-1">
        <div class="col">
          <label for="date"><small>วันแจ้งซ่อม</small></label> <br>
          <b class="text-primary"><?php echo $date ?></b>
          <input type="hidden" name="date" value="<?php echo $date ?>">
        </div>
      </div>
      <div class="row m-1">
        <div class="col">
          <label for="getdate"><small>วันรับรถ</small></label> <br>
          <b class="text-primary"><?php if($getdate==null){echo "ยังไม่มารับรถ"; }else{ echo $getdate; } ?></b>
          <input type="hidden" name="getdate" value="">
        </div>
      </div>
    </div>
  </div>
  <div class="row mt-2 mb-1">
    <div class="col">
      <label><h5>ข้อมูลรถของลูกค้า</h5></label>
      <?php
        $updCars = null;
        if(isset($_POST['updCAR'])){
          $updCars = 'updCars';
        }else{
          $updCars = 'notupdCars';
        }
      ?>
      <input type="hidden" name="updCars" value="<?php echo $updCars ?>">
    </div>
  </div>
  <div class="row m-1">
    <div class="col-2">
      <label for="car_license"><small>ทะเบียนรถ</small></label><br>
      <b class="text-primary"><?php echo $car_license ?></b>
      <input type="hidden" name="car_license" value="<?php echo $car_license ?>">
    </div>
    <div class="col-2">
      <label for="car_province"><small>จังหวัด</small></label><br>
      <b class="text-primary"><?php echo $car_province ?></b>
      <input type="hidden" name="car_province" value="<?php echo $car_province ?>">
    </div>
    <div class="col-2">
      <label for="car_brand"><small>ยี่ห้อ</small></label><br>
      <b class="text-primary"><?php echo $car_brand ?></b>
      <input type="hidden" name="car_brand" value="<?php echo $car_brand ?>">
    </div>
    <div class="col-2">
      <label for="car_model"><small>รุ่น</small></label><br>
      <b class="text-primary"><?php echo $car_model ?></b>
      <input type="hidden" name="car_model" value="<?php echo $car_model ?>">
    </div>
    <div class="col-2">
      <label for="car_color"><small>สี</small></label><br>
      <b class="text-primary"><?php echo $car_color ?></b>
      <input type="hidden" name="car_color" value="<?php echo $car_color ?>">
    </div>
  </div>
  <div class="row m-1">
    <div class="col-3">
      <label for="car_engine"><small>หมายเลขเครื่องยนต์</small></label><br>
      <b class="text-primary"><?php echo $car_engine ?></b>
      <input type="hidden" name="car_engine" value="<?php echo $car_engine ?>">
    </div>
    <div class="col-3">
      <label for="car_vin"><small>หมายเลขตัวถัง</small></label><br>
      <b class="text-primary"><?php echo $car_vin ?></b>
      <input type="hidden" name="car_vin" value="<?php echo $car_vin ?>">
    </div>
    <div class="col-3">
      <label for="rep_kilomater"><small>เลขกิโล</small></label><br>
      <b class="text-primary"><?php echo $rep_kilomater ?></b>
      <input type="hidden" name="rep_kilomater" value="<?php echo $rep_kilomater ?>">
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
      <b class="text-primary"><?php echo $rep_detail ?></b>
      <input type="hidden" name="rep_detail" value="<?php echo $rep_detail ?>">
    </div>
    <div class="col-4">
      <?php
        $empsql = "SELECT EMP_FNAME, EMP_LNAME FROM EMPLOYEE WHERE EMP_ID = \"$empleader\"";
        $emplead = mysql_query($empsql) or die(mysql_error());
        $empleadresult = mysql_fetch_array($emplead);
       ?>
      <b class="text-primary"><?php echo $empleadresult['EMP_FNAME']."   ".$empleadresult['EMP_LNAME'] ?></b>
      <input type="hidden" name="empleader" value="<?php echo $empleader ?>">
    </div>
  </div>
  <div class="row m-2 justify-content-center">
    <div class="col">
      <h5>บริการ/อะไหล่</h5>
    </div>
  </div>
  <div class="row">
    <?php if($product !=null){ echo "<div class='col-6'>";  }else{ echo "<div class='col-12'>"; }  ?>
      <table class="table table-bordered table-sm" id="myTable">
        <thead>
          <tr align="center">
            <th width="5%">ลำดับ</th>
            <th width="35%">บริการ</th>
            <th width= "5%">จำนวน</th>
            <th width= "10%">ราคา</th>
            <th width="20%">ผู้ซ่อม</th>
          </tr>
        </thead>
        <?php
        for($i=0;$i < count($service);$i++){
            $sql = "SELECT * FROM SERVICE WHERE SER_ID = \"$service[$i]\"";
            $sql_query = mysql_query($sql) or die (mysql_error());
            $result = mysql_fetch_array($sql_query);
            $emp = "SELECT EMP_FNAME, EMP_LNAME FROM EMPLOYEE WHERE EMP_ID = \"$employee[$i]\"";
            $emp_query = mysql_query($emp) or die (mysql_error());
            $resultemp = mysql_fetch_array($emp_query);
        ?>
            <tr>
              <td align="center"><?php echo $i+1; ?></td>
              <td><?php echo $result['SER_NAME'] ?></td>
              <td align="center"><?php echo $seramount[$i] ?></td>
              <td align="center"><?php echo $seramount[$i]*$result['SER_BEGINCOST'] ?></td>
              <td><?php echo $resultemp['EMP_FNAME']."  ".$resultemp['EMP_LNAME'] ?></td>
              <input type="hidden" name="service[]" value="<?php echo $result['SER_ID'] ?>">
              <input type="hidden" name="seramount[]" value="<?php echo $seramount[$i] ?>">
              <input type="hidden" name="sertotalcost[]" value="<?php echo $seramount[$i]*$result['SER_BEGINCOST'] ?>">
              <input type="hidden" name="employee[]" value="<?php echo $employee[$i] ?>">
            </tr>
        <?php
          $totalcostservice += ($seramount[$i]*$result['SER_BEGINCOST']);
        }
        ?>
      </table>
    </div>
    <?php if($product != null){ ?>
    <div class="col-6">
      <table class="table table-bordered table-sm" id="myTable">
        <thead>
          <tr align="center">
            <th width="5%">ลำดับ</th>
            <th width="30%">อะไหล่</th>
            <th width="10%">ราคาต่อชิ้น</th>
            <th width= "5%">จำนวน</th>
            <th width="10%">ราคารวม</th>
          </tr>
        </thead>
        <?php
        for($i=0;$i < count($product);$i++){
            $sql = "SELECT * FROM PRODUCT WHERE PRO_ID = \"$product[$i]\"";
            $sql_query = mysql_query($sql) or die (mysql_error());
            $result = mysql_fetch_array($sql_query);
        ?>
            <tr>
              <td align="center"><?php echo $i+1; ?></td>
              <td><?php echo $result['PRO_NAME'] ?></td>
              <td align="center"><?php echo $result['PRO_SELLPRICE'] ?></td>
              <td align="center"><?php echo $proamount[$i] ?></td>
              <td align="center"><?php echo $proamount[$i]*$result['PRO_SELLPRICE'] ?></td>
              <input type="hidden" name="product[]" value="<?php echo $result['PRO_ID'] ?>">
              <input type="hidden" name="procost[]" value="<?php echo $result['PRO_SELLPRICE'] ?>">
              <input type="hidden" name="proamount[]" value="<?php echo $proamount[$i] ?>">
              <input type="hidden" name="prototalcost[]" value="<?php echo $proamount[$i]*$result['PRO_SELLPRICE'] ?>">
            </tr>
        <?php
          $totalcostproduct += ($proamount[$i]*$result['PRO_SELLPRICE']);
        }
        ?>
      </table>
    </div>
    <?php } ?>
  </div>
  <div class="row mt-2  justify-content-end">
    <div class="col-5">
      <div class="row">
        <div class="col-4">
          <small>รวมค่าบริการ</small>
        </div>
        <div class="col-3 text-right">
          <b class="text-primary"><?php echo $totalcostservice ?></b>
          <input type="hidden" name="totalcostservice" value="<?php echo $totalcostservice ?>">
        </div>
        <div class="col-4">
          <small>บาท</small>
        </div>
      </div>
      <div class="row">
        <div class="col-4">
          <small>รวมค่าอะไหล่</small>
        </div>
        <div class="col-3 text-right">
          <b class="text-primary"><?php echo $totalcostproduct ?></b>
          <input type="hidden" name="totalcostproduct" value="<?php echo $totalcostproduct ?>">
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
          <b class="text-primary"><?php echo $totalcostservice+$totalcostproduct ?></b>
          <input type="hidden" name="totalcost" value="<?php echo $totalcostservice+$totalcostproduct ?>">
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
            <?php
            $nettotalcost = ($totalcostservice+$totalcostproduct)+(($totalcostservice+$totalcostproduct)*0.07) ;
            $nettotalcost = number_format($nettotalcost,2);
            echo $nettotalcost;
            ?>
            </b>
          </h5>
          <input type="hidden" name="nettotalcost" value="<?php echo $nettotalcost; ?>">
        </div>
        <div class="col-4">
          <small>บาท</small>
        </div>
      </div>
    </div>
  </div>
  <div class="row justify-content-center mt-5 mb-1 ">
    <h5 class="text-danger"> ** กรุณาตรวจสอบข้อมูลของลูกค้าให้ถูกต้องก่อนกดยืนยัน **</h5>
  </div>
  <div class="row justify-content-center mt-1 mb-5">
      <button type="submit" name="save" class="btn btn-success btn-block shadow-sm">ยืนยัน</button>
  </div>
  </form>
</div>
</body>
</html>
<?php
  disconnect();
?>
