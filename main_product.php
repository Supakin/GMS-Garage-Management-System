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
<title>gms.garage-management-systems.com</title>
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

<div class = "container" >
  <div class="row justify-content-center align-content-center">
    <button type="button" class="btn btn-info btn-block mt-2 shadow-sm" onClick = "window.location.replace('main.php')">
      <i class='fas fa-home' style='font-size:10px;color:white'></i>
      กลับหน้าหลัก
    </button>
  </div>
  <div class="row mt-3 mb-3 align-items-center">
    <div class="col-1">
      <i class="	fas fa-cogs" style='font-size:65px;color:black'></i>
    </div>
    <div class="col-8">
      <h1>คลังอะไหล่</h1>
    </div>
    <div class="col-3 justify-content-end">
      <button type="button" class="btn btn-success  shadow-sm" onClick = "window.location.replace('main_order.php')">
        <i class='fas fa-scroll' style='font-size:10px;color:white'></i>
        นำเข้าอะไหล่
      </button>
      <button type="button" class="btn btn-success  shadow-sm" data-toggle="modal" data-target="#addproduct">
        <i class='fas fa-plus' style='font-size:10px;color:white'></i>
        เพิ่มข้อมูลอะไหล่
      </button>
    </div>
  </div>
  <div class="row">
  <table class="table table-hover table-bordered" >
    <thead class="thead-dark">
      <tr align="center">
        <th>รหัส</th>
        <th>รหัสคู่ค้า</th>
        <th>ชื่อ</th>
        <th>ราคาซื้อ</th>
        <th>ราคาขาย</th>
        <th>คงเหลือ</th>
        <th>ของเสีย</th>
        <th>รายละเอียดเพิ่มเติม</th>
      </tr>
    </thead>
    <?php
    $sql = "SELECT * FROM PRODUCT ORDER BY PRO_ID";
    $resultsql = mysql_query($sql) or die (mysql_error());

    while($row = mysql_fetch_array($resultsql)) {
    ?>
      <tr>
        <td align="center"> <?php  echo $row["PRO_ID"] ?> </td>
        <td align="center"> <?php  echo $row["SEL_ID"] ?> </td>
        <td > <?php  echo $row["PRO_NAME"] ?> </td>
        <td align="center"> <?php  echo $row["PRO_BUYPRICE"] ?> </td>
        <td align="center"> <?php  echo $row["PRO_SELLPRICE"] ?> </td>
        <td align="center"> <?php  echo $row["PRO_AMOUNT"] ?> </td>
        <td align="center"> <?php  echo $row["PRO_WAMOUNT"] ?> </td>
        <td align="center"> <?php  echo $row["PRO_DETAIL"] ?> </td>
      </tr>
    <?php
    }
    ?>
  </table>
</div>
</div>




<!---------------------------------------------------------------------------------------->
<!--addproduct-->
<form   method="post" action="insert.data.php">
  <div class="modal fade"  id="addproduct">
    <div class="modal-dialog">
      <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">เพิ่มข้อมูลอะไหล่</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <input type="hidden" name="action" value="addproduct">
        <div>
          <label for="pro_id">รหัส :</label>
          <input name="pro_id" type="text" class="form-control" id="pro_id" readonly value = "<?php
            $sql = "SELECT SUBSTR(MAX(PRO_ID),2) FROM PRODUCT";
            $sql_query = mysql_query($sql) or die(mysql_error());
            $pro_id = (int)mysql_result($sql_query,0,0);
            $pro_id += 1;
            $pro_id = str_pad($pro_id, 5, "0", STR_PAD_LEFT);
            $pro_id = "P".$pro_id;

            echo $pro_id?>">
        </div>
        <div>
          <label for="sel_id">รหัสผู้ขาย :</label>
            <select class="form-control"  id="sel_id" name="sel_id" required>
              <option>กรุณาเลือกผู้ขาย</option>
              <?php
                $sql = "SELECT SEL_ID,SEL_NAME FROM SELLER ORDER BY SEL_ID";
                $sql_query = mysql_query($sql) or die(mysql_error());
                while ($row = mysql_fetch_array($sql_query)){
              ?>
                <option value="<?php echo $row['SEL_ID'] ?>"> <?php echo $row['SEL_ID']." --- ".$row['SEL_NAME'] ?></option>

              <?php
                }
              ?>
            </select>

        </div>
        <div>
          <label for="pro_name">ชื่อ :</label>
          <input name="pro_name" type="text" class="form-control" id="pro_name" required autocomplete="off">
        </div>
        <div>
          <label for="pro_buyprice">ราคาซื้อ :</label>
          <input name="pro_buyprice" type="number" min="0" max="999999" class="form-control" id="pro_buyprice" required autocomplete="off">
        </div>
        <div>
          <label for="pro_sellprice">ราคาขาย :</label>
          <input name="pro_sellprice" type="number" min="0" max="999999" class="form-control" id="pro_sellprice" required autocomplete="off">
        </div>
        <div>
          <label for="pro_detail">รายละเอียดเพิ่มเติม :</label>
          <textarea name="pro_detail" class="form-control" rows="2" id="pro_detail"></textarea>
        </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn default" data-dismiss="modal">ปิด</button>
        <button type="submit" class="btn btn-success"  id="submit">บันทึก</button>
      </div>
    </div>
    </div>
  </div>
</form>


</body>
</html>
<?php
  disconnect();
 ?>
