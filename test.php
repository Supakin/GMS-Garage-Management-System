<?php
require_once('GMSdb/connect.inc.php');
connect();

$_SESSION['post']=$_POST;
$_SESSION['error']="";
$id = 'E00006';


$check_noin = "SELECT EMP_ID,SCH_FINISHTIME FROM SCHEDULE WHERE SCH_DATE=CURDATE() AND EMP_ID='$id'";
$check_noin_query = mysql_query($check_noin);
$row = mysql_fetch_array($check_noin_query);


echo mysql_num_rows($check_noin_query);


disconnect();

 ?>
