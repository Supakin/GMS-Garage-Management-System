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
<div class = "container" >
  <div class="row">
    <div class="col-1">
      <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
    </div>
    <div class="col-10">
      <h3>สินค้าของเรา</h3>
    </div>
    <div class="col-1 justify-content-end">
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addProductnew">เพิ่มสินค้า</button>
    </div>
  </div>
  <table class="table table-hover">
    <thead>
      <tr>
        <th>รหัสสินค้า</th>
        <th>รหัสคู่ค้า</th>
        <th>ชื่อสินค้า</th>
        <th>ราคาขาย</th>
        <th>ราคาซื้อ</th>
        <th>คงเหลือ</th>
        <th>ของเสีย</th>
        <th>รายละเอียดเพิ่มเติม</th>
      </tr>
    </thead>
    <?php
      include('showPRODUCTtable.php');
    ?>
  </table>
</div>




<!---------------------------------------------------------------------------------------->
<!--addProductnew-->
<form  method="post" action="addProductnew.php">
  <div class="modal fade"  id="addProductnew">
    <div class="modal-dialog">
      <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">เพิ่มสินค้าใหม่</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div>
          <label for="pro_id">รหัสสินค้า :</label>
          <input name="pro_id" type="text" class="form-control" id="pro_id" maxlength="6">
        </div>
        <div>
          <label for="sel_id">รหัสผู้ขาย :</label>
          <input name="sel_id" type="text" class="form-control" id="sel_id">
        </div>
        <div>
          <label for="pro_name">ชื่อสินค้า :</label>
          <input name="pro_name" type="text" class="form-control" id="pro_name">
        </div>
        <div>
          <label for="pro_buyprice">ราคาขาย :</label>
          <input name="pro_buyprice" type="text" class="form-control" id="pro_buyprice">
        </div>
        <div>
          <label for="pro_sellprice">ราคาซื้อ :</label>
          <input name="pro_sellprice" type="text" class="form-control" id="pro_sellprice">
        </div>

        <div>
          <label for="pro_amount">จำนวน :</label>
          <input name="pro_amount" type="text" class="form-control" id="pro_amount"></input>
        </div>
        <div>
          <label for="pro_detail">รายละเอียดเพิ่มเติม :</label>
          <textarea name="pro_detail" class="form-control" rows="3" id="pro_detail"></textarea>
        </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn default" data-dismiss="modal">ปิด</button>
        <button name="save" type="submit" class="btn btn-success"  id="submit" >บันทึก</button>
      </div>
    </div>
    </div>
  </div>
</form>


<!--Slide menu-->
<div id="mySidenav" class="sidenav" >
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="main.php">หน้าแรก</a>
  <a href="main_seller.php">คู่ค้าของเรา</a>
  <a href="main_product.php">สินค้าของเรา</a>
  <a href="main_employee.php">พนักงานของเรา</a>
</div>


</body>
</html>
