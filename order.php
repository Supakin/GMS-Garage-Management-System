<?php
  require_once('GMSdb/connect.inc.php');
  connect();
    $ord_id = $_POST['orders_id'];
    $sel_id;
    $date;
    $sumtotal = 0;
    $product =$_POST['product'];
    $amount = $_POST['amount'];
    for($i=0;$i<count($amount);$i++){
      if($amount[$i]==null|| $amount[$i]==0){
        unset($amount[$i]);
        unset($product[$i]);
      }
    }

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
<form action="addorder.php" method="post" >
    <div class="row">
      <div class="col-6">
        <h3>หมายเลขออเดอร์ : <?php echo $ord_id ?></h3>
      </div>
      <div class="col-5">
        <input type="text" name="orders_id" class="form-control" value="<?php echo $ord_id?>" readonly style="border: none; background-color:transparent; color: white;" size="1">

      </div>
      <div class="col-1">
        <button type="button" class="btn default" onclick='location.replace("main_order.php")'>ปิด</button>
      </div>
    </div>
    <div class="row">
      <br>
    </div>
    <div class="row justify-content-end">
      <div class="col-2 ">
        <input type="text"  class="form-control" size="2" value="รหัสผู้ขาย" readonly style="border: none; background-color:transparent;">
      </div>
      <div class="col-2">
        <?php
          $sql = "SELECT SEL_ID FROM PRODUCT WHERE PRO_ID=\"$product[0]\"";
          $sql_query = mysql_query($sql);
          $row =  mysql_fetch_array($sql_query);
          $sel_id = $row['SEL_ID'];
        ?>
        <input type="text" name="sel_id" class="form-control" size="2" value="<?php echo $sel_id?>" readonly style="border: none; background-color:transparent;" >
      </div>
      <div class="col-1">
      </div>
    </div>
    <div class="row justify-content-end">
      <div class="col-2 ">
        <input type="text" class="form-control" size="2" value="วันที่สั่ง" readonly style="border: none; background-color:transparent;">
      </div>
      <div class="col-2">
        <?php  $date = date('Y-m-d'); ?>
        <input type="text" name="date" class="form-control" size="2" value="<?php echo $date ?>" readonly style="border: none; background-color:transparent;" >
      </div>
      <div class="col-1">
      </div>
    </div>
    <div class="row justify-content-end">
      <div class="col-2 ">
        <input type="text"  class="form-control" size="2" value="วันที่ได้รับ" readonly style="border: none; background-color:transparent;">
      </div>
      <div class="col-2">
        <?php $ord_getdate=$_POST['getdate']; ?>
        <input type="text" name="getdate" class="form-control" size="2" value="<?php echo $ord_getdate ?>" readonly style="border: none; background-color:transparent;" >
      </div>
      <div class="col-1">
      </div>
    </div>
    <div class="row justify-content-end">
      <div class="col-2">
          <input type="text" class="form-control" size="2" value="กำหนดชำระเงิน" readonly style="border: none; background-color:transparent;">
      </div>
      <div class="col-2">
        <?php $ord_paydate=$_POST['paydate'];  ?>
        <input type="text" name="paydate" class="form-control" size="2" value="<?php echo $ord_paydate ?>" readonly style="border: none; background-color:transparent;" >
      </div>
      <div class="col-1">
      </div>
    </div>
    <div class="row">
      <br>
    </div>

    <table class="table table-hover">
      <thead>
        <tr>
          <th>รหัสสินค้า</th>
          <th>ชื่อสินค้า</th>
          <th>ราคา/ชิ้น</th>
          <th>จำนวน</th>
          <th>ราคารวม</th>
        </tr>
      </thead>

      <?php
      foreach ($amount as $key => $value) {
        $sql = "SELECT PRO_ID, PRO_NAME, PRO_BUYPRICE FROM PRODUCT WHERE PRO_ID=\"$product[$key]\"";
        $sql_query = mysql_query($sql);
        while($row = mysql_fetch_assoc($sql_query)){


      ?>
          <tr>
            <td><input type="text" name="product[]" class="form-control" size="2" value="<?php echo $row['PRO_ID'] ?>" readonly style="border: none; background-color:transparent;" > </td>
            <td><?php echo $row['PRO_NAME'] ?> </td>
            <td><?php echo $row['PRO_BUYPRICE'] ?> </td>
            <td><input type="text" name="amount[]" class="form-control" size="2" value="<?php echo $value ?>" readonly style="border: none; background-color:transparent;" > </td>
            <td><?php $sumtotal += $row['PRO_BUYPRICE']*$value; ?><input type="text" name="totalprice[]" class="form-control" size="2" value="<?php echo $row['PRO_BUYPRICE']*$value ?>" readonly style="border: none; background-color:transparent;" >
               </td>
          </tr>
      <?php
        }
      }
      ?>
    </table>
    <div class="row justify-content-end">
      <div class="col-2 ">
        <input type="text"  class="form-control" size="2" value="ราคารวมทั้งหมด" readonly style="border: none; background-color:transparent;">
      </div>
      <div class="col-2">
        <input type="text" name="sumtotal" class="form-control" size="2" value="<?php echo $sumtotal ?>" readonly style="border: none; background-color:transparent;" >
      </div>
      <div class="col-1">
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-1">
        <button type="button" class="btn default" onclick='location.replace("main_addorder.php")'>ยกเลิก</button>
      </div>
      <div class="col-1">
        <button type="submit" name="save" class="btn btn-success" >ยืนยัน</button>
      </div>
    </div>
  </form>
  </div>
</body>
</html>
<?php
  disconnect();
?>
