<?php
  require_once('GMSdb/connect.inc.php');
  connect();
  if($_POST["sel_id"]==null || strlen($_POST["sel_id"])!=8){
      echo "<script type='text/javascript'>alert('รูปแบบรหัสคู่ค้าไม่ถูกต้อง!!');window.history.go(-1);</script>" ;
  }

  $check = "SELECT SEL_ID FROM SELLER WHERE SEL_ID = '".$_POST["sel_id"]."'";
  $check_query = mysql_query($check);

  if(mysql_num_rows($check_query)==0){
      echo "<script type='text/javascript'>alert('ไม่พบคู่ค้านี้!!');window.history.go(-1);</script>" ;
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
  <form name="makeorder" action="order.php" method="post" >
  <div class="container">
    <div class="row">
      <div class="col-6">
        <?php
        $sql = "SELECT MAX(ORD_ID) FROM ORDERS";
        $sql_query = mysql_query($sql);
        $ord_id = (int)mysql_result($sql_query,0,0);
        $ord_id += 1;
        $ord_id = str_pad($ord_id, 10, "0", STR_PAD_LEFT);
        ?>
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
        รหัสผู้ขาย
      </div>
      <div class="col-3">
        <?php  echo $_POST['sel_id'] ?>
      </div>
      <div class="col-1">
      </div>
    </div>
    <div class="row">
      <br>
    </div>
    <div class="row justify-content-end">
      <div class="col-2 ">
        วันที่สั่ง :
      </div>
      <div class="col-3">
        <?php  $date = date('Y-m-d'); echo $date; ?>
      </div>
      <div class="col-1">
      </div>
    </div>
    <div class="row">
      <br>
    </div>
    <div class="row justify-content-end">
      <div class="col-2 ">
        วันที่ได้รับ :
      </div>
      <div class="col-3">
        <input type="date" name="getdate" class="form-control" >
      </div>
      <div class="col-1">
      </div>
    </div>
    <div class="row">
      <br>
    </div>
    <div class="row justify-content-end">
      <div class="col-2">
          กำหนดชำระเงิน :
      </div>
      <div class="col-3">
        <input type="date" name="paydate" class="form-control" >
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
          <th>จำนวนคงเหลือ</th>
          <th>จำนวนที่ต้องการ</th>
        </tr>
      </thead>
        <?php
          $sql = "SELECT * FROM  PRODUCT  WHERE SEL_ID = '".$_POST["sel_id"]."'";
          $sql_query = mysql_query($sql);
          while($row = mysql_fetch_array($sql_query)){
        ?>
        <tr>
           <td><input type="text" name="product[]" class="form-control" value="<?php echo $row['PRO_ID'] ?>" readonly style="border: none; background-color:transparent;" size="1"></td>
           <td><?php echo $row['PRO_NAME'] ?> </td>
           <td><?php echo $row['PRO_AMOUNT'] ?> </td>
           <td> <input type="text" name="amount[]" class="form-control" size="2"> </td>
        </tr>
        <?php
         }
        ?>

    </table>
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
