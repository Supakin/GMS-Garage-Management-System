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
        $check_noin = "SELECT EMP_ID,SCH_FINISHTIME FROM SCHEDULE WHERE SCH_DATE=CURDATE() AND EMP_ID='$id'";
        $check_noin_query = mysql_query($check_noin);
        $row = mysql_fetch_array($check_noin_query);

        if(mysql_num_rows($check_noin_query)==0){
          echo "<script type='text/javascript'>alert('คุณยังไม่ได้ลงเวลาเข้า!!');window.history.go(-1);</script>" ;

        }else{
          if($row["SCH_FINISHTIME"]=='00:00:00'){
            $sql = "UPDATE SCHEDULE SET SCH_FINISHTIME=CURTIME() WHERE SCH_DATE=CURDATE() AND EMP_ID = '$id'";
            $sql_query = mysql_query ($sql);


            $upd_amounth_sql = "UPDATE SCHEDULE SET SCH_AMOUNTHOUR = TIMEDIFF(SCH_FINISHTIME,SCH_STARTTIME) WHERE SCH_DATE=CURDATE() AND EMP_ID = '$id'";
            $upd_amounth_query = mysql_query($upd_amount_sql);

            if($sql_query){
              echo "<meta http-equiv ='refresh'content='0;URL=main_employee_rolecall.php'>";
              $_SESSION['post']="";
            }else{
                echo "<script type='text/javascript'>alert('ระบบผิดพลาด!!');window.history.go(-1);</script>" ;
            }
          }else{
            echo "<script type='text/javascript'>alert('คุณลงเวลาออกแล้ว!!');window.history.go(-1);</script>" ;
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
