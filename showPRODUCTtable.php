<?php
  require_once('GMSdb/connect.inc.php');
  connect();
  $sql = "SELECT PRO_ID,SEL_ID,PRO_NAME,PRO_SELLPRICE,PRO_BUYPRICE,PRO_AMOUNT,PRO_WAMOUNT,PRO_DETAIL FROM PRODUCT ORDER BY PRO_ID";
  $resultsql = mysql_query($sql) or die (mysql_error());

  while($row = mysql_fetch_array($resultsql)) {
    echo "<tr>";
    echo "<td>" .$row["PRO_ID"] .  "</td> ";
    echo "<td>" .$row["SEL_ID"] .  "</td> ";
    echo "<td>" .$row["PRO_NAME"] .  "</td> ";
    echo "<td>" .$row["PRO_SELLPRICE"] .  "</td> ";
    echo "<td>" .$row["PRO_BUYPRICE"] .  "</td> ";
    echo "<td>" .$row["PRO_AMOUNT"] .  "</td> ";
    echo "<td>" .$row["PRO_WAMOUNT"] .  "</td> ";
    echo "<td>" .$row["PRO_DETAIL"] .  "</td> ";
    echo "</tr>";
  }

  disconnect();
 ?>
