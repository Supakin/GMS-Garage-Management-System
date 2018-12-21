<?php
  require_once('GMSdb/connect.inc.php');
  connect();
  $ord_id = $_POST['ord_id'];
  $set_ord_sql = "SELECT * FROM ORDERS WHERE ORD_ID = \"$ord_od\"";
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

<!--font-Thai-->
<link href="https://fonts.googleapis.com/css?family=Athiti" rel="stylesheet">

</head>
<body id="main">
<div class="container">
  <form name="makepayorder" action="main_getorder.php" method="post" >
  <div class="row">
    <div class="col-10">
      <?php
      $create_payo_id_sql = "SELECT MAX(PAYO_ID) FROM PAYMENT_ORDER";
      $create_payo_id_query = mysql_query($create_payo_id_sql);
      $payo_id = (int)mysql_result($create_payo_id_query,0,0);
      $payo_id += 1;
      $payo_id = str_pad($payo_id, 10, "0", STR_PAD_LEFT);
      ?>
      <h3>หมายเลขการชำระเงิน : <?php echo $payo_id ?></h3>
    </div>
    <div class="col-1">
      <button type="button" class="btn default" onclick='location.replace("main_order.php")'>ปิด</button>
    </div>
  </div>
  <div class="row">
    <br>
  </div>
  <div class="row">
    <div class="col-2 ">
      <input type="text" class="form-control" size="2" value="หมายเลขออร์เดอร์" readonly style="border: none; background-color:transparent;">
    </div>
    <div class="col-2">
      <input type="text" name="ord_id" class="form-control" size="2" value="<?php echo $_POST['ord_id'] ?>" readonly style="border: none; background-color:transparent;" >
    </div>
  </div>
  <div class="row justify-content-start">
    <div class="col-2 ">
      รหัสผู้ขาย
    </div>
    <div class="col-2">
      <b><?php echo $row['SEL_ID']; ?></b>
    </div>
  </div>
  <div class="row justify-content-start">
    <div class="col-2 ">
      วันที่สั่ง
    </div>
    <div class="col-2">
      <b><?php echo $row['ORD_DATE']; ?></b>
    </div>
  </div>
  <div class="row justify-content-start">
    <div class="col-2 ">
      กำหนดวันได้รับ
    </div>
    <div class="col-2">
      <b><?php echo $row['ORD_GETDATE']; ?></b>
    </div>
  </div>
  <div class="row justify-content-start">
    <div class="col-2 ">
      กำหนดชำระเงิน
    </div>
  <div class="col-2">
    <b><?php echo $row['ORD_PAYDATE']; ?></b>
  </div>
    </div>
  </div>
  <div class="row">
    <div class="col-2 ">
      <input type="text" class="form-control" size="2" value="วันที่ชำระเงิน" readonly style="border: none; background-color:transparent;">
    </div>
    <div class="col-2">
      <input type="date" name="paydate" class="form-control" >
    </div>
  </div>
  <div class="row">
    <br>
  </div>
  <table class="table table-hover">
    <thead>
      <tr>
        <th>ลำดับ</th>
        <th>รหัสสินค้า</th>
        <th>ชื่อสินค้า</th>
        <th>จำนวน</th>
        <th>ราคารวม</th>
      </tr>
    </thead>
    <?php
      $set_ordd_sql = "SELECT * FROM ORDER_DETAIL NATURAL JOIN PRODUCT WHERE ORD_ID = \"$ord_id\" ORDER BY ORD_ID,ORDD_NUMBER";
      $set_ordd_query =mysql_query($set_ordd_sql) or die(mysql_error());
      $i=1;
      while($set_ordd = mysql_fetch_array($set_ordd_query)){
    ?>
        <tr>
          <td><?php echo $i ?></td>
          <td><?php echo $set_ordd['PRO_ID'] ?></td>
          <td><?php echo $set_ordd['PRO_NAME'] ?></td>
          <td><?php echo $set_ordd['ORDD_AMOUNT'] ?></td>
          <td><?php echo $set_ordd['ORDD_TOTALPRICE'] ?></td>
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

  <div class="row justify-content-center">
    <div class="col-1">
      <button type="button" class="btn default" onclick='location.replace("main_order.php")'>ยกเลิก</button>
    </div>
    <div class="col-1">
      <button type="submit" name="save" class="btn btn-success">ยืนยัน</button>
    </div>
  </div>
</form>






</div>
</body>
</html>
<?php
  disconnect();
?>
