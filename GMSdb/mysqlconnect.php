<?php

//Creat_connection
$hostname_connection = "localhost";
$database_connection = "GMSdb";
$username_connection = "root";
$password_connection = "root";
$connection = mysql_pconnect($hostname_connection, $username_connection, $password_connection) or trigger_error(mysql_error(),E_USER_ERROR);
mysql_query("SET NAMES UTF8");

?>
