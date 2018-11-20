<?php
  require_once('GMSdb/connect.inc.php');
  connect();
  $_SESSION['post']=$_POST;
  $_SESSION['error']="";
  $id = $_POST["emp_id"];

  $sql ="UPDATE EMPLOYEE SET EMP_FNAME= '".$_POST["emp_fname"]."',EMP_LNAME='".$_POST["emp_lname"]."',EMP_TEL='".$_POST["emp_tel"]."',EMP_ADDRESS ='".$_POST["emp_address"]."',EMP_SALARY ='".$_POST["emp_salary"]."',EMP_STATUS ='".$_POST["emp_status"]."' WHERE EMP_ID = '$id' ";

  $sql_query = mysql_query($sql);
  if($sql_query){
    echo "<meta http-equiv ='refresh'content='0;URL=main_employee.php'>";
    $_SESSION['post']="";
  }else{
    echo "<script type='text/javascript'>alert('เกิดความผิดพลาดของข้อมูล!!');window.history.go(-1);</script>" ;
    echo "<meta http-equiv ='refresh'content='0;URL=main_employee.php'>";
  }





  disconnect();
?>
