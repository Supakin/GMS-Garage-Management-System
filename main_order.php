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
<div class = "container" >
  <div class="row justify-content-center align-content-center">
    <button type="button" class="btn btn-info btn-block mt-2 shadow-sm" onClick = "window.location.replace('main_product.php')">
      <i class='fas fa-cogs' style='font-size:10px;color:white'></i>
      กลับหน้าคลังอะไหล่
    </button>
  </div>
  <div class="row mt-3 mb-3 align-items-center">
    <div class="col-1">
        <i class="fas fa-scroll" style='font-size:65px;color:black'></i>
    </div>
    <div class="col-6">
      <h3>นำเข้าอะไหล่</h3>
    </div>
    <div class="col-5 justify-content-end">
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#claimOrder">เคลมสินค้า</button>
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#getOrder">รับสินค้า</button>
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#paymentOrder">ชำระสินค้า</button>
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addOrder">สร้างออร์เดอร์</button>
    </div>
  </div>
  <div class="row">
    <br>
  </div>
<!-------->
  <div class="row justify-content-center">
    <div class="col-6">
      <div class="input-group mb-3">
        <input type="text" name="ord_id" class="form-control" placeholder="หมายเลขออเดอร์">
        <div class="input-group-append"><button class="btn btn-success" type="submit">ค้นหา</button> </div>
      </div>
    </div>
  </div>
  <div class="row">
    <br>
  </div>
  <div class="row justify-content-center ">
    <div class="col-12">
    <div id="accordion">
      <?php
        $sql = "SELECT * FROM ORDERS ORDER BY ORD_ID DESC";
        $sql_query = mysql_query($sql);
        while($row = mysql_fetch_array($sql_query)){
      ?>
        <div class="card">
          <div class="card-header">
            <a class="card-link" data-toggle="collapse" href="#<?php echo "show".$row['ORD_ID'];?>">
              <center><?php echo "<b>หมายเลขออเดอร์ : ".$row['ORD_ID']."</b>-----------------------รหัสผู้ขาย : ".$row['SEL_ID']."-----------------------วันที่สั่ง : ".$row['ORD_DATE'] ;?>
              </center>
            </a>
          </div>

          <div id="<?php echo "show".$row['ORD_ID']; ?>" class="collapse" data-parent="#accordion">
            <div class="card-body">
              <div class="row justify-content-start">
                <div class="col-2 ">
                  หมายเลขออเดอร์
                </div>
                <div class="col-5">
                  <b><?php echo $row['ORD_ID']; ?></b>
                </div>
              </div>
              <div class="row justify-content-start">
                <div class="col-2 ">
                  รหัสผู้ขาย
                </div>
                <div class="col-2">
                  <b><?php echo $row['SEL_ID']; ?></b>
                </div>
              </div>
              <div class="row justify-content-start">
                <div class="col-2 ">
                  วันที่สั่ง
                </div>
                <div class="col-2">
                  <b><?php echo $row['ORD_DATE']; ?></b>
                </div>
              </div>
              <div class="row justify-content-start">
                <div class="col-2 ">
                  วันที่ได้รับ
                </div>
                <div class="col-2">
                  <b><?php echo $row['ORD_GETDATE']; ?></b>
                </div>
                <div class="col-4">
                </div>
                <div class="col-2">
                  <b>สถานะออร์เดอร์</b>
                </div>
                <div class="col-2">
                  <?php
                  if ($row["ORD_STATUS"]=='Y'){
                    echo "<span class='badge badge-success'>";
                    echo "เรียบร้อย";
                    echo "</span>";
                  }else if ($row["ORD_STATUS"]=='N'){
                    echo "<span class='badge badge-danger'>";
                    echo "ยังไม่เรียบร้อย";
                    echo "</span>";
                  }
                  ?>
                </div>
              </div>
              <div class="row justify-content-start">
                <div class="col-2 ">
                  กำหนดชำระเงิน
                </div>
                <div class="col-2">
                  <b><?php echo $row['ORD_PAYDATE']; ?></b>
                </div>
                <div class="col-4">
                </div>
                <div class="col-2">
                  <b>สถานะการรับ</b>
                </div>
                <div class="col-2">
                  <?php
                  $check_get_sql = "SELECT COUNT(GPO_ID) AS CHECKGET FROM GET_PRODUCT_ORDER WHERE ORD_ID = '".$row['ORD_ID']."' AND GPO_STATUS = 'Y'";
                  $check_get_query = mysql_query($check_get_sql);
                  $check_get = mysql_fetch_array($check_get_query) or die(mysql_error());
                  if ($check_get['CHECKGET']>0){
                    echo "<span class='badge badge-success'>";
                    echo "เรียบร้อย";
                    echo "</span>";
                  }else{
                    echo "<span class='badge badge-danger'>";
                    echo "ยังไม่เรียบร้อย";
                    echo "</span>";
                  }
                  ?>
                </div>
              </div>
              <div class="row">
                <br>
              </div>
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>ลำดับ</th>
                    <th>รหัสสินค้า</th>
                    <th>ชื่อสินค้า</th>
                    <th>จำนวน</th>
                    <th>ราคารวม</th>
                  </tr>
                </thead>
                <?php
                  $ord_id = $row['ORD_ID'];
                  $sqlt = "SELECT * FROM (ORDERS NATURAL JOIN ORDER_DETAIL) NATURAL JOIN PRODUCT WHERE ORD_ID = $ord_id ORDER BY ORD_ID,ORDD_NUMBER";
                  $sqlt_query =mysql_query($sqlt);
                  $i=1;
                  while($row2 = mysql_fetch_array($sqlt_query)){
                ?>
                    <tr>
                      <td><?php echo $i ?></td>
                      <td><?php echo $row2['PRO_ID'] ?></td>
                      <td><?php echo $row2['PRO_NAME'] ?></td>
                      <td><?php echo $row2['ORDD_AMOUNT'] ?></td>
                      <td><?php echo $row2['ORDD_TOTALPRICE'] ?></td>
                    </tr>
                <?php
                $i++;
                  }
                ?>
              </table>
              <div class="row">
                <br>
              </div>
              <div class="row justify-content-end">
                <div class="col-2 ">
                  ราคารวม
                </div>
                <div class="col-2 justify-content-end">
                  <?php echo "<h3>".$row['ORD_TOTALPRICE']."</h3>"; ?>
                </div>
                <div class="col-1 ">
                  บาท
                </div>
              </div>
            </div>
          </div>
        </div>

      <?php
        }
      ?>

    </div>
    </div>
  </div>






</div>

<!---------------------------------------------------------------------------------------->
<!--addSeller-->
<form  method="post" action="main_addorder.php">
  <div class="modal fade" id="addOrder">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">สร้างออร์เดอร์</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="form-group">
            <label for="sel_id">เลือกรหัสคู่ค้า :</label>
            <input name="sel_id" type="text" class="form-control" id="sel_id" maxlength="6">
          </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn default" data-dismiss="modal">ปิด</button>
          <button name="save" type="submit" class="btn btn-success" id="submit" >เลือก</button>
        </div>
      </div>
    </div>
  </div>
</div>
</form>

<!--getOrder-->
<form  method="post" action="main_getorder.php">
  <div class="modal fade" id="getOrder">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">รับสินค้า</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="form-group">
            <label for="ord_id">หมายเลขออร์เดอร์ :</label>
            <input name="ord_id" type="text" class="form-control" id="ord_id" maxlength="10">
          </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn default" data-dismiss="modal">ปิด</button>
          <button name="save" type="submit" class="btn btn-success" id="submit" >เลือก</button>
        </div>
      </div>
    </div>
  </div>
</div>
</form>

<!--paymentOrder-->
<form  method="post" action="main_paymentorder.php">
  <div class="modal fade" id="paymentOrder">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">ชำระเงิน</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="form-group">
            <label for="ord_id">หมายเลขออร์เดอร์ :</label>
            <input name="ord_id" type="text" class="form-control" id="ord_id" maxlength="10">
          </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn default" data-dismiss="modal">ปิด</button>
          <button name="save" type="submit" class="btn btn-success" id="submit" >เลือก</button>
        </div>
      </div>
    </div>
  </div>
</div>
</form>




<!---------------------------------------------------------------------------------------->
<!--Slide menu-->
<div id="mySidenav" class="sidenav" >
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="main.php">หน้าแรก</a>
  <a href="main_seller.php">คู่ค้าของเรา</a>
  <a href="main_product.php">สินค้าของเรา</a>
  <a href="main_employee.php">พนักงานของเรา</a>
  <a href="main_order.php">ออร์เดอร์สั่งสินค้า</a>
</div>


</body>
</html>
<?php
  disconnect();
?>
