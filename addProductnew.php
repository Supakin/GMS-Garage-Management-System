<?php
  require_once('GMSdb/connect.inc.php');
  connect();

  $_SESSION['post']=$_POST;
  $_SESSION['error']="";

  $sql = "INSERT INTO PRODUCT(PRO_ID,SEL_ID,PRO_NAME,PRO_SELLPRICE,PRO_BUYPRICE,PRO_AMOUNT,PRO_DETAIL) VALUES ('".$_POST["pro_id"]."','".$_POST["sel_id"]."','".$_POST["pro_name"]."','".$_POST["pro_sellprice"]."','".$_POST["pro_buyprice"]."','".$_POST["pro_amount"]."','".$_POST["pro_detail"]."')";

  $sql_query = mysql_query($sql);
  
  if($_POST["pro_id"]!=null && strlen($_POST["pro_id"])==6){
    if($sql_query){
      echo "<meta http-equiv ='refresh'content='0;URL=main_product.php'>";
      $_SESSION['post']="";
    }else{
      echo "<script type='text/javascript'>alert('สินค้านี้มีอยู่แล้ว!!');window.history.go(-1);</script>" ;
    }
  }else{
    echo "<script type='text/javascript'>alert('เกิดความผิดพลาดของข้อมูล!!');window.history.go(-1);</script>" ;
  }

  disconnect();55
?>
