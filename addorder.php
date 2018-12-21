<?php
  require_once('GMSdb/connect.inc.php');
  connect();
  $ord_id = $_POST['orders_id'];
  $sel_id = $_POST['sel_id'];
  $ord_date = $_POST['date'];
  $ord_getdate= $_POST['getdate'];
  $ord_paydate= $_POST['paydate'] ;
  $totalprice = $_POST['totalprice'];
  $sumtotal = $_POST['sumtotal'];
  $product =$_POST['product'];
  $amount = $_POST['amount'];

  $sql = "INSERT INTO ORDERS (ORD_ID,SEL_ID,ORD_DATE,ORD_GETDATE,ORD_PAYDATE,ORD_TOTALPRICE,ORD_STATUS) VALUES (\"$ord_id\",\"$sel_id\",'".$ord_date."','".$ord_getdate."','".$ord_paydate."',$sumtotal,'N')";
  $sql_query = mysql_query($sql) or die(mysql_error());

  foreach ($amount as $key => $value) {
    $sqlid = "SELECT MAX(ORDD_NUMBER) FROM ORDER_DETAIL";
    $sqlid_query = mysql_query($sqlid);
    $ordd_id = (int)mysql_result($sqlid_query,0,0);
    $ordd_id += 1;
    $sql = "INSERT INTO ORDER_DETAIL (ORDD_NUMBER,PRO_ID,ORD_ID,ORDD_AMOUNT,ORDD_TOTALPRICE) VALUES ($ordd_id,\"$product[$key]\",\"$ord_id\",\"$amount[$key]\",$totalprice[$key])";
    $sql_query = mysql_query($sql)  or die(mysql_error());

  }
  echo "<script type='text/javascript'>alert('ระบบได้เพิ่มออร์เดอร์เรียบร้อยแล้ว');</script>" ;
  echo "<meta http-equiv ='refresh'content='0;URL=main_order.php'>";




  disconnect();
?>
