<?php
  require_once ('GMSdb/connect.inc.php');
?>
<!DOCTYPE html>
<html>
<head>
<!-- Always force latest IE rendering engine -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1">
<title> gms.storage.com</title>
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

<script>

function getDataFromDb()
{
	$.ajax({
				url: "showProducttable.php" ,
				type: "POST",
				data: ''
			})
			.success(function(result) {
				var obj = jQuery.parseJSON(result);
					if(obj != '')
					{
						  //$("#myTable tbody tr:not(:first-child)").remove();
						  $("#myBody").empty();
						  $.each(obj, function(key, val) {
									var tr = "<tr>";
									tr = tr + "<td>" + val["PRO_ID"] + "</td>";
									tr = tr + "<td>" + val["PRO_NAME"] + "</td>";
									tr = tr + "<td>" + val["PRO_SELLPRICE"] + "</td>";
									tr = tr + "<td>" + val["PRO_BUYPRICE"] + "</td>";
									tr = tr + "<td>" + val["PRO_AMOUNT"] + "</td>";
									tr = tr + "<td>" + val["PRO_WAMOUNT"] + "</td>";
									tr = tr + "</tr>";
									$('#myTable > tbody:last').append(tr);
						  });
					}

			});

}

setInterval(getDataFromDb, 10000);   // 1000 = 1 second
</script>
</head>

<body id="main">
<div class = "container" >
  <div class="row p-3  bg-primary text-white">
    <div class="col-11">
      <h1>คลังสินค้าอะไหล่ยนต์</h1>
    </div>
    <div class="col-1 justify-content-end">
      <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
    </div>
  </div>
  <div class="row pt-3">
    <div class="input-group mb-3">
      <input type="text" class="form-control" placeholder="พิมพ์ชื่อสินค้าที่ต้องการค้นหา" aria-label="Recipient's username" aria-describedby="basic-addon2">
      <div class="input-group-append">
        <button type="button" class="btn btn-success" type="button">ค้นหา</button>
      </div>
    </div>
  </div>
  <div class="row justify-content-end pb-3">
      <div class="float-right">
        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#addProduct">เพิ่มสินค้า</button>
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#addNewproduct">เพิ่มสินค้าใหม่</button>
      </div>
  </div>

  <div class="row">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>รหัสสินค้า</th>
          <th>ชื่อสินค้า</th>
          <th>ราคาซื้อ</th>
          <th>ราคาขาย</th>
          <th>จำนวนคงเหลือ</th>
          <th>จำนวนของเสีย</th>
          <th>คำอธิบาย</th>
        </tr>
      </thead>
      <tbody id="myBody"></tbody>
    </table>
</div>
</div>


<!-- addProduct Modal  -->
<div class="modal fade" id="addProduct">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">เพิ่มสินค้าเข้าคลัง</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="form-group">
          <label for="PRO_ID">รหัสสินค้า :</label>
          <input type="text" class="form-control" id="PRO_ID">
        </div>
        <div class="form-group">
          <label for="PRO_NAME">ชื่อสินค้า :</label>
          <input type="text" class="form-control" id="PRO_NAME">
        </div>
        <div class="form-group">
          <label for="PRO_NAME">จำนวนสินค้า :</label>
          <input type="text" class="form-control" id="PRO_NAME">
        </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-dismiss="modal">ยืนยัน</button>
      </div>

    </div>
  </div>
</div>

<!-- addNewproduct Modal  -->

<div class="modal fade" id="addNewproduct" method="post" action="addnewproduct_storage.php">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">เพิ่มสินค้าใหม่</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
    <form method="post" action="addnewproduct_storage.php">
      <div class="modal-body">
        <div>
          <label for="PRO_ID">รหัสสินค้า :</label>
          <input name="id_pro" type="text" class="form-control" id="id_pro">
        </div>
        <div>
          <label for="SEL_ID">ผู้ขาย :</label>
          <input name="id_sel" type="text" class="form-control" id="id_sel">
        </div>
        <div>
          <label for="PRO_NAME">ชื่อสินค้า :</label>
          <input name="name_pro" type="text" class="form-control" id="name_pro">
        </div>
        <div>
          <label for="PRO_AMOUNT">จำนวนสินค้า :</label>
          <input name="amount_pro" type="text" class="form-control" id="amount_pro">
        </div>
        <div>
          <label for="PRO_BUYPRICE">ราคาซื้อ :</label>
          <input name="buyprice_pro" type="text" class="form-control" id="buyprice_pro">
        </div>
        <div>
          <label for="PRO_SELLPRICE">ราคาขาย :</label>
          <input name="sellprice_pro" type="text" class="form-control" id="sellprice_pro">
        </div>
        <div>
          <label for="PRO_DESCRIP">คำอธิบายสินค้า :</label>
          <textarea name="detail_pro" class="form-control" rows="3" id="detail_pro"></textarea>
        </div>

      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="submit" class="btn btn-success" >ยืนยัน</button>
      </div>
    </form>
    </div>
  </div>
</div>



<!--Slide menu-->
<div id="mySidenav" class="sidenav" >
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="#">หน้าแรก</a>
  <a href="#">ใบกำกับการซ่อม</a>
  <a href="#">ใบเสร็จ</a>
  <a href="#">คลังสินค้า</a>
  <a href="#">ข้อมูลพนักงาน</a>
</div>







</body>
</html>
