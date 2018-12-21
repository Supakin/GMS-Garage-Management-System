<?php
  require_once('GMSdb/connect.inc.php');
  connect();

  //check format order id . . .
  if($_POST["ord_id"]==null || strlen($_POST["ord_id"])!=10){
      echo "<script type='text/javascript'>alert('รูปแบบหมายเลขออร์เดอร์ไม่ถูกต้อง!!');</script>" ;
      echo "<meta http-equiv ='refresh'content='0;URL=main_order.php'>";
  }else{

    //check non order id . . .
    $check = "SELECT ORD_ID FROM ORDERS WHERE ORD_ID = '".$_POST["ord_id"]."'";
    $check_query = mysql_query($check);

    if(mysql_num_rows($check_query)==0){
      echo "<script type='text/javascript'>alert('ไม่พบออร์เดอร์นี้!!');</script>" ;
      echo "<meta http-equiv ='refresh'content='0;URL=main_order.php'>";
    }else{
      //check get have . . .
      $check_get_sql = "SELECT COUNT(GPO_ID) AS CHECKGET FROM GET_PRODUCT_ORDER WHERE ORD_ID = '".$_POST["ord_id"]."' AND GPO_STATUS = 'Y'";
      $check_get_query = mysql_query($check_get_sql);
      $check_get = mysql_fetch_array($check_get_query) or die(mysql_error());
      if($check_get['CHECKGET'] > 0) {
        echo "<script type='text/javascript'>alert('ออร์เดอร์นี้ได้ทำการรับสินค้าเรียบร้อยไปแล้วค่ะ!!');</script>" ;
        echo "<meta http-equiv ='refresh'content='0;URL=main_order.php'>";
      }
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
  <div class= "container">
    <div class="row">
      <div class="col-11">
        <?php
        $sql = "SELECT MAX(GPO_ID) FROM GET_PRODUCT_ORDER";
        $sql_query = mysql_query($sql);
        $gpo_id = (int)mysql_result($sql_query,0,0);
        $gpo_id += 1;
        $gpo_id = str_pad($gpo_id, 10, "0", STR_PAD_LEFT);
        ?>
        <h3>หมายเลขการรับ : <?php echo $gpo_id ?></h3>
      </div>
      <div class="col-1 justify-content-end">
          <button type="button" class="btn default" onclick='location.replace("main_order.php")'>ปิด</button>
      </div>
    </div>
    <form method="post" action="getorder.php">
    <div class="row justify-content-center">
      <br>
    </div>
    <div class="row">
      <div class="col-2 ">
        <input type="text" class="form-control" size="2" value="หมายเลขออร์เดอร์" readonly style="border: none; background-color:transparent;">
      </div>
      <div class="col-2">
        <input type="text" name="ord_id" class="form-control" size="2" value="<?php echo $_POST['ord_id'] ?>" readonly style="border: none; background-color:transparent;" >
      </div>
      <div class="col-1">
      </div>
    </div>
    <div class="row">
      <div class="col-2 ">
        <input type="text" class="form-control" size="2" value="วันที่รับ" readonly style="border: none; background-color:transparent;">
      </div>
      <div class="col-2">
        <?php  $date = date('Y-m-d'); ?>
        <input type="text" name="getdate" class="form-control" size="2" value="<?php echo $date ?>" readonly style="border: none; background-color:transparent;" >
      </div>
      <div class="col-1">
      </div>
    </div>
    <div class="row justify-content-center">
      <br>
    </div>
    <table class="table table-hover">
      <thead>
        <tr>
          <th>รหัสสินค้า</th>
          <th>ชื่อสินค้า</th>
          <th>จำนวนที่สั่งไป</th>
          <th>รับแล้ว</th>
          <th>จำนวนที่รับ</th>
        </tr>
      </thead>
      <?php
        $sql = "SELECT PRO_ID,PRO_NAME,ORDD_AMOUNT,ORDD_STATUS FROM ORDER_DETAIL NATURAL JOIN PRODUCT WHERE ORD_ID = '".$_POST['ord_id']."'";
        $sql_query = mysql_query($sql);
        while($row = mysql_fetch_array($sql_query)){
          if($row['ORDD_STATUS']=='N'){
      ?>
          <tr>
            <td><input type="text" name="product[]" class="form-control" size="6" value="<?php echo $row['PRO_ID'] ?>" readonly style="border: none; background-color:transparent;" > </td>
            <td><?php echo $row['PRO_NAME'] ?> </td>
            <td><?php echo $row['ORDD_AMOUNT'] ?></td>
            <?php
              $sql2 = "SELECT SUM(GPOD_GETAMOUNT) FROM GET_PRODUCT_ORDER_DETAIL NATURAL JOIN GET_PRODUCT_ORDER WHERE PRO_ID = '".$row['PRO_ID']."' AND ORD_ID = '".$_POST['ord_id']."'";
              $sql2_query =  mysql_query($sql2) or die(mysql_error());
              $row2 = mysql_fetch_array($sql2_query);

            ?>
            <td><?php if($row2['SUM(GPOD_GETAMOUNT)']==null){
                        echo 0;
                      }else{
                        echo $row2['SUM(GPOD_GETAMOUNT)'];
                      } ?></td>

            <td><input type="number" name="getamount[]" class="form-control" size="2"  min="0" max="<?php echo $row['ORDD_AMOUNT']-$row2['SUM(GPOD_GETAMOUNT)'];?>"> </td>
          </tr>
      <?php
          }
        }
      ?>
    </table>
    <div class="row justify-content-center">
      <div class="col-1">
        <button type="button" class="btn default" onclick='location.replace("main_order.php")'>ยกเลิก</button>
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
