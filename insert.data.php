<?php
  require_once('GMSdb/connect.inc.php');
  connect();

    //INSERT data of PRODUCT to PRODUCT table
    if(isset($_POST['action'])&&$_POST['action']=='addproduct'){
      $sql = "INSERT INTO PRODUCT(PRO_ID,SEL_ID,PRO_NAME,PRO_BUYPRICE,PRO_SELLPRICE,PRO_DETAIL) VALUES ('".$_POST["pro_id"]."','".$_POST["sel_id"]."','".$_POST["pro_name"]."','".$_POST["pro_buyprice"]."','".$_POST["pro_sellprice"]."','".$_POST["pro_detail"]."')";
      $sql_query = mysql_query($sql) or die(mysql_error());
      echo "<meta http-equiv ='refresh'content='0;URL=main_product.php'>";
    }

    //INSERT data of SELLER to SELLER table
    if(isset($_POST['action'])&&$_POST['action']=='addseller'){
      $sql = "INSERT INTO SELLER (SEL_ID,SEL_NAME,SEL_TEL,SEL_ADDRESS,SEL_DESCRIPT) VALUES ('".$_POST["sel_id"]."','".$_POST["sel_name"]."','".$_POST["sel_tel"]."','".$_POST["sel_address"]."','".$_POST["sel_descript"]."')";
      $sql_query = mysql_query($sql) or die(mysql_error());
      echo "<meta http-equiv ='refresh'content='0;URL=main_seller.php'>";
    }

    //INSERT data of EMPLOYEE to EMPLOYEE table
    if(isset($_POST['action'])&&$_POST['action']=='addemployee'){
      $sql = "INSERT INTO EMPLOYEE(EMP_ID,EMP_FNAME,EMP_LNAME,EMP_GENDER,EMP_TEL,EMP_ADDRESS,EMP_DATE_BEGINWORK,EMP_SALARY,EMP_STATUS) VALUES ('".$_POST["emp_id"]."','".$_POST["emp_fname"]."','".$_POST["emp_lname"]."','".$_POST["emp_gender"]."','".$_POST["emp_tel"]."','".$_POST["emp_address"]."','".$_POST["emp_date_beginwork"]."','".$_POST["emp_salary"]."','Y')";

      $sql_query = mysql_query($sql) or die(mysql_error());
      echo "<meta http-equiv ='refresh'content='0;URL=main_employee.php'>";
    }

  disconnect();
?>
