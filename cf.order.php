<?php
  require_once('GMSdb/connect.inc.php');
  connect();
    $ord_id = $_POST['orders_id'];
    $sel_id = $_POST['sel_id'];
    $date = $_POST['date'];
    $getdate = $_POST['getdate'];
    $paydate = $_POST['paydate'];
    $sumtotal = 0;
    $p =  $_POST['product'];
    $a = $_POST['amount'];
    $product = array();
    $amount = array();

    for($i=0;$i<count($p);$i++){
      if($a[$i]!=null && $a[$i]!=0){
        $product[] = $p[$i];
        $amount[] = $a[$i];
      }
    }

    $sql = "SELECT SEL_NAME FROM SELLER WHERE SEL_ID = \"$sel_id\"";
    $sql_query = mysql_query($sql) or die(mysql_error());
    $result = mysql_fetch_array($sql_query);

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
    <button type="button" class="btn btn-info btn-block mt-2 shadow-sm" onClick =" window.history.go(-1)">
      <i class='fas fa-scroll' style='font-size:10px;color:white'></i>
      กลับไปแก้ไขข้อมูลใบสั่งอะไหล่
    </button>
  </div>
  <form  action="insert.data.php" method="post" >
  <input type="hidden" name="action" value="addorder">
  <div class="row mt-3 mb-3 align-items-center">
    <div class="col-1">
      <i class="fas fa-scroll" style='font-size:65px;color:black'></i>
    </div>
    <div class="col-11">
      <h3>รหัสใบนำเข้าอะไหล่ : <?php echo $ord_id ?></h3>
      <input type="hidden" name="orders_id"  value="<?php echo $ord_id;?>">
    </div>
  </div>
  <div class="row justify-content-end  m-1">
    <div class="col-2">
      รหัสผู้ขาย
    </div>
    <div class="col-3">
      <?php  echo $_POST['sel_id'] ?>
      <input type="hidden" name="sel_id" value="<?php echo $sel_id; ?>">
    </div>
  </div>
  <div class="row justify-content-end  m-1">
    <div class="col-2">
      ชื่อผู้ขาย
    </div>
    <div class="col-3">
      <?php  echo $result['SEL_NAME'] ?>
    </div>
  </div>
  <div class="row justify-content-end  m-1">
    <div class="col-2 ">
      วันที่สั่ง :
    </div>
    <div class="col-3">
      <?php echo $date; ?>
      <input type="hidden" name="date" value="<?php echo $date; ?>">
    </div>
  </div>
  <div class="row justify-content-end  m-1">
    <div class="col-2 ">
      กำหนดวันได้รับ :
    </div>
    <div class="col-3">
      <?php echo $getdate ?>
      <input type="hidden" name="getdate" value="<?php echo $getdate; ?>">
    </div>
  </div>
  <div class="row justify-content-end  m-1">
    <div class="col-2">
      กำหนดชำระเงิน :
    </div>
    <div class="col-3">
      <?php echo $paydate ?>
      <input type="hidden" name="paydate" value="<?php echo $paydate; ?>">
    </div>
  </div>
  <br>
  <div class="row">
    <table class="table table-hover table-bordered">
      <thead class="thead-dark">
        <tr align="center">
          <th>รายการที่</th>
          <th>รหัส</th>
          <th>ชื่อ</th>
          <th>ราคา/ชิ้น</th>
          <th>จำนวน</th>
          <th>ราคารวม</th>
        </tr>
      </thead>

      <?php
        for($i=0;$i<count($product);$i++){
        $sql = "SELECT PRO_ID, PRO_NAME, PRO_BUYPRICE FROM PRODUCT WHERE PRO_ID=\"$product[$i]\"";
        $sql_query = mysql_query($sql) or die(mysql_error());
        while($row = mysql_fetch_assoc($sql_query)){
      ?>
          <tr>
            <td align="center">
              <?php echo $i+1; ?>
            </td>
            <td align="center">
              <?php echo $row['PRO_ID'] ?>
              <input type="hidden" name="product[]" value="<?php echo $row['PRO_ID'] ?>">
            </td>
            <td>
              <?php echo $row['PRO_NAME'] ?>
            </td>
            <td align="center">
              <?php echo $row['PRO_BUYPRICE'] ?>
            </td>
            <td align="center">
              <?php echo $amount[$i] ?>
              <input type="hidden" name="amount[]" value="<?php echo $amount[$i] ?>">
            </td>
            <td>
              <?php echo $row['PRO_BUYPRICE']*$amount[$i] ?>
              <input type="hidden" name="totalprice[]" value="<?php echo $row['PRO_BUYPRICE']*$amount[$i] ?>">
               </td>
          </tr>
      <?php
          $sumtotal += $row['PRO_BUYPRICE']*$amount[$i];
        }
      }
      ?>
      </table>
    </div>
    <div class="row justify-content-end align-content-center mt-2 mb-2">
      <div class="col-2 ">
        ราคารวมทั้งหมด
      </div>
      <div class="col-2  justify-content-center" >
        <h3><?php echo $sumtotal ?></h3>
        <input type="hidden" name="sumtotal" value="<?php echo $sumtotal ?>">
      </div>
      <div class="col-1">
        บาท
      </div>
    </div>
    <div class="row justify-content-center text-red m-2">
      ** กรุณาตรวจสอบให้ข้อมูลให้ถูกต้องก่อนกดยืนยัน **
    </div>
    <div class="row justify-content-center">
      <button type="submit" name="save" class="btn btn-success btn-block shadow-sm">ยืนยัน</button>
    </div>
  </form>
  </div>
</body>
</html>
<?php
  disconnect();
?>
