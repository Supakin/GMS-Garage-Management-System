<?php
  require_once('GMSdb/connect.inc.php');
  connect();
  $sql = "SELECT * FROM EMPLOYEE WHERE EMP_ID = '".$_POST["emp_id"]."'";
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
         <h3>แก้ไขข้อมูลพนักงาน</h3>
       </div>
       <div class="col-1 justify-content-end">
           <button type="button" class="btn default" onclick='location.replace("main_employee.php")'>ปิด</button>
       </div>
      </div>
     <form  method="post" action="update.data.php">
       <input type="hidden" name="action" value="editemployee">
     <div class="row justify-content-center">
       <div class="col-5">
           <div class="form-group">
             <label for="emp_id">รหัสพนักงาน :</label>
             <input name="emp_id" type="text" class="form-control" id="emp_id" value="<?=$row['EMP_ID'] ?>" readonly>
           </div>
           <div class="form-group">
             <label for="emp_fname">ชื่อ :</label>
             <input name="emp_fname" type="text" class="form-control" id="emp_fname" value="<?=$row['EMP_FNAME'] ?>" required  autocomplete="off">
           </div>
           <div class="form-group">
             <label for="emp_lname">นามสกุล :</label>
             <input name="emp_lname" type="text" class="form-control" id="emp_lname" value="<?=$row['EMP_LNAME'] ?>" required  autocomplete="off">
           </div>
           <div class="form-group">
             <label for="emp_tel">เบอร์เบอร์โทรติดต่อ :</label>
             <input name="emp_tel" type="text" class="form-control" id="emp_tel" value="<?=$row['EMP_TEL'] ?>" required  autocomplete="off">
           </div>
           <div clas="form-group">
             <label for="emp_address">ที่อยู่ :</label>
             <textarea name="emp_address" class="form-control" rows="2" id="emp_address" required  autocomplete="off"><?=$row['EMP_ADDRESS'] ?></textarea>
           </div>
           <div class="form-group">
             <label for="emp_salary">เงินเดือน :</label>
             <input name="emp_salary" type="text" class="form-control" id="emp_salary" value="<?=$row['EMP_SALARY'] ?>" required  autocomplete="off">
           </div>
           <div class="form-group">
             <label for="emp_status">สถานะ :</label>
             <select class="form-control"  id="emp_status" name="emp_status">
               <?php
                  if ($row['EMP_STATUS']=='Y'){
               ?>
                 <option value="Y"> <?php echo "ทำงานอยู่" ?></option>
                 <option value="N"> <?php echo "ออกแล้ว" ?></option>
               <?php
                  }else{
               ?>
                <option value="N"> <?php echo "ออกแล้ว" ?></option>
                <option value="Y"> <?php echo "ทำงานอยู่" ?></option>
               <?php
                  }
               ?>
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
