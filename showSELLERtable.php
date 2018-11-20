<?php
  require_once('GMSdb/connect.inc.php');
  connect();
  $sql = "SELECT SEL_ID,SEL_NAME,SEL_TEL FROM SELLER ORDER BY SEL_ID";
  $resultsql = mysql_query($sql) or die (mysql_error());

  while($row = mysql_fetch_array($resultsql)) {
    echo "<tr>";
    echo "<td>" .$row["SEL_ID"] .  "</td> ";
    echo "<td>" .$row["SEL_NAME"] .  "</td> ";
    echo "<td>" .$row["SEL_TEL"] .  "</td> ";
    echo "</tr>";
  }

  disconnect();
 ?>
