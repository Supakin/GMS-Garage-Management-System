<?php
require_once('user.inc.php');
//Creat_connection
/*$hostname_connection = "localhost";
$database_connection = "GMSdb";
$username_connection = "root";
$password_connection = "root";*/

function connect(){
  global $connection;
  $connection = mysql_connect(DBHOST, DBUSER, DBPASS) or trigger_error(mysql_error(),E_USER_ERROR);
  mysql_select_db(DBNAME) or die("error FFFFFF");
  mysql_query("SET NAMES UTF8");
}

function disconnect() {
  global $connection;
  mysql_close($connection);
}

?>
