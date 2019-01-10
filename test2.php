<?php
 require_once('GMSdb/connect.inc.php');
 connect();
 if(isset($_POST['cost']) && isset($_POST['id'])){
   $sql = "SELECT SER_BEGINCOST FROM SERVICE WHERE SER_ID = '".$_POST['id']."'";
   $sql_query = mysql_query($sql) or die(mysql_error());
   $result = mysql_fetch_array($sql_query);


   echo  "<script>document.getElementById($_POST['cost']).value= $result['SER_BEGINCOST']</script>";


 }



 disconnect();
?>
