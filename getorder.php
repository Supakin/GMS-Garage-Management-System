<?php
  require_once('GMSdb/connect.inc.php');
  connect();
  $ord_id = $_POST['ord_id'];
  $ord_getdate= $_POST['getdate'];
  $product =$_POST['product'];
  $getamount = $_POST['getamount'];

  //clear 0 or null for getamount[]
  for($i=0;$i<count($product);$i++){
    if($getamount[$i]==null|| $getamount[$i]==0){
      unset($getamount[$i]);
      unset($product[$i]);
    }
  }

  //GET_PRODUCT_ORDER .... make GPO_ID
  $gpo_id_sql = "SELECT MAX(GPO_ID) FROM GET_PRODUCT_ORDER";
  $gpo_id_sql_query = mysql_query($gpo_id_sql) or die(mysql_error());
  $gpo_id = (int)mysql_result($gpo_id_sql_query,0,0);
  $gpo_id += 1;
  $gpo_id = str_pad($gpo_id, 10, "0", STR_PAD_LEFT);

  //INSERT GETSLIP FROM ORDER!!
  $ins_gpo_sql = "INSERT INTO GET_PRODUCT_ORDER VALUES (\"$gpo_id\",\"$ord_id\",'".$ord_getdate."','N')";
  $ins_gpo_query = mysql_query($ins_gpo_sql) or die(mysql_error());


  //GET_PRODUCT_ORDER_DETAIL ....management
  foreach ($product as $key => $value) {
    //select order_datail
    $set_ordd_sql = "SELECT ORDD_NUMBER, ORDD_AMOUNT FROM ORDER_DETAIL WHERE PRO_ID = \"$value\" AND ORD_ID = \"$ord_id\" ORDER BY ORDD_NUMBER";
    $set_ordd_sql_query = mysql_query($set_ordd_sql) or die(mysql_error());
    $set_ordd = mysql_fetch_array($set_ordd_sql_query);

    //select sum(getamount) of PRODUCT
    $set_tamount_gpod_sql = "SELECT SUM(GPOD_GETAMOUNT) AS TOTALAMOUNT FROM GET_PRODUCT_ORDER NATURAL JOIN GET_PRODUCT_ORDER_DETAIL WHERE ORD_ID = \"$ord_id\" AND PRO_ID = \"$value\"";
    $set_tamount_gpod_query = mysql_query($set_tamount_gpod_sql)  or die(mysql_error());
    $sumamount = mysql_fetch_array($set_tamount_gpod_query);

    //update status PRODUCT on ORDER_DETAIL
    $tamount = 0;
    if ($sumamount['TOTALAMOUNT']==null){
      $tamount = 0;
    }else{
      $tamount = $sumamount['TOTALAMOUNT'];
    }

    if($set_ordd['ORDD_AMOUNT']- ($getamount[$key]+$tamount)==0){
      $upd_ordd_sql= "UPDATE ORDER_DETAIL SET ORDD_STATUS='Y' WHERE ORDD_NUMBER= '".$set_ordd['ORDD_NUMBER']."'";
      $upd_ordd_query = mysql_query($upd_ordd_sql);
    }

    //GET_PRODUCT_ORDER_DETAIL .... make ID
    $gpod_id_sql = "SELECT MAX(GPOD_NUMBER) FROM GET_PRODUCT_ORDER_DETAIL";
    $gpod_id_query = mysql_query($gpod_id_sql);
    $gpod_id = (int)mysql_result($gpod_id_query,0,0);
    $gpod_id += 1;

    //GET_PRODUCT_ORDER_DETAIL .... insert to table
    $ins_gpod_sql = "INSERT INTO GET_PRODUCT_ORDER_DETAIL VALUES (\"$gpod_id\",\"$value\",\"$gpo_id\",'".$set_ordd['ORDD_NUMBER']."',\"$getamount[$key]\")";
    $ins_gpod_query = mysql_query($ins_gpod_sql) or die(mysql_error());



    //UPDATE amount on PRODUCT table
    $set_pro_sql = "SELECT PRO_AMOUNT FROM PRODUCT WHERE PRO_ID = \"$value\"";
    $set_pro_query = mysql_query($set_pro_sql) or die(mysql_error());
    $set_pro = mysql_fetch_array($set_pro_query);
    $newamount = $set_pro['PRO_AMOUNT'] + $getamount[$key];
    $upd_pro_sql = "UPDATE PRODUCT SET PRO_AMOUNT = $newamount WHERE PRO_ID = \"$value\"";
    $upd_pro_query = mysql_query($upd_pro_sql) or die(mysql_error());
  }

  //UPDATE GETSLIP .... STATUS!!
  $gpo_status;
  $set_ordd2_sql = "SELECT COUNT(ORDD_STATUS) AS COUNTN FROM ORDER_DETAIL WHERE ORD_ID = \"$ord_id\" AND ORDD_STATUS = 'N'";
  $set_ordd2_sql_query = mysql_query($set_ordd2_sql);
  $set_ordd2 = mysql_fetch_array($set_ordd2_sql_query);

  if($set_ordd2['COUNTN']>0){
    $gpo_status = 'N';
  }else{
    $gpo_status = 'Y';
  }

  $upd_gpo_sql = "UPDATE GET_PRODUCT_ORDER SET GPO_STATUS = \"$gpo_status\" WHERE GPO_ID = \"$gpo_id\"" ;
  $upd_gpo_query = mysql_query($upd_gpo_sql);

  echo "<script type='text/javascript'>alert('ระบบรับสินค้าเรียบร้อยแล้วค่ะ');</script>" ;
  echo "<meta http-equiv ='refresh'content='0;URL=main_order.php'>";



disconnect();
?>
