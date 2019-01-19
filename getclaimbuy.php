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
<body>
  <div class= "container">
    <div class="row justify-content-center align-content-center">
      <button type="button" class="btn btn-info btn-block mt-2 shadow-sm" onClick = "window.location.replace('main_buy.php')">
        <i class='fas fa-scroll' style='font-size:10px;color:white'></i>
        กลับหน้าก่อนหน้า
      </button>
    </div>
    <form method="post" action="cf.getclaimorder.php">
    <div class="row mt-3 mb-3 align-items-center">
      <div class="col-1">
        <i class="fas fa-truck" style='font-size:65px;color:black'></i>
      </div>
      <div class="col-11">
        <?php
        $sql = "SELECT MAX(GPCB_ID) FROM GET_PRODUCT_CLAIM_BUY";
        $sql_query = mysql_query($sql);
        $gpcb_id = (int)mysql_result($sql_query,0,0);
        $gpcb_id += 1;
        $gpcb_id = str_pad($gpcb_id, 10, "0", STR_PAD_LEFT);
        ?>
        <h3>รหัสการรับเคลม : <?php echo $gpcb_id ?></h3>
        <input type="hidden" name="gpcb_id"  value="<?php echo $gpcb_id?>">
      </div>
    </div>
    <?php
      $sql = "SELECT * FROM (BUYSLIP NATURAL JOIN CLAIMSLIP_BUY) WHERE CLB_ID = '".$_POST['clb_id']."'";
      $sql_query = mysql_query($sql) or die(mysql_error());
      $result = mysql_fetch_array($sql_query);
    ?>
    <div class="row justify-content-end  m-1">
      <div class="col-2 ">
        รหัสการเคลม :
      </div>
      <div class="col-3">
        <?php echo $_POST['clb_id'] ?>
        <input type="hidden" name="clo_id"  value="<?php echo $_POST['clb_id']?>">
      </div>
    </div>
    <div class="row justify-content-end  m-1">
      <div class="col-2 ">
        เลขที่ใบเสร็จ :
      </div>
      <div class="col-3">
        <?php echo $result['BUY_ID'] ?>
        <input type="hidden" name="buy_id"  value="<?php echo  $result['BUY_ID']?>">
      </div>
    </div>
    <div class="row justify-content-end  m-1">
      <div class="col-2 ">
      วันที่เคลม :
      </div>
      <div class="col-3">
        <?php echo $result['CLB_DATE'] ?>
        <input type="hidden" name="clb_date"  value="<?php echo  $result['CLB_DATE']?>">
      </div>
    </div>
    <div class="row justify-content-end  m-1">
      <div class="col-2 ">
        กำหนดวันที่ได้รับ :
      </div>
      <div class="col-3">
        <?php echo $result['CLB_GETDATE'] ?>
        <input type="hidden" name="clb_getdate"  value="<?php echo  $result['CLB_GETDATE']?>">
      </div>
    </div>
    <div class="row justify-content-end  m-1">
      <div class="col-2 ">
        วันที่ได้รับ :
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
          <th>รหัสสินค้า</th>
          <th>ชื่อสินค้า</th>
          <th>จำนวนที่เคลม</th>
          <th>รับแล้ว</th>
          <th>จำนวนที่กำลังรับ</th>
        </tr>
      </thead>
      <?php
        $sql = "SELECT PRO_ID,PRO_NAME,CLBD_AMOUNT,CLBD_STATUS FROM CLAIM_BUY_DETAIL NATURAL JOIN PRODUCT WHERE CLB_ID = '".$_POST['clb_id']."'";
        $sql_query = mysql_query($sql) or die(mysql_error());

        while($row = mysql_fetch_array($sql_query)){
          if($row['CLBD_STATUS']=='N'){
      ?>
          <tr>
            <td align="center">
              <?php echo $row['PRO_ID'] ?>
              <input type="hidden" name="product[]"  value="<?php echo $row['PRO_ID']?>">
            </td>
            <td>
              <?php echo $row['PRO_NAME'] ?>
              <input type="hidden" name="productname[]"  value="<?php echo $row['PRO_NAME']?>">
            </td>
            <td align="center">
              <?php echo $row['CLBD_AMOUNT'] ?>
              <input type="hidden" name="claimamount[]"  value="<?php echo $row['CLBD_AMOUNT']?>">
            </td>
            <?php
              $sql2 = "SELECT SUM(GPCBD_GETAMOUNT) FROM GET_PRODUCT_CLAIM_BUY_DETAIL NATURAL JOIN GET_PRODUCT_CLAIM_BUY WHERE PRO_ID = '".$row['PRO_ID']."' AND CLB_ID = '".$_POST['clb_id']."'";
              $sql2_query =  mysql_query($sql2) or die(mysql_error());
              $row2 = mysql_fetch_array($sql2_query);
              $gotamount;
            ?>
            <td align="center">
              <?php
                if($row2['SUM(GPCBD_GETAMOUNT)']==null || $row2['SUM(GPCBD_GETAMOUNT)']==0){
                  $gotamount = 0;
                }else{
                  $gotamount = $row2['SUM(GPCBD_GETAMOUNT)'];
                }
                echo $gotamount;
              ?>
              <input type="hidden" name="gotamount[]"  value="<?php echo $gotamount?>">
            </td>
            <td align="center">
              <input type="number" name="getamount[]" class="form-control"  min="0" max="<?php echo ($row['CLBD_AMOUNT']-$row2['SUM(GPCBD_GETAMOUNT)']);?>">
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
    </div>
  </form>
  </div>
</body>
</html>
<?php
  disconnect();
 ?>
