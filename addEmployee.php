<?php
  require_once('GMSdb/connect.inc.php');
  connect();

  $_SESSION['post']=$_POST;
  $_SESSION['error']="";

  $sql = "INSERT INTO EMPLOYEE(EMP_ID,EMP_FNAME,EMP_LNAME,EMP_GENDER,EMP_TEL,EMP_ADDRESS,EMP_DATE_BEGINWORK,EMP_SALARY,EMP_STATUS) VALUES ('".$_POST["emp_id"]."','".$_POST["emp_fname"]."','".$_POST["emp_lname"]."','".$_POST["emp_gender"]."','".$_POST["emp_tel"]."','".$_POST["emp_address"]."','".$_POST["emp_date_beginwork"]."','".$_POST["emp_salary"]."','Y')";

  $sql_query = mysql_query($sql);
  if($_POST["emp_id"]!=null && strlen($_POST["emp_id"])==6){
    if($sql_query){
      echo "<meta http-equiv ='refresh'content='0;URL=main_employee.php'>";
      $_SESSION['post']="";
    }else{
      echo "<script type='text/javascript'>alert('พนักงานคนนี้มีอยู่แล้ว!!');window.history.go(-1);</script>" ;
    }
  }else{
    echo "<script type='text/javascript'>alert('เกิดความผิดพลาดของข้อมูล!!');window.history.go(-1);</script>" ;
  }

    disconnect();
?>
