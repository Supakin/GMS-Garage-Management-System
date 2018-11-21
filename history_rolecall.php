<?php
  require_once('GMSdb/connect.inc.php');
  connect();

  $_SESSION['post']=$_POST;
  $_SESSION['error']="";
  $dateselect = $_POST['date_select'];

  if($dateselect == null){
    echo "<script type='text/javascript'>alert('กรุณาระบุวันที่ต้องการจะดู!!');window.history.go(-1);</script>" ;
  }else if($dateselect > date("Y-m-d")){
    echo "<script type='text/javascript'>alert('วันที่ $dateselect เกินวันปัจจุบัน!!');window.history.go(-1);</script>" ;
  }else if($dateselect== date("Y-m-d")){
    echo "<script type='text/javascript'>alert('วันที่ $dateselect อยู่ในระหว่างการดำเนินการ!!');window.history.go(-1);</script>" ;
  }else{
    $sql = "SELECT SCH_DATE,SCH_STARTTIME,SCH_FINISHTIME,EMP_ID,EMP_FNAME,EMP_LNAME,TIMEDIFF(SCH_FINISHTIME,SCH_STARTTIME) AS AMOUNTHOURS FROM SCHEDULE NATURAL JOIN EMPLOYEE WHERE SCH_DATE = '$dateselect'";
    $sql_query = mysql_query($sql);
    include('main_history_rolecall.php');

  }



  disconnect();
?>
