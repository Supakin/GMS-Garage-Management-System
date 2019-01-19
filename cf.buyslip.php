<?php
  require_once('GMSdb/connect.inc.php');
  connect();
  $product = $_POST['product'];
  $amount = $_POST['proamount'];
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
    <button type="button" class="btn btn-info btn-block mt-2 shadow-sm" onClick = "window.history.go(-1)">
      <i class='fas fa-home' style='font-size:10px;color:white'></i>
      กลับหน้าหลัก
    </button>
  </div>
  <form action="insert.data.php" method="post">
  <div class="row mt-3 mb-3 align-items-center">
    <div class="col-1">
        <i class="fab fa-bitcoin" style='font-size:65px;color:black'></i>
    </div>
    <div class="col-8">
      <?php
      $sql = "SELECT MAX(BUY_ID) FROM BUYSLIP";
      $sql_query = mysql_query($sql);
      $buy_id = (int)mysql_result($sql_query,0,0);
      $buy_id += 1;
      $buy_id = str_pad($buy_id, 10, "0", STR_PAD_LEFT);
       ?>
      <h1>เลขที่ใบเสร็จ : <?php echo $buy_id ?></h1>
      <input type="hidden" name="buy_id" value="<?php echo $buy_id ?>">
    </div>
    <div class="col-3">
      <h4>วันที่ : <?php echo date('Y-m-d'); ?> </h4>
    </div>
  </div>
  <div class="row mt-2 mb-2">
    <div class="col-8">
      <div class="row mt-3 mb-3">
        <h3>รายการอะไหล่</h3>
      </div>
      <div class ="row mt-3 mb-3 mr-1">
        <input type="hidden" name="action" value="addbuyslip">
        <table class="table table-hover table-bordered table-sm" id="myTable">
          <thead class="thead-dark">
            <tr align="center">
              <th width="10%">รายการ</th>
              <th>รหัส</th>
              <th>อะไหล่</th>
              <th>ราคา/หน่วย</th>
              <th width="20%">จำนวน</th>
              <th>ราคารวม</th>
            </tr>
          </thead>
          <?php
            $sumprice = 0;
            for($i = 0 ; $i<count($product);$i++){
              $sql = "SELECT * FROM PRODUCT WHERE PRO_ID = \"$product[$i]\"";
              $sql_query = mysql_query($sql) or die(mysql_error());
              $result =mysql_fetch_array($sql_query);
          ?>
            <tr>
              <td align="center"><?php echo $i+1 ?></td>
              <td align="center"><?php echo $result['PRO_ID'] ?></td>
              <td><?php echo $result['PRO_NAME']?></td>
              <td align="right"><?php echo $result['PRO_BUYPRICE'] ?></td>
              <td align="center"><?php echo $amount[$i] ?></td>
              <td align="right"><?php echo $amount[$i]*$result['PRO_BUYPRICE'] ?></td>
              <input type="hidden" name="product[]" value="<?php echo $result['PRO_ID'] ?>">
              <input type="hidden" name="amount[]" value="<?php echo  $amount[$i] ?>">
              <input type="hidden" name="price[]" value="<?php echo $amount[$i]*$result['PRO_BUYPRICE'] ?>">
            </tr>
          <?php
              $sumprice += ($amount[$i]*$result['PRO_BUYPRICE']);
            }
          ?>
        </table>
      </div>
    </div>
    <div class="col-4">
      <div class="row mt-3 mb-3">
        <h3>ราคาทั้งหมด</h3>
      </div>
      <div class="row mt-3 mb-3 p-4 justify-content-end shadow-sm" style="background-color:red">
        <h1 class="text-white"><b><?php echo $sumprice ?></b></h1>
        <input type="hidden" id="totalprice" name="totalprice" value="<?php echo $sumprice ?>">
      </div>
      <div class="row mt-3 mb-3">
        <h3>รับเงิน</h3>
      </div>
      <div class="row mt-3 mb-3 justify-content-center">
        <input type="number" id="getmoney" class="form-control form-control-lg" onchange="myMoney(this.value);" value="">
      </div>
      <div class="row mt-3 mb-3" style="">
        <h3>เงินทอน</h3>
      </div>
      <div class="row mt-3 mb-3 p-4 justify-content-end shadow-sm" style="background-color:green">
        <h1 class="text-white"><b id="result"></b></h1>
      </div>
      <div class="row mt-3 mb-3">
        <button type="submit" name="save" class="btn btn-success btn-block shadow-sm">ยืนยัน</button>
      </div>
    </div>
  </div>
  </form>
</div>

<script>
function myMoney(value){
  var tp = totalprice.value;
  var money = getmoney.value;
  result.innerHTML = money-tp;
};
</script>

</body>
</html>
<?php
disconnect();
?>
=
