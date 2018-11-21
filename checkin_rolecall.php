<?php
  require_once('GMSdb/connect.inc.php');
  connect();

  $_SESSION['post']=$_POST;
  $_SESSION['error']="";
  $id = $_POST['emp_id'];

  if($_POST["emp_id"]!=null && strlen($_POST["emp_id"])==6){

    $check_status = "SELECT EMP_STATUS FROM EMPLOYEE WHERE EMP_ID = '$id'";
    $check_status_query = mysql_query($check_status);
    $row = mysql_fetch_array($check_status_query);

    if(mysql_num_rows($check_status_query)==0){
      echo "<script type='text/javascript'>alert('ไม่พบรหัสพนักงานนี้!!');window.history.go(-1);</script>" ;
    }else{
      if($row["EMP_STATUS"]=='Y'){
        $check_doubly = "SELECT * FROM SCHEDULE WHERE SCH_DATE=CURDATE() AND EMP_ID='$id'";
        $check_doubly_query = mysql_query($check_doubly);

        if(mysql_num_rows($check_doubly_query)>0){
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


          if($sql_query){
            echo "<meta http-equiv ='refresh'content='0;URL=main_employee_rolecall.php'>";
            $_SESSION['post']="";
          }else{
            echo "<script type='text/javascript'>alert('ระบบผิดพลาด!!');window.history.go(-1);</script>" ;
          }
        }
      }else{
        echo "<script type='text/javascript'>alert('พนักงานคนนี้ออกแล้ว!!');window.history.go(-1);</script>" ;
      }
    }
  }else{
    echo "<script type='text/javascript'>alert('รูปแบบรหัสพนักงานไม่ถูกต้อง!!');window.history.go(-1);</script>" ;
  }
  disconnect();
 ?>
