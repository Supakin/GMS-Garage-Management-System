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
  <form  action="" method="post" name="newsliped">


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
      <label><h4>ข้อมูลรับเข้ารับรถ</h4></label>
    </div>
  </div>
  <div class="row m-1">
    <div class="col-8">
      <div class="row">
        <div class="col-3">
          <label for="cus_id">หมายเลขบัตรประชาชน</label>
          <input type="text" name="cus_id" class="form-control form-control-sm" minlength="13" maxlength="13" required autocomplete="off">
        </div>
        <div class="col-4">
          <label for="cus_fname">ชื่อ</label>
          <input type="text" name="cus_fname" class="form-control form-control-sm"  required autocomplete="off">
        </div>
        <div class="col-4">
          <label for="cus_lname">นามสกุล</label>
          <input type="text" name="cus_lname" class="form-control form-control-sm"  required autocomplete="off">
        </div>
      </div>
      <div class="row">
        <div class="col-3">
          <label for="cus_tel">เบอร์โทรติดต่อ</label>
          <input type="text" name="cus_tel" class="form-control form-control-sm"  required autocomplete="off" maxlength="10">
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
        <label for="date">วันรับรถ</label>
        <input type="date" name="date" class="form-control form-control-sm" required >
      </div>
    </div>
  </div>
  <div class="row mt-3 mb-1">
    <label><h4>ข้อมูลรถของลูกค้า</h4></label>
  </div>
  <div class="row m-1">
    <div class="col-2">
      <label for="car_license">ทะเบียนรถ</label>
      <input type="text" name="car_license" class="form-control form-control-sm"  required autocomplete="off" maxlength="10">
    </div>
    <div class="col-2">
      <label for="car_province">จังหวัด</label>
      <input type="text" name="car_province" class="form-control form-control-sm"  required autocomplete="off">
    </div>
    <div class="col-2">
      <label for="car_brand">ยี่ห้อ</label>
      <input type="text" name="car_brand" class="form-control form-control-sm"  required autocomplete="off">
    </div>
    <div class="col-2">
      <label for="car_model">รุ่น</label>
      <input type="text" name="car_model" class="form-control form-control-sm"  required autocomplete="off">
    </div>
    <div class="col-2">
      <label for="car_color">สี</label>
      <input type="text" name="car_color" class="form-control form-control-sm"  required autocomplete="off">
    </div>
  </div>
  <div class="row m-1">
    <div class="col-3">
      <label for="car_engine">หมายเลขเครื่องยนต์</label>
      <input type="text" name="car_engine" class="form-control form-control-sm"  required autocomplete="off">
    </div>
    <div class="col-3">
      <label for="car_vin">หมายเลขตัวถัง</label>
      <input type="text" name="car_vin" class="form-control form-control-sm"  required autocomplete="off">
    </div>
    <div class="col-3">
      <label for="car_kilomater">เลขกิโล</label>
      <input type="text" name="car_kilomater" class="form-control form-control-sm"  required autocomplete="off">
    </div>
  </div>
  <div class="row mt-3 mb-1">
    <label><h4>ข้อมูลบริการ</h4></label>
  </div>
  <div class="row m-1">
    <div class="col">
      <label for="rep_detail">รายละเอียดความเสียหาย</label>
      <textarea name="rep_detail" class="form-control form-control-sm" rows="2" cols="200"></textarea>
    </div>
  </div>
  <div class="row m-2 justify-content-center">
    <div class="col-8">
      <h5>บริการ</h5>
    </div>
    <div class="col-4">
      <button class="btn btn-info m-1" onclick="add_row()">เพิ่มบริการ</button>
      <button class="btn btn-info m-1" onclick="del_row()">ลบบริการล่าสุด</button>
    </div>
  </div>
  <div class="row m-2">
    <table class="table table-hover table-bordered" id="myTable">
      <thead class="thead-dark">
        <tr align="center">
          <th width="80">รายการที่</th>
          <th width="500">บริการ</th>
          <th width="200">ราคาต่อหน่วย</th>
          <th width= "10%">จำนวน</th>
          <th>ราคารวม</th>
        </tr>
      </thead>
    </table>
    <input type="hidden" id="number" name="number" value="0">
  </div>
  </form>

</div>



<script>
$(document).ready(function(){
  function add_row() {
      var table = document.getElementById("myTable");
      count_rows = table.getElementsByTagName("tr").length;
      var num=parseInt($('#number').val())+1;

      var row = table.insertRow(count_rows);
      var cell0 = row.insertCell(0);
      var cell1 = row.insertCell(1);
      var cell2 = row.insertCell(2);
      var cell3 = row.insertCell(3);
      var cell4 = row.insertCell(4);


      cell0.innerHTML = "<td>"+num+"</td>";

      <?php
        $sql = "SELECT * FROM SERVICE ORDER BY  SER_ID";
        $sql_query = mysql_query($sql) or die(mysql_error());
      ?>
      cell1.innerHTML = "<select class='form-control form-control-sm' id='service"+num"' name='service[]'  onclick='resutName(this.value,num)'><option>กรุณาเลือกบริการ</option><?php while ($row = mysql_fetch_array($sql_query)){ ?><option value='<?php echo $row['SER_ID'];?>'><?php echo $row['SER_ID']." --- ".$row['SER_NAME'] ?></option><?php } ?></select>";

      cell2.innerHTML = "<input type='number' name='costservice' id='cost"+num"' class='form-control form-control-sm' value=''>";

      cell3.innerHTML = "<input type='number'min='1' max='999999' class='form-control form-control-sm' name='seramount[]' autocomplete='off'>";

      cell4.innerHTML = "";

      $('#number').val(num);
  }


  function del_row(){
      if(num!=1){
        var num=parseInt($('#number').val())-1;
        var table = document.getElementById("myTable");
        count_rows = table.getElementsByTagName("tr").length;
        document.getElementById("myTable").deleteRow(count_rows-1);
        $('#number').val(num);
      }
  }

  function resulName(service,num){
  var row = 'service'+num;
  var id = service;
  var cost = 'cost'+num;
  $(row).change(function(){
      $.ajax({
        type : 'POST',
        data : { id : id , cost : cost },
        url : 'test2.php' ,
        success : function(data){
          $(cost).html(data);
        }
      });
      return false;
  });

  }


});




</script>



</body>
</html>
<?php
  disconnect();
?>
