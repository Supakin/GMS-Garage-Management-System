<?php
  require_once('GMSdb/connect.inc.php');
  connect();

  if(isset($_POST['date_select'])!=true){
    $sql = "SELECT SCH_DATE,SCH_STARTTIME,SCH_FINISHTIME,EMP_ID,EMP_FNAME,EMP_LNAME FROM SCHEDULE NATURAL JOIN EMPLOYEE WHERE SCH_DATE = CURDATE() ORDER BY SCH_ID";
    $resultsql = mysql_query($sql);
    $row = mysql_fetch_array($resultsql);
  }else{
    $sql = "SELECT SCH_DATE,SCH_STARTTIME,SCH_FINISHTIME,EMP_ID,EMP_FNAME,EMP_LNAME FROM SCHEDULE NATURAL JOIN EMPLOYEE WHERE SCH_DATE = '".$_POST['date_select']."' ORDER BY SCH_ID";
    $resultsql = mysql_query($sql);
  }

  disconnect();
?>
