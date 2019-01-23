<?php
  require_once('GMSdb/connect.inc.php');
  connect();
  $sql = "SELECT * FROM PRODUCT WHERE PRO_ID = '".$_POST["pro_id"]."'";
  $sql_query = mysql_query($sql);
  $row = mysql_fetch_array($sql_query);
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

 <!--font-Thai-->
 <link href="https://fonts.googleapis.com/css?family=Athiti" rel="stylesheet">
 </head>

 <body id="main">
   <div class= "container">
     <div class="row justify-content-center">
       <div class="col-4">
         <h3>จัดการอะไหล่ชำรุด</h3>
       </div>
       <div class="col-1 justify-content-end">
           <button type="button" class="btn default" onclick='window.history.go(-1);'>ปิด</button>
       </div>
      </div>
     <form  method="post" action="insert.data.php">
       <input type="hidden" name="action" value="addclearing">
     <div class="row justify-content-center">
       <div class="col-5">
           <div class="form-group">
             <label for="pro_id">รหัสอะไหล่ :</label>
             <input name="pro_id" type="text" class="form-control"  value="<?=$row['PRO_ID'] ?>" readonly>
           </div>
           <div class="form-group">
             <label for="pro_name">ชื่อ :</label>
             <input name="pro_name" type="text" class="form-control"  value="<?=$row['PRO_NAME'] ?>" required  readonly>
           </div>
           <div class="form-group">
             <label for="cle_amount">จำนวน :</label>
             <input name="amount" type="number" class="form-control" max="<?=$row['PRO_WAMOUNT'] ?>" required  autocomplete="off">
           </div>
           <div class="form-group">
             <label for="cle_descript">หมายเหตุ :</label>
             <input name="descript" type="text" class="form-control" value=""  required  autocomplete="off">
           </div>
           <div class="form-group">
             <label for="make">วิธีจัดการ :</label>
             <select class="form-control" name="make" required>
               <option value="">เลิอกวิธีจัดการ</option>
               <option value="1">กลับเข้าระบบ</option>
               <option value="2">หายจากระบบ</option>
             </select>
           </div>
       </div>
     </div>
     <div class="row justify-content-center">
       <button name="save" type="submit" class="btn btn-success" id="submit" >บันทึก</button>
     </div>
     </form>
   </div>


 </body>
 </html>

<?php
  disconnect();
 ?>
