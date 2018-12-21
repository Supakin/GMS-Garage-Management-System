<?php
require_once('GMSdb/connect.inc.php');
connect();

$check_get_sql = "SELECT COUNT(GPO_STATUS) AS CHECKGET FROM GET_PRODUCT_ORDER WHERE ORD_ID = '0000000003' AND GPO_STATUS = 'Y'";
$check_get_query = mysql_query($check_get_sql);
$check_get = mysql_fetch_array($check_get_query);
echo  $check_get['CHECKGET'];




disconnect();

 ?>
