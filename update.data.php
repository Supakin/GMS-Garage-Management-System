<?php
  require_once('GMSdb/connect.inc.php');
  connect();

    //UPDATE data of EMPLOYEE
    if(isset($_POST['action'])&&$_POST['action']=='editemployee'){
      $sql ="UPDATE EMPLOYEE SET EMP_FNAME= '".$_POST["emp_fname"]."',EMP_LNAME='".$_POST["emp_lname"]."',EMP_TEL='".$_POST["emp_tel"]."',EMP_ADDRESS ='".$_POST["emp_address"]."',EMP_SALARY ='".$_POST["emp_salary"]."',EMP_STATUS ='".$_POST["emp_status"]."' WHERE EMP_ID = '".$_POST["emp_id"]."' ";
      $sql_query = mysql_query($sql) or die(mysql_error());
      echo "<meta http-equiv ='refresh'content='0;URL=main_employee.php'>";
    }

    //UPDATE data of SERVICE
    if(isset($_POST['action']) && $_POST['action']=='editservice'){
      $sql = "UPDATE SERVICE SET SER_NAME = '".$_POST["ser_name"]."',SER_BEGINCOST = '".$_POST["ser_begincost"]."' WHERE SER_ID = '".$_POST["ser_id"]."'";
      $sql_query = mysql_query($sql) or die(mysql_error());
      echo "<meta http-equiv ='refresh'content='0;URL=service.php'>";
    }

  disconnect();
?>
