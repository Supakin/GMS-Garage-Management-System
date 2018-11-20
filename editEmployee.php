<?php
  require_once('GMSdb/connect.inc.php');
  connect();

  $_SESSION['post']=$_POST;
  $_SESSION['error']="";

  $sql = "SELECT * FROM EMPLOYEE WHERE EMP_ID = '".$_POST["emp_id"]."'";

  $sql_query = mysql_query($sql);
  $row = mysql_fetch_array($sql_query);

  if($row['EMP_ID']!= null){
    if($sql_query){
      include('editEmployee.html.php');
      $_SESSION['post']="";
    }else{
      echo "<script type='text/javascript'>alert('ไม่พบรหัสพนักงานนี้!!');window.history.go(-1);</script>" ;
    }
  }else{
    echo "<script type='text/javascript'>alert('ไม่พบรหัสพนักงานนี้!!');window.history.go(-1);</script>" ;
  }

  disconnect();
 ?>
