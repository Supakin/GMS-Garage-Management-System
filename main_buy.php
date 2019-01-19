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
    <div class="col-7">
      <h1>ขายอะไหล่</h1>
    </div>
    <div class="col-4">
      <button type="button" class="btn btn-success m-1" data-toggle="modal" data-target="#getclaimbuyslip">
        <i class='fas fa-truck' style='font-size:10px;color:white'></i>
        ส่งอะไหล่ให้ลูกค้า
      </button>
      <button type="button" class="btn btn-success m-1" data-toggle="modal" data-target="#claimbuyslip">
        <i class='fas fa-ambulance' style='font-size:10px;color:white'></i>
        เคลมอะไหล่
      </button>
      <button type="button" class="btn btn-success " onClick = "window.location.replace('buy.history.php')">
        <i class='fas fa-money-bill' style='font-size:10px;color:white'></i>
        ประวัติการขาย
      </button>
    </div>
  </div>
  <form action="cf.buyslip.php" method="post">
  <div class="row mt-2 mb-2">
    <div class="col-10">
      <div class ="row mt-3 mb-3 mr-1">

        <table class="table table-hover table-bordered table-sm" id="myTable">

          <thead class="thead-dark">
            <tr align="center">
              <th width="10%">รายการ</th>
              <th>อะไหล่</th>
              <th width="20%">จำนวน</th>
            </tr>
          </thead>
        </table>
        <input type="hidden" id="number" name="number" value="0">
      </div>
    </div>
    <div class="col-2">
      <div class="row mt-3 mb-2">
        <input type="button" class="btn btn-info  btn-block" onclick="add_row()" value="เพิ่มอะไหล่">
      </div>
      <div class="row mt-3 mb-2">
        <input type="button" class="btn btn-info  btn-block" onclick="del_row()" value="ลบอะไหล่ล่าสุด">
      </div>
      <div class="row mt-3 mb-5">
        <button type="submit" name="save" class="btn btn-success btn-block shadow-sm">ยืนยัน</button>
      </div>
    </div>
  </div>
  </form>
</div>

<!--claimbuyslip-->
<form  method="post" action="claimbuyslip.php">
  <div class="modal fade" id="claimbuyslip">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">เคลมอะไหล่จากลูกค้า</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="form-group">
            <label for="ord_id">เลขที่ใบเสร็จ :</label>
            <select class="form-control" name="buy_id" required>
              <option value="">กรุณากรอกเลขที่ใบเสร็จ</option>
              <?php
                $sql = "SELECT BUY_ID FROM BUYSLIP ";
                $sql_query = mysql_query($sql) or die(mysql_error());
                while($row = mysql_fetch_array($sql_query)){
              ?>
                    <option value="<?php echo $row['BUY_ID'] ?>"> <?php echo $row['BUY_ID'] ?></option>
              <?php
                }
              ?>
            </select>
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

<!--getclaimbuyslip-->
<form  method="post" action="getclaimbuy.php">
  <div class="modal fade" id="getclaimbuyslip">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">ส่งคืนอะไหล่ให้ลูกค้า</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="form-group">
            <label for="clb_id">รหัสการเคลมจากลูกค้า :</label>
            <select class="form-control" name="clb_id" required>
              <option value="">กรุณากรอกรหัสการเคลม</option>
              <?php
                $sql = "SELECT CLB_ID FROM CLAIMSLIP_BUY WHERE CLB_STATUS = 'N' ";
                $sql_query = mysql_query($sql) or die(mysql_error());
                while($row = mysql_fetch_array($sql_query)){
              ?>
                    <option value="<?php echo $row['CLB_ID'] ?>"> <?php echo $row['CLB_ID'] ?></option>
              <?php

                }
              ?>
            </select>
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




<script>
function add_row() {
    var table = document.getElementById("myTable");
    count_rows = table.getElementsByTagName("tr").length;
    var num=parseInt($('#number').val())+1;

    var row = table.insertRow(count_rows);
    var cell0 = row.insertCell(0);
    var cell1 = row.insertCell(1);
    var cell2 = row.insertCell(2);


    cell0.innerHTML = "<td>"+num+"</td>";

    <?php
      $sql = "SELECT * FROM PRODUCT ORDER BY PRO_ID";
      $sql_query = mysql_query($sql) or die(mysql_error());
    ?>
    cell1.innerHTML = "<select class='form-control form-control-sm' id='service' name='product[]'  required ><option>กรุณาเลือกอะไหล่</option><?php while ($row = mysql_fetch_array($sql_query)){ ?><option value='<?php echo $row['PRO_ID']?>'><?php echo $row['PRO_ID']." --- ".$row['PRO_NAME']." --- ราคา ".$row['PRO_SELLPRICE']." บาท/หน่วย" ?></option><?php } ?>";

    cell2.innerHTML = "<input type='number'min='1' max='999999' class='form-control form-control-sm' name='proamount[]' >";
    $('#number').val(num);
}

function del_row(){
    var num=parseInt($('#number').val())-1;
    var table = document.getElementById("myTable");
    count_rows = table.getElementsByTagName("tr").length;
    if(num == -1){
      num = 0;
      $('#number').val(num);
    }else{
      document.getElementById("myTable").deleteRow(count_rows-1);
      $('#number').val(num);
    }
}
</script>

</body>
</html>
<?php

?>
