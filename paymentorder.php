<?php
  require_once('GMSdb/connect.inc.php');
  connect();
  $ord_id = $_POST['ord_id'];
  $set_ord_sql = "SELECT * FROM (ORDERS NATURAL JOIN ORDER_DETAIL) NATURAL JOIN SELLER WHERE ORD_ID = \"$ord_id\" ORDER BY ORDD_NUMBER";
  $set_ord_query = mysql_query($set_ord_sql) or die(mysql_error());
  $set_ord = mysql_fetch_array($set_ord_query);
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
    <button type="button" class="btn btn-info btn-block mt-2 shadow-sm" onClick = "window.location.replace('main_order.php')">
      <i class='fas fa-scroll' style='font-size:10px;color:white'></i>
      กลับหน้านำเข้าอะไหล่
    </button>
  </div>
  <form name="makepayorder" action="insert.data.php" method="post" >
    <input type="hidden" name="action" value="addpaymentorder">
  <div class="row row mt-3 mb-3 align-items-center">
    <div class="col-1">
      <i class="fas fa-wallet" style='font-size:65px;color:black'></i>
    </div>
    <div class="col-11">
      <?php
      $create_payo_id_sql = "SELECT MAX(PAYO_ID) FROM PAYMENT_ORDER";
      $create_payo_id_query = mysql_query($create_payo_id_sql);
      $payo_id = (int)mysql_result($create_payo_id_query,0,0);
      $payo_id += 1;
      $payo_id = str_pad($payo_id, 10, "0", STR_PAD_LEFT);
      ?>
      <h3>รหัสการชำระเงิน : <?php echo $payo_id ?></h3>
      <input type="hidden" name="payo_id"  value="<?php echo $payo_id ?>">
    </div>
  </div>
  <div class="row justify-content-end  m-1">
    <div class="col-2 ">
      รหัสใบนำเข้าอะไหล่ :
    </div>
    <div class="col-3">
      <?php echo $ord_id ?>
      <input type="hidden" name="ord_id"  value="<?php echo $ord_id ?>">
    </div>
  </div>
  <div class="row justify-content-end  m-1">
    <div class="col-2 ">
      รหัสผู้ขาย :
    </div>
    <div class="col-3">
      <?php echo $set_ord['SEL_ID'] ?>
    </div>
  </div>
  <div class="row justify-content-end  m-1">
    <div class="col-2 ">
      ชื่อผู้ขาย :
    </div>
    <div class="col-3">
      <?php echo $set_ord['SEL_NAME'] ?>
    </div>
  </div>
  <div class="row justify-content-end  m-1">
    <div class="col-2 ">
      กำหนดวันได้รับ :
    </div>
    <div class="col-3">
      <?php echo $set_ord['ORD_DATE'] ?>
    </div>
  </div>
  <div class="row justify-content-end  m-1">
    <div class="col-2 ">
      กำหนดวันชำระเงิน :
    </div>
    <div class="col-3">
      <?php echo $set_ord['ORD_PAYDATE'] ?>
    </div>
  </div>
  <div class="row justify-content-end  m-1">
    <div class="col-2 ">
      วันชำระเงิน :
    </div>
    <div class="col-3">
      <input type="date" name="date" class="form-control" required>
    </div>
  </div>
  <br>
  <div class="row">
  <table class="table table-hover table-bordered">
    <thead class="thead-dark">
      <tr  align="center">
        <th>รายการที่</th>
        <th>รหัสสินค้า</th>
        <th>ชื่อสินค้า</th>
        <th>จำนวน</th>
        <th>ราคารวม</th>
      </tr>
    </thead>
    <?php
      $set_ordd_sql = "SELECT * FROM ORDER_DETAIL NATURAL JOIN PRODUCT WHERE ORD_ID = \"$ord_id\" ORDER BY ORDD_NUMBER";
      $set_ordd_query =mysql_query($set_ordd_sql) or die(mysql_error());
      $i=1;
      while($set_ordd = mysql_fetch_array($set_ordd_query)){
    ?>
        <tr>
          <td  align="center"><?php echo $i ?></td>
          <td  align="center"><?php echo $set_ordd['PRO_ID'] ?></td>
          <td><?php echo $set_ordd['PRO_NAME'] ?></td>
          <td  align="center"><?php echo $set_ordd['ORDD_AMOUNT'] ?></td>
          <td  align="center"><?php echo $set_ordd['ORDD_TOTALPRICE'] ?></td>
        </tr>
    <?php
    $i++;
      }
    ?>
  </table>
  </div>
  <div class="row justify-content-end align-content-center mt-2 mb-2">
    <div class="col-2 ">
      ราคารวมทั้งหมด
    </div>
    <div class="col-2  justify-content-center" >
      <h3><?php echo $set_ord['ORD_TOTALPRICE'] ?></h3>
    </div>
    <div class="col-1">
      บาท
    </div>
  </div>
  <div class="row justify-content-end align-content-center mt-4 mb-4">
    <div class="col-2 ">
       ยอดที่ชำระ
    </div>
    <div class="col-2  justify-content-center" >
      <input type="number" name="price" class="form-control"  min="<?php echo $set_ord['ORD_TOTALPRICE']?>" max="<?php echo $set_ord['ORD_TOTALPRICE']?>" required>
    </div>
    <div class="col-1">
      บาท
    </div>
  </div>
  <div class="row justify-content-center text-red m-2">
    ** กรุณาตรวจสอบให้ข้อมูลให้ถูกต้องก่อนกดยืนยัน **
  </div>
  <div class="row justify-content-center mb-5">
      <button type="submit" name="save" class="btn btn-success btn-block shadow-sm">ยืนยัน</button>
  </div>
</form>
</div>
</body>
</html>
<?php
  disconnect();
?>
