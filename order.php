<?php
  require_once('GMSdb/connect.inc.php');
  connect();


  $sql = "SELECT SEL_NAME FROM SELLER WHERE SEL_ID ='".$_POST['sel_id']."'";
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
      <button type="button" class="btn btn-info btn-block mt-2 shadow-sm" onClick = "window.location.assign('main_order.php')">
        <i class='fas fa-scroll' style='font-size:10px;color:white'></i>
        กลับหน้านำเข้าอะไหล่
      </button>
    </div>
    <form  action="cf.order.php" method="post" >
    <div class="row mt-3 mb-3 align-items-center">
      <div class="col-1">
        <i class="fas fa-scroll" style='font-size:65px;color:black'></i>
      </div>
      <div class="col-11">
        <?php
        $sql = "SELECT MAX(ORD_ID) FROM ORDERS";
        $sql_query = mysql_query($sql);
        $ord_id = (int)mysql_result($sql_query,0,0);
        $ord_id += 1;
        $ord_id = str_pad($ord_id, 10, "0", STR_PAD_LEFT);
        ?>
        <h3>รหัสใบนำเข้าอะไหล่ : <?php echo $ord_id ?></h3>
        <input type="hidden" name="orders_id"  value="<?php echo $ord_id?>">
      </div>
    </div>
    <div class="row justify-content-end  m-1">
      <div class="col-2">
        รหัสผู้ขาย
      </div>
      <div class="col-3">
        <?php  echo $_POST['sel_id'] ?>
        <input type="hidden" name="sel_id" value="<?php echo $_POST['sel_id'] ?>">
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
        <?php  $date = date('Y-m-d'); echo $date; ?>
        <input type="hidden" name="date" value="<?php echo $date; ?>">
      </div>
    </div>
    <div class="row justify-content-end  m-1">
      <div class="col-2 ">
        กำหนดวันได้รับ :
      </div>
      <div class="col-3">
        <input type="date" name="getdate" class="form-control" required>
      </div>
    </div>
    <div class="row justify-content-end  m-1">
      <div class="col-2">
          กำหนดชำระเงิน :
      </div>
      <div class="col-3">
        <input type="date" name="paydate" class="form-control" required>
      </div>
    </div>
    <br>
    <div class="row">
    <table class="table table-hover table-bordered">
      <thead class="thead-dark">
        <tr  align="center">
          <th>รหัส</th>
          <th>ชื่อ</th>
          <th>จำนวนคงเหลือ</th>
          <th>จำนวนที่ต้องการ</th>
        </tr>
      </thead>
        <?php
          $sql = "SELECT * FROM  PRODUCT  WHERE SEL_ID = '".$_POST["sel_id"]."' ORDER BY PRO_ID";
          $sql_query = mysql_query($sql) or die(mysql_error());
          while($row = mysql_fetch_array($sql_query)){
        ?>
        <tr>
           <td align="center">
             <?php echo $row['PRO_ID'] ?>
             <input type="hidden" name="product[]" value="<?php echo $row['PRO_ID'] ?>">
           </td>
           <td>
             <?php echo $row['PRO_NAME'] ?>
           </td>
           <td align="center">
             <?php echo $row['PRO_AMOUNT'] ?>
           </td>
           <td> <input type="number" min="0" max="999999" name="amount[]" class="form-control" size="2" autocomplete="off"> </td>
        </tr>
        <?php
         }
        ?>

    </table>
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
