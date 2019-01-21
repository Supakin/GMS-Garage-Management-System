<?php
  require_once('GMSdb/connect.inc.php');
  connect();
  if(isset($_POST['action']) && $_POST['action']=='delinjury'){
    $inj_id = $_POST['inj_id'];

    //SELECT injury
    $sel_inj_sql = "SELECT * FROM INJURY NATURAL JOIN PRODUCT WHERE INJ_ID = \"$inj_id\"";
    $sel_inj_query = mysql_query($sel_inj_sql) or die(mysql_error());
    $product = mysql_fetch_array($sel_inj_query);

    //UPDATE wammount to PRODUCT table
    $newwamount = $product['PRO_WAMOUNT']-$product['INJ_AMOUNT'];
    $upd_pro_sql = "UPDATE PRODUCT SET PRO_WAMOUNT = $newwamount WHERE PRO_ID = '".$product['PRO_ID']."'";
    $upd_pro_query = mysql_query($upd_pro_sql) or die(mysql_error());

    //DELETE INJURY
    $del_inj_sql = "DELETE FROM INJURY WHERE INJ_ID = \"$inj_id\"";
    $del_inj_query = mysql_query($del_inj_sql) or die(mysql_error());

    echo "<script type='text/javascript'>alert('ลบรหัสชำรุด : ".$inj_id." เรียบร้อยแล้วค่ะ');</script>" ;
    echo "<meta http-equiv ='refresh'content='0;URL=injury.php'>";

  }

  if(isset($_POST['action']) && $_POST['action']=='delorder'){
    $ord_id = $_POST['ord_id'];

    //DELETE ORDER_DETAIL
    $del_ordd_sql = "DELETE FROM ORDER_DETAIL WHERE ORD_ID = \"$ord_id\"";
    $del_ordd_query = mysql_query($del_ordd_sql) or die(mysql_error());

    //DELETE ORDERS
    $del_ord_sql = "DELETE FROM ORDERS WHERE ORD_ID = \"$ord_id\"";
    $del_ord_query = mysql_query($del_ord_sql) or die(mysql_error());

    echo "<script type='text/javascript'>alert('ลบรหัสชำรุด : ".$ord_id." เรียบร้อยแล้วค่ะ');</script>" ;
    echo "<meta http-equiv ='refresh'content='0;URL=main_order.php'>";

  }




  disconnect();
?>
