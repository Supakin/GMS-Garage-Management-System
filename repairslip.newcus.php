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
    <button type="button" class="btn btn-info btn-block mt-2 shadow-sm" onClick = "window.location.replace('main_service.php')">
      <i class='fas fa-home' style='font-size:10px;color:white'></i>
      กลับก่อนหน้า
    </button>
  </div>
  <form  action="cf.repairslip.newcus.php" method="post">

  <div class="row mt-3 mb-3 align-items-center">
    <div class="col-1">
        <i class="fas fa-wrench" style='font-size:65px;color:black'></i>
    </div>
    <?php
      $sql = "SELECT MAX(REP_ID) FROM REPAIRSLIP";
      $sql_query = mysql_query($sql);
      $rep_id = (int)mysql_result($sql_query,0,0);
      $rep_id += 1;
      $rep_id = str_pad($rep_id, 10, "0", STR_PAD_LEFT);
    ?>
    <div class="col-10">
      <h1>เลขที่ใบซ่อม : <?php echo $rep_id ?></h1>
      <input type="hidden" name="rep_id" value="<?php echo $rep_id ?>">
    </div>
  </div>
  <div class="row mt-3 mb-1">
    <div class="col-8">
      <label><h4>ข้อมูลลูกค้า</h4></label>
    </div>
    <div class="col-4">
      <label><h4>ข้อมูลการรับรถ</h4></label>
    </div>
  </div>
  <div class="row m-1">
    <div class="col-8">
      <div class="row">
        <div class="col-3">
          <label for="cus_id">หมายเลขบัตรประชาชน</label>
          <input type="text" name="cus_id" class="form-control form-control-sm" minlength="13" maxlength="13" required >
        </div>
        <div class="col-4">
          <label for="cus_fname">ชื่อ</label>
          <input type="text" name="cus_fname" class="form-control form-control-sm"  required >
        </div>
        <div class="col-4">
          <label for="cus_lname">นามสกุล</label>
          <input type="text" name="cus_lname" class="form-control form-control-sm"  required >
        </div>
      </div>
      <div class="row">
        <div class="col-3">
          <label for="cus_tel">เบอร์โทรติดต่อ</label>
          <input type="text" name="cus_tel" class="form-control form-control-sm"  required  maxlength="10">
        </div>
        <div class="col">
          <label for="cus_address">ที่อยู่</label>
          <textarea name="cus_address" class="form-control form-control-sm"  rows="2" cols="80"></textarea>
        </div>
      </div>
    </div>
    <div class="col-4">
      <div class="row m-1">
        <label for="date">วันแจ้งซ่อม</label>
        <input type="date" name="date" class="form-control form-control-sm" required >
      </div>
      <div class="row m-1">
        <label for="getdate">วันรับรถ</label>
        <input type="date" name="getdate" class="form-control form-control-sm" required >
      </div>
    </div>
  </div>
  <div class="row mt-3 mb-1">
    <label><h4>ข้อมูลรถของลูกค้า</h4></label>
  </div>
  <div class="row m-1">
    <div class="col-2">
      <label for="car_license">ทะเบียนรถ</label>
      <input type="text" name="car_license" class="form-control form-control-sm"  required  maxlength="10">
    </div>
    <div class="col-2">
      <label for="car_province">จังหวัด</label>
      <input type="text" name="car_province" class="form-control form-control-sm"  required >
    </div>
    <div class="col-2">
      <label for="car_brand">ยี่ห้อ</label>
      <input type="text" name="car_brand" class="form-control form-control-sm"  required >
    </div>
    <div class="col-2">
      <label for="car_model">รุ่น</label>
      <input type="text" name="car_model" class="form-control form-control-sm"  required >
    </div>
    <div class="col-2">
      <label for="car_color">สี</label>
      <input type="text" name="car_color" class="form-control form-control-sm"  required >
    </div>
  </div>
  <div class="row m-1">
    <div class="col-3">
      <label for="car_engine">หมายเลขเครื่องยนต์</label>
      <input type="text" name="car_engine" class="form-control form-control-sm"  required >
    </div>
    <div class="col-3">
      <label for="car_vin">หมายเลขตัวถัง</label>
      <input type="text" name="car_vin" minlength="17" maxlength="17" class="form-control form-control-sm" >
    </div>
    <div class="col-3">
      <label for="rep_kilomater">เลขกิโล</label>
      <input type="number" name="rep_kilomater" class="form-control form-control-sm"  required >
    </div>
  </div>
  <div class="row mt-3 mb-1">
    <label><h4>ข้อมูลบริการ</h4></label>
  </div>
  <div class="row m-1">
    <div class="col-8">
      <label for="rep_detail">รายละเอียดความเสียหาย</label>
    </div>
    <div class="">
      <label for="rep_detail">ช่างคุมการซ่อม</label>
    </div>
  </div>
  <div class="row m-1">
    <div class="col-8">
      <textarea name="rep_detail" class="form-control form-control-sm" rows="2" cols="200"></textarea>
    </div>
    <div class="col-4">
      <select class='form-control form-control-sm' id='employee' name='empleader'  required >
        <option>กรุณาเลือกช่างซ่อม</option>
        <?php
          $sql = "SELECT * FROM EMPLOYEE WHERE EMP_STATUS = 'Y' ORDER BY EMP_ID";
          $sql_query = mysql_query($sql) or die(mysql_error());
          while ($row = mysql_fetch_array($sql_query)){
        ?>
            <option value='<?php echo $row['EMP_ID']?>'><?php echo $row['EMP_ID']." --- ".$row['EMP_FNAME']."   ".$row['EMP_LNAME'] ?></option>
        <?php
        }
        ?>
      </select>
    </div>
  </div>
  <div class="row m-2 justify-content-center">
    <div class="col-8">
      <h5>บริการ</h5>
    </div>
    <div class="col-4">
      <input type="button" class="btn btn-info m-1" onclick="add_row()" value="เพิ่มบริการ">
      <input type="button" class="btn btn-info m-1" onclick="del_row()" value="ลบบริการล่าสุด">
    </div>
  </div>
  <div class="row m-2">
    <table class="table table-hover table-bordered" id="myTable">
      <thead class="thead-dark">
        <tr align="center">
          <th width="5%">รายการที่</th>
          <th width="45%">บริการ</th>
          <th width= "10%">จำนวน</th>
          <th width="25%">ผู้ซ่อม</th>
        </tr>
      </thead>
    </table>
    <input type="hidden" id="number" name="number" value="0">
  </div>
  <div class="row m-2 justify-content-center">
    <div class="col-8">
      <h5>อะไหล่</h5>
    </div>
    <div class="col-4">
      <input type="button" class="btn btn-info m-1" onclick="add_row2()" value="เพิ่มอะไหล่">
      <input type="button" class="btn btn-info m-1" onclick="del_row2()" value="ลบอะไหล่ล่าสุด">
    </div>
  </div>
  <div class="row m-2">
    <table class="table table-hover table-bordered" id="myTable2">
      <thead class="thead-dark">
        <tr align="center">
          <th width="5%">รายการที่</th>
          <th width="65%">อะไหล่</th>
          <th width= "10%">จำนวน</th>
        </tr>
      </thead>
    </table>
    <input type="hidden" id="number2" name="number2" value="0">
  </div>
  <div class="row justify-content-center mb-5">
      <button type="submit" name="save" class="btn btn-success btn-block shadow-sm">ยืนยัน</button>
  </div>
  </form>

</div>



<script>
function add_row() {
    var table = document.getElementById("myTable");
    count_rows = table.getElementsByTagName("tr").length;
    var num=parseInt($('#number').val())+1;

    var row = table.insertRow(count_rows);
    var cell0 = row.insertCell(0);
    var cell1 = row.insertCell(1);
    var cell2 = row.insertCell(2);
    var cell3 = row.insertCell(3);

    cell0.innerHTML = "<td>"+num+"</td>";

    <?php
      $sql = "SELECT * FROM SERVICE ORDER BY  SER_ID";
      $sql_query = mysql_query($sql) or die(mysql_error());

      $sql2 = "SELECT * FROM EMPLOYEE WHERE EMP_STATUS = 'Y' ORDER BY EMP_ID";
      $sql2_query = mysql_query($sql2) or die(mysql_error());
    ?>
    cell1.innerHTML = "<select class='form-control form-control-sm' id='service' name='service[]'  required ><option>กรุณาเลือกบริการ</option><?php while ($row = mysql_fetch_array($sql_query)){ ?><option value='<?php echo $row['SER_ID']?>'><?php echo $row['SER_ID']." --- ".$row['SER_NAME']." --- ราคา ".$row['SER_BEGINCOST']." บาท/หน่วย" ?></option><?php } ?>";

    cell2.innerHTML = "<input type='number'min='1' max='999999' class='form-control form-control-sm' name='seramount[]' >";

    cell3.innerHTML =  "<select class='form-control form-control-sm' id='employee' name='employee[]'  required ><option>กรุณาเลือกช่างซ่อม</option><?php while ($row = mysql_fetch_array($sql2_query)){ ?><option value='<?php echo $row['EMP_ID']?>'><?php echo $row['EMP_ID']." --- ".$row['EMP_FNAME']."   ".$row['EMP_LNAME'] ?></option><?php } ?>";

    $('#number').val(num);
}

function add_row2() {
    var table = document.getElementById("myTable2");
    count_rows = table.getElementsByTagName("tr").length;
    var num=parseInt($('#number2').val())+1;

    var row = table.insertRow(count_rows);
    var cell0 = row.insertCell(0);
    var cell1 = row.insertCell(1);
    var cell2 = row.insertCell(2);

    cell0.innerHTML = "<td>"+num+"</td>";

    <?php
      $sql = "SELECT * FROM PRODUCT ORDER BY  PRO_ID";
      $sql_query = mysql_query($sql) or die(mysql_error());
    ?>
    cell1.innerHTML = "<select class='form-control form-control-sm' name='product[]'  required><option>กรุณาเลือกอะไหล่</option><?php while ($row = mysql_fetch_array($sql_query)){ ?><option value='<?php echo $row['PRO_ID']?>'><?php echo $row['PRO_ID']." --- ".$row['PRO_NAME']." --- ราคา ".$row['PRO_SELLPRICE']." บาท/หน่วย" ?></option><?php } ?>";

    cell2.innerHTML = "<input type='number' min='1' max='999999' class='form-control form-control-sm' name='proamount[]' >";

    $('#number2').val(num);
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

function del_row2(){
    var num=parseInt($('#number2').val())-1;
    var table = document.getElementById("myTable");
    count_rows = table.getElementsByTagName("tr").length;
    if(num == -1){
      num = 0;
      $('#number2').val(num);
    }else{
      document.getElementById("myTable2").deleteRow(count_rows-1);
      $('#number2').val(num);
    }

}

</script>


</body>
</html>
<?php
  disconnect();
?>
