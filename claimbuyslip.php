<?php
  require_once('GMSdb/connect.inc.php');
  connect();
  $buy_id = $_POST['buy_id'];
  $sql = "SELECT * FROM BUYSLIP WHERE BUY_ID = $buy_id ";
  $sql_query =  mysql_query($sql) or die(mysql_error());
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
      <button type="button" class="btn btn-info btn-block mt-2 shadow-sm" onClick = "window.location.replace('main_buy.php')">
        <i class='fab fa-bitcoin' style='font-size:10px;color:white'></i>
        กลับก่อนหน้า
      </button>
    </div>
    <form  action="cf.claimbuyslip.php" method="post" >
    <div class="row mt-3 mb-3 align-items-center">
      <div class="col-1">
        <i class="fas fa-ambulance" style='font-size:65px;color:black'></i>
      </div>
      <div class="col-11">
        <?php
        $sql = "SELECT MAX(CLB_ID) FROM CLAIMSLIP_BUY";
        $sql_query = mysql_query($sql);
        $clb_id = (int)mysql_result($sql_query,0,0);
        $clb_id += 1;
        $clb_id = str_pad($clb_id, 10, "0", STR_PAD_LEFT);
        ?>
        <h3>รหัสการเคลมจากลูกค้า : <?php echo $clb_id ?></h3>
        <input type="hidden" name="clb_id"  value="<?php echo $clb_id?>">
      </div>
    </div>
    <div class="row justify-content-end  m-1">
      <div class="col-2 ">
        เลขที่ใบเสร็จ :
      </div>
      <div class="col-3">
        <?php echo $buy_id ?>
        <input type="hidden" name="buy_id"  value="<?php echo $buy_id?>">
      </div>
    </div>
    <div class="row justify-content-end  m-1">
      <div class="col-2">
        วันที่ซื้อ :
      </div>
      <div class="col-3">
        <?php  echo $result['BUY_DATE'] ?>
      </div>
    </div>
    <div class="row justify-content-end  m-1">
      <div class="col-2">
        วันที่เคลม :
      </div>
      <div class="col-3">
        <?php  $date = date('Y-m-d'); echo $date; ?>
        <input type="hidden" name="date" value="<?php echo $date; ?>">
      </div>
    </div>
    <div class="row justify-content-end  m-1">
      <div class="col-2">
        กำหนดวันได้รับ :
      </div>
      <div class="col-3">
        <input type="date" name="getdate" class="form-control" required>
      </div>
    </div>
    <br>
    <div class="row">
    <table class="table table-hover table-bordered">
      <thead class="thead-dark">
        <tr  align="center">
          <th>รหัส</th>
          <th>ชื่อ</th>
          <th>จำนวนที่ซื้อ</th>
          <th>จำนวนที่เคลม</th>
          <th>หมายเหตุ</th>
        </tr>
      </thead>
        <?php
        $sql = "SELECT * FROM (BUYSLIP NATURAL JOIN BUYSLIP_DETAIL) NATURAL JOIN PRODUCT WHERE BUY_ID = $buy_id ";
        $sql_query =  mysql_query($sql) or die(mysql_error());
        while($row = mysql_fetch_array($sql_query)){
          $sql2 = "SELECT SUM(CLBD_AMOUNT) FROM (CLAIM_BUY_DETAIL NATURAL JOIN CLAIMSLIP_BUY) NATURAL JOIN BUYSLIP WHERE BUY_ID = '".$_POST['buy_id']."' AND PRO_ID = '".$row['PRO_ID']."' AND CLBD_STATUS = 'N' ";
          $sql2_query = mysql_query($sql2) or die(mysql_error());

          $claimamount = mysql_fetch_array($sql2_query);

          $ca = 0;
          if($claimamount['SUM(CLBD_AMOUNT)'] != null){
            $ca = $claimamount['SUM(CLBD_AMOUNT)'];
          }

          if(($row['BUYD_AMOUNT'] - $ca)  != 0){
        ?>
        <tr>
           <td align="center">
             <?php echo $row['PRO_ID'] ?>
             <input type="hidden" name="product[]" value="<?php echo $row['PRO_ID'] ?>">
           </td>
           <td>
             <?php echo $row['PRO_NAME'] ?>
             <input type="hidden" name="productname[]" value="<?php echo $row['PRO_NAME'] ?>">
           </td>
           <td align="center">
             <?php echo $row['BUYD_AMOUNT'] ?>
             <input type="hidden" name="buyamount[]" value="<?php echo $row['BUYD_AMOUNT'] ?>">
           </td>
           <td>
             <input type="number" min="0" max="<?php echo ($row['BUYD_AMOUNT'] - $ca) ?>" name="amount[]" class="form-control" size="2" autocomplete="off">
           </td>
           <td>
             <textarea name="descript[]" rows="2" maxlength="200" style="width:100%;"></textarea>
           </td>
        </tr>
        <?php
            }
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
