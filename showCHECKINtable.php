<?php
  require_once('GMSdb/connect.inc.php');
  connect();
  $sql = "SELECT SCH_DATE,SCH_STARTTIME,EMP_ID,EMP_FNAME,EMP_LNAME FROM SCHEDULE NATURAL JOIN EMPLOYEE ORDER BY SCH_ID";
  $resultsql = mysql_query($sql) or die (mysql_error());

  while($row = mysql_fetch_array($resultsql)) {
    echo "<tr>";
    echo "<td>" .$row["SCH_DATE"] .  "</td> ";
    echo "<td>" .$row["SCH_STARTTIME"] ."</td> ";
    echo "<td>" .$row["EMP_ID"] .  "</td> ";
    echo "<td>" .$row["EMP_FNAME"] ."    ".$row["EMP_LNAME"]. "</td> ";
    echo "</tr>";
  }

  disconnect();
 ?>
