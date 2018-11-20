<<?php
  require_once('GMSdb/connect.inc.php');
  connect();

  $_SESSION['post']=$_POST;
  $_SESSION['error']="";
  $id = $_POST['emp_id'];


  $check = "SELECT * FROM SCHEDULE WHERE SCH_DATE=CURDATE() AND EMP_ID='$id'";
  $check_query = mysql_query($check) or die (mysql_error());

  if(mysql_num_rows($check_query)>0){
    echo "<script type='text/javascript'>alert('คุณลงเวลาเข้าแล้ว!!');window.history.go(-1);</script>" ;
  }else{
    $sql = "INSERT INTO SCHEDULE (SCH_ID,EMP_ID,SCH_DATE,SCH_STARTTIME) VALUES (
        CONCAT(
            DATE_FORMAT(NOW(), '%Y%m%d'),
              LPAD(
                IFNULL(
                    (SELECT
                        MAX(SUBSTR(SCH_ID, 9))
                        FROM SCHEDULE as alias
                        WHERE SUBSTR(SCH_ID, 1, 8) = DATE_FORMAT(NOW(), '%Y%m%d')
                        ORDER BY SCH_ID DESC
                        LIMIT 1
                    )+1,1
                ),2,'0'
              )
        )
    ,'$id',CURDATE(),CURTIME() )";

    $sql_query = mysql_query($sql);
    if($_POST["emp_id"]!=null && strlen($_POST["emp_id"])==6){
      if($sql_query){
        echo "<script type='text/javascript'>alert('บันทึกข้อมูลเรียบร้อยแล้ว');window.history.go(-1);</script>";
        echo "<meta http-equiv ='refresh'content='0;URL=rolecall_employee.html.php'>";
        $_SESSION['post']="";
      }else{
        echo "<script type='text/javascript'>alert('ไม่พบรหัสพนักงานนี้!!');window.history.go(-1);</script>" ;
      }
    }else{
      echo "<script type='text/javascript'>alert('เกิดความผิดพลาดของข้อมูล!!');window.history.go(-1);</script>" ;
    }
  }

  disconnect();
 ?>
