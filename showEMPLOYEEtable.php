<?php
  require_once('GMSdb/connect.inc.php');
  connect();
  $sql = "SELECT EMP_ID,EMP_FNAME,EMP_LNAME,EMP_TEL,EMP_STATUS FROM EMPLOYEE ORDER BY EMP_ID";
  $resultsql = mysql_query($sql) or die (mysql_error());

  while($row = mysql_fetch_array($resultsql)) {
    echo "<tr>";
    echo "<td>" .$row["EMP_ID"] .  "</td> ";
    echo "<td>" .$row["EMP_FNAME"] ."    ".$row["EMP_LNAME"]. "</td> ";
    echo "<td>" .$row["EMP_TEL"] .  "</td> ";
    echo "<td>";
    if ($row["EMP_STATUS"]=='Y'){
      echo "<span class='badge badge-success'>";
      echo "ทำงาน";
      echo "</span>";
      //echo "<td><button type="button" class="btn btn-success">"'ทำงาน'"</button></td>";
    }else if ($row["EMP_STATUS"]=='N'){
      echo "<span class='badge badge-danger'>";
      echo "ออกแล้ว";
      echo "</span>";
      //echo "<td><button type="button" class="btn btn-danger">"'ออกแล้ว'"</button></td>";
    }
    echo "</td>";
    echo "</tr>";
  }

  disconnect();
 ?>
