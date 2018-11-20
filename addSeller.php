<?php
  require_once('GMSdb/connect.inc.php');
  connect();

  $_SESSION['post']=$_POST;
  $_SESSION['error']="";

  $sql = "INSERT INTO SELLER (SEL_ID,SEL_NAME,SEL_TEL,SEL_ADDRESS,SEL_DESCRIPT) VALUES ('".$_POST["sel_id"]."','".$_POST["sel_name"]."','".$_POST["sel_tel"]."','".$_POST["sel_address"]."','".$_POST["sel_descript"]."')";

  $sql_query = mysql_query($sql);

  if($_POST["sel_id"]!=null && strlen($_POST["sel_id"])==6){
    if($sql_query){
      echo "<meta http-equiv ='refresh'content='0;URL=main_seller.php'>";
      $_SESSION['post']="";
    }else{
      echo "<script type='text/javascript'>alert('คู่ค้าท่านนี้มีอยู่แล้ว!!');window.history.go(-1);</script>" ;
    }
  }else{
    echo "<script type='text/javascript'>alert('เกิดความผิดพลาดของข้อมูล!!');window.history.go(-1);</script>" ;
  }
  disconnect();
 ?>
