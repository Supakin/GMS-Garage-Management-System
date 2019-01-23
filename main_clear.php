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
    <button type="button" class="btn btn-info btn-block mt-2 shadow-sm" onClick = "window.location.replace('main.php')">
      <i class='fas fa-home' style='font-size:10px;color:white'></i>
      กลับหน้าหลัก
    </button>
  </div>
  <div class="row mt-3 mb-3 align-items-center">
    <div class="col-1">
      <i class="fas fa-eraser" style='font-size:65px;color:black'></i>
    </div>
    <div class="col-9">
      <h1>บันทึกจัดการอะไหล่ชำรุด</h1>
    </div>
    <div class="col-2">
      <button type="button" class="btn btn-success m-1 btn-block" data-toggle="modal" data-target="#clearing">
        <i class='fas fa-plus' style='font-size:10px;color:white'></i>
        จัดการอะไหล่ชำรุด
      </button>
    </div>
  </div>


  <table class="table table-hover table-bordered table-sm" >
    <thead class="thead-dark">
      <tr align="center">
        <th>รหัสจัดการ</th>
        <th>วันที่</th>
        <th>รหัสอะไหล่</th>
        <th>อะไหล่</th>
        <th>จำนวน</th>
        <th>หมายเหตุ</th>
      </tr>
    </thead>
    <?php
    $sql = "SELECT * FROM (CLEAR NATURAL JOIN PRODUCT) ORDER BY CLE_ID";
    $resultsql = mysql_query($sql) or die (mysql_error());
    while($row = mysql_fetch_array($resultsql)) {
    ?>
      <tr>
        <td align="center" width="10%"> <?php  echo $row["CLE_ID"] ?> </td>
        <td align="center" width="15%"> <?php  echo $row["CLE_DATE"] ?> </td>
        <td align="center" width="8%"> <?php  echo $row["PRO_ID"] ?> </td>
        <td> <?php  echo $row["PRO_NAME"] ?> </td>
        <td align="center"> <?php  echo $row["CLE_AMOUNT"] ?> </td>
        <td align="center"> <?php  echo $row["CLE_DESCRIPT"] ?> </td>
      </tr>
    <?php
    }
    ?>
  </table>
</div>

<!--clearing-->
<form  method="post" action="clearing.php">
  <div class="modal fade" id="clearing">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header align-items-center">
          <h4 class="modal-title" align="center">จัดการอะไหล่ชำรุด</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <input type="hidden" name="action" value="delinjury">
          <div class="col mr-3 ml-3">
            <div class="row">
                <div class="form-group">
                  <label for="repid">รหัสอะไหล่ : </label>
                  <select class="form-control" name="pro_id" required>
                    <option value="">กรุณาเลือกรหัสอะไหล่</option>
                    <?php
                      $sql = "SELECT * FROM PRODUCT WHERE PRO_WAMOUNT<>0";
                      $query = mysql_query($sql);
                      while($row = mysql_fetch_array($query)){
                     ?>
                    <option value="<?php echo $row['PRO_ID'] ?>"> <?php echo $row['PRO_ID']." --- ".$row['PRO_NAME'] ?></option>

                    <?php
                      }
                    ?>
                  </select>
                </div>
            </div>

          </div>

        </div>

        <!-- Modal footer -->
        <div class="modal-footer justify-content-center">
          <button type="button" class="btn default" data-dismiss="modal">ปิด</button>
          <button name="save" type="submit" class="btn btn-success" id="submit" >บันทึก</button>
        </div>
      </div>
    </div>
  </div>
</form>


<script>
$(document).ready(function() {
	$('#delInjury').on('show.bs.modal', function (event) {
	  var button = $(event.relatedTarget);
	  var id= button.data('id');
	  var modal = $(this);
	  modal.find('#injid').val(id);
  });
});

</script>


</body>
</html>

<?php

  disconnect();
?>
