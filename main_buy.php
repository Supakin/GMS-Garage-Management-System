<?php
  require_once('GMSdb/connect.inc.php');
  connect();
  session_start();
  $_SESSION['product'];
  $_SESSION['amount'];
  $product = array();
  $amount = array();
  if(isset($_GET['product']) && $_GET['product'] != null){
    $_SESSION['product'][] = $_GET['product'];
    $_SESSION['amount'][] = $_GET['amount'];

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

<!--icon-->
<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.5.0/css/all.css' integrity='sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU' crossorigin='anonymous'>

<!--font-Thai-->
<link href="https://fonts.googleapis.com/css?family=Athiti" rel="stylesheet">
</head>

<body>
<div class="container">
  <div class="row justify-content-center align-content-center">
    <button type="button" class="btn btn-info btn-block mt-2 shadow-sm" onClick = "window.location.replace('main.php')">
      <i class='fas fa-home' style='font-size:10px;color:white'></i>
      กลับหน้าหลัก
    </button>
  </div>
  <div class="row mt-3 mb-3 align-items-center">
    <div class="col-1">
        <i class="fab fa-bitcoin" style='font-size:65px;color:black'></i>
    </div>
    <div class="col-9">
      <h1>ขายอะไหล่</h1>
    </div>
    <div class="col-2">
      <button type="button" class="btn btn-success  m-1" data-toggle="modal" data-target="#addorder">
        <i class='fas fa-money-bill' style='font-size:10px;color:white'></i>
        ประวัติการขาย
      </button>
    </div>
  </div>
  <div class="row">
  </div>
  <div class="row">
    <div class="col-8">
      <div class="row">
        <form  method="get" action="main_buy.php">
          <input type="hidden" name="action" value="addproduct">
          <input type="text" name="product" class="form-control" placeholder="รหัสสินค้า" >
          <input type="text" name="amount" class="form-control" placeholder="จำนวน" >
          <input type="submit" class="btn btn-success">
        </form>
      </div>
      <div class ="row">
        <table class="table table-hover table-bordered" >
          <thead class="thead-dark">
            <tr align="center">
              <th>รายการที</th>
              <th>รหัสสินค้า</th>
              <th>ชื่อสินค้า</th>
              <th>ราคาต่อชิ้น</th>
              <th>จำนวน</th>
              <th>ราคารวม</th>
            </tr>
          </thead>
          <?php
            for($i=0;$i<count($_SESSION['product']);$i++){
              echo $_SESSION['product'][$i];
            }

          ?>
        </table>
      </div>
    </div>

    <div class="col-4">
      <div class=" row bg-dark text-white p-3 m-1">

      </div>
    </div>
  </div>

</div>

</body>
</html>
<?php

?>
