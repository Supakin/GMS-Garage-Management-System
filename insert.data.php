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

    //INSERT data of ORDERS to ORDERS and ORDER_DETAIL
    if(isset($_POST['action'])&&$_POST['action']=='addorder'){
      $ord_id = $_POST['orders_id'];
      $sel_id = $_POST['sel_id'];
      $ord_date = $_POST['date'];
      $ord_getdate= $_POST['getdate'];
      $ord_paydate= $_POST['paydate'] ;
      $totalprice = $_POST['totalprice'];
      $sumtotal = $_POST['sumtotal'];
      $product =$_POST['product'];
      $amount = $_POST['amount'];
      $sql = "INSERT INTO ORDERS (ORD_ID,SEL_ID,ORD_DATE,ORD_GETDATE,ORD_PAYDATE,ORD_TOTALPRICE,ORD_STATUS) VALUES (\"$ord_id\",\"$sel_id\",'".$ord_date."','".$ord_getdate."','".$ord_paydate."',$sumtotal,'N')";
      $sql_query = mysql_query($sql) or die(mysql_error());

      foreach ($amount as $key => $value) {
        $sqlid = "SELECT MAX(ORDD_NUMBER) FROM ORDER_DETAIL";
        $sqlid_query = mysql_query($sqlid);
        $ordd_id = (int)mysql_result($sqlid_query,0,0);
        $ordd_id += 1;
        $sql = "INSERT INTO ORDER_DETAIL (ORDD_NUMBER,PRO_ID,ORD_ID,ORDD_AMOUNT,ORDD_TOTALPRICE,ORDD_STATUS) VALUES ($ordd_id,\"$product[$key]\",\"$ord_id\",\"$amount[$key]\",$totalprice[$key],'N')";
        $sql_query = mysql_query($sql)  or die(mysql_error());
      }
      echo "<script type='text/javascript'>alert('เพิ่ม ".$ord_id." เรียบร้อยแล้วค่ะ');</script>" ;
      echo "<meta http-equiv ='refresh'content='0;URL=main_order.php'>";
    }

    //INSERT data of GET_PRODUCT_ORDER AND GET_PRODUCT_ORDER_DETAIL
    if(isset($_POST['action'])&&$_POST['action']=='addgetorder'){
      $gpo_id = $_POST['gpo_id'];
      $ord_id = $_POST['ord_id'];
      $date= $_POST['date'];
      $product =$_POST['product'];
      $getamount = $_POST['getamount'];

      //INSERT GETSLIP to GET_PRODUCT_ORDER!!
      $ins_gpo_sql = "INSERT INTO GET_PRODUCT_ORDER VALUES (\"$gpo_id\",\"$ord_id\",\"$date\",'N')";
      $ins_gpo_query = mysql_query($ins_gpo_sql) or die(mysql_error());

      //GET_PRODUCT_ORDER_DETAIL ....management
      foreach ($product as $key => $value) {
        //select order_datail
        $set_ordd_sql = "SELECT ORDD_NUMBER, ORDD_AMOUNT FROM ORDER_DETAIL WHERE PRO_ID = \"$value\" AND ORD_ID = \"$ord_id\" ORDER BY ORDD_NUMBER";
        $set_ordd_sql_query = mysql_query($set_ordd_sql) or die(mysql_error());
        $set_ordd = mysql_fetch_array($set_ordd_sql_query);

        //select sum(getamount) of PRODUCT
        $set_tamount_gpod_sql = "SELECT SUM(GPOD_GETAMOUNT) AS TOTALAMOUNT FROM GET_PRODUCT_ORDER NATURAL JOIN GET_PRODUCT_ORDER_DETAIL WHERE ORD_ID = \"$ord_id\" AND PRO_ID = \"$value\"";
        $set_tamount_gpod_query = mysql_query($set_tamount_gpod_sql)  or die(mysql_error());
        $sumamount = mysql_fetch_array($set_tamount_gpod_query);

        //update status PRODUCT on ORDER_DETAIL
        $tamount = 0;
        if ($sumamount['TOTALAMOUNT']==null){
          $tamount = 0;
        }else{
          $tamount = $sumamount['TOTALAMOUNT'];
        }

        if($set_ordd['ORDD_AMOUNT']- ($getamount[$key]+$tamount)==0){
          $upd_ordd_sql= "UPDATE ORDER_DETAIL SET ORDD_STATUS='Y' WHERE ORDD_NUMBER= '".$set_ordd['ORDD_NUMBER']."'";
          $upd_ordd_query = mysql_query($upd_ordd_sql) or die(mysql_query());
        }

        //GET_PRODUCT_ORDER_DETAIL .... make ID
        $gpod_id_sql = "SELECT MAX(GPOD_NUMBER) FROM GET_PRODUCT_ORDER_DETAIL";
        $gpod_id_query = mysql_query($gpod_id_sql);
        $gpod_id = (int)mysql_result($gpod_id_query,0,0);
        $gpod_id += 1;

        //GET_PRODUCT_ORDER_DETAIL .... insert to GET_PRODUCT_ORDER_DETAIL table
        $ins_gpod_sql = "INSERT INTO GET_PRODUCT_ORDER_DETAIL VALUES (\"$gpod_id\",\"$value\",\"$gpo_id\",'".$set_ordd['ORDD_NUMBER']."',\"$getamount[$key]\")";
        $ins_gpod_query = mysql_query($ins_gpod_sql) or die(mysql_error());

        //UPDATE amount on PRODUCT table
        $set_pro_sql = "SELECT PRO_AMOUNT FROM PRODUCT WHERE PRO_ID = \"$value\"";
        $set_pro_query = mysql_query($set_pro_sql) or die(mysql_error());
        $set_pro = mysql_fetch_array($set_pro_query);
        $newamount = $set_pro['PRO_AMOUNT'] + $getamount[$key];
        $upd_pro_sql = "UPDATE PRODUCT SET PRO_AMOUNT = $newamount WHERE PRO_ID = \"$value\"";
        $upd_pro_query = mysql_query($upd_pro_sql) or die(mysql_error());
      }

      //UPDATE GETSLIP .... STATUS!!
      $gpo_status;
      $set_ordd2_sql = "SELECT COUNT(ORDD_STATUS) AS COUNTN FROM ORDER_DETAIL WHERE ORD_ID = \"$ord_id\" AND ORDD_STATUS = 'N'";
      $set_ordd2_sql_query = mysql_query($set_ordd2_sql) or die(mysql_query());
      $set_ordd2 = mysql_fetch_array($set_ordd2_sql_query);

      if($set_ordd2['COUNTN']==0){
        $upd_gpo_sql = "UPDATE GET_PRODUCT_ORDER SET GPO_STATUS = 'Y' WHERE GPO_ID = \"$gpo_id\"" ;
        $upd_gpo_query = mysql_query($upd_gpo_sql) or die(mysql_error());

        //UPDATE ORD_STATUS of ORDERS
        $set_payo = "SELECT PAYO_ID FROM ORDERS NATURAL JOIN PAYMENT_ORDER WHERE ORD_ID = \"$ord_id\"";
        $set_payo_query = mysql_query($set_payo) or die(mysql_error());
        $set_payo = mysql_fetch_array($set_payo_query);
        if($set_payo['PAY_ID']!=null){
          $upd_ord_sql = "UPDATE ORDERS SET ORD_STATUS = 'Y' WHERE ORD_ID = \"$ord_id\"";
          $upd_ordd_query = mysql_query($upd_ord_sql) or die(mysql_error());
        }

      }

      echo "<script type='text/javascript'>alert('เพิ่ม ".$gpo_id." เรียบร้อยแล้วค่ะ');</script>" ;
      echo "<meta http-equiv ='refresh'content='0;URL=main_order.php'>";

    }

    //INSERT data of PAYMENT_ORDER
    if(isset($_POST['action'])&&$_POST['action']=='addpaymentorder'){
      $payo_id = $_POST['payo_id'];
      $ord_id =  $_POST['ord_id'];
      $date = $_POST['date'];
      $price = $_POST['price'];
      $ins_payo =  "INSERT INTO  PAYMENT_ORDER VALUES (\"$payo_id\",\"$ord_id\",\"$date\",\"$price\")";
      $ins_payo_query = mysql_query($ins_payo) or die(mysql_error());

      //UPDATE ORD_STATUS of ORDERS
      $set_ordd_sql = "SELECT COUNT(ORDD_STATUS) AS COUNTN FROM ORDER_DETAIL WHERE ORD_ID = \"$ord_id\" AND ORDD_STATUS = 'N'";
      $set_ordd_query = mysql_query($set_ordd_sql) or die(mysql_query());
      $set_ordd = mysql_fetch_array($set_ordd_query);

      if($set_ordd['COUNTN']==0){
        $upd_ord_sql = "UPDATE ORDERS SET ORD_STATUS = 'Y' WHERE ORD_ID = \"$ord_id\"";
        $upd_ordd_query = mysql_query($upd_ord_sql) or die(mysql_error());
      }

      echo "<script type='text/javascript'>alert('เพิ่ม ".$payo_id." เรียบร้อยแล้วค่ะ');</script>" ;
      echo "<meta http-equiv ='refresh'content='0;URL=main_order.php'>";

    }

    //INSERT data of CLAIM ORDER to CLAIMSLIP_ORDER and CLAIM_ORDER_DETAIL
    if(isset($_POST['action'])&&$_POST['action']=='addclaimorder'){
      $clo_id = $_POST['clo_id'];
      $ord_id = $_POST['ord_id'];
      $date = $_POST['date'];
      $getdate = $_POST['getdate'];
      $product =$_POST['product'];
      $amount = $_POST['amount'];
      $descript = $_POST['descript'];

      $sql = "INSERT INTO CLAIMSLIP_ORDER  VALUES (\"$clo_id\",\"$ord_id\",\"$date\",\"$getdate\",'N')";
      $sql_query = mysql_query($sql) or die(mysql_error());

      foreach ($product as $key => $value) {
        $sqlid = "SELECT MAX(CLAD_NUMBER) FROM CLAIM_ORDER_DETAIL";
        $sqlid_query = mysql_query($sqlid);
        $clad_id = (int)mysql_result($sqlid_query,0,0);
        $clad_id += 1;

        $sql2 = "SELECT ORDD_NUMBER FROM ORDERS NATURAL JOIN ORDER_DETAIL WHERE ORD_ID =\"$ord_id\" AND PRO_ID = \"$value\"";
        $sql2_query = mysql_query($sql2) or die(mysql_error());
        $orddnum = mysql_fetch_array($sql2_query);

        $sql = "INSERT INTO CLAIM_ORDER_DETAIL VALUES ($clad_id,\"$value\",\"$clo_id\",\"$amount[$key]\",\"$descript[$key]\",'N','".$orddnum['ORDD_NUMBER']."')";
        $sql_query = mysql_query($sql)  or die(mysql_error());

        //UPDATE amount on PRODUCT table
        $set_pro_sql = "SELECT PRO_AMOUNT FROM PRODUCT WHERE PRO_ID = \"$value\"";
        $set_pro_query = mysql_query($set_pro_sql) or die(mysql_error());
        $set_pro = mysql_fetch_array($set_pro_query);
        $newamount = $set_pro['PRO_AMOUNT'] - $amount[$key];
        $upd_pro_sql = "UPDATE PRODUCT SET PRO_AMOUNT = $newamount WHERE PRO_ID = \"$value\"";
        $upd_pro_query = mysql_query($upd_pro_sql) or die(mysql_error());
      }
      echo "<script type='text/javascript'>alert('เพิ่ม ".$clo_id." เรียบร้อยแล้วค่ะ');</script>" ;
      echo "<meta http-equiv ='refresh'content='0;URL=main_order.php'>";
    }

    //INSERT data of GET_PRODUCT_CLAIM_ORDER AND GET_PRODUCT_CLAIM_ORDER_DETAIL
    if(isset($_POST['action'])&&$_POST['action']=='addgetclaimorder'){
      $gpco_id = $_POST['gpco_id'];
      $clo_id = $_POST['clo_id'];
      $date= $_POST['date'];
      $product =$_POST['product'];
      $getamount = $_POST['getamount'];

      //INSERT GETCLAIMSLIP to GET_PRODUCT_CLAIM_ORDER!!
      $ins_gpco_sql = "INSERT INTO GET_PRODUCT_CLAIM_ORDER VALUES (\"$gpco_id\",\"$clo_id\",\"$date\",'N')";
      $ins_gpco_query = mysql_query($ins_gpco_sql) or die(mysql_error());

      //GET_PRODUCT_CLAIM_ORDER_DETAIL ....management
      foreach ($product as $key => $value) {
        //select order_datail
        $set_clad_sql = "SELECT CLAD_NUMBER, CLAD_AMOUNT FROM CLAIM_ORDER_DETAIL WHERE PRO_ID = \"$value\" AND CLO_ID = \"$clo_id\" ORDER BY CLAD_NUMBER";
        $set_clad_sql_query = mysql_query($set_clad_sql) or die(mysql_error());
        $set_clad = mysql_fetch_array($set_clad_sql_query);

        //select sum(getclaimamount) of PRODUCT
        $set_tamount_gpcod_sql = "SELECT SUM(GPCOD_GETAMOUNT) AS TOTALAMOUNT FROM GET_PRODUCT_CLAIM_ORDER NATURAL JOIN GET_PRODUCT_CLAIM_ORDER_DETAIL WHERE CLO_ID = \"$clo_id\" AND PRO_ID = \"$value\"";
        $set_tamount_gpcod_query = mysql_query($set_tamount_gpcod_sql)  or die(mysql_error());
        $sumamount = mysql_fetch_array($set_tamount_gpcod_query);

        //update status PRODUCT on CLAIM_ORDER_DETAIL
        $tamount = 0;
        if ($sumamount['TOTALAMOUNT']==null){
          $tamount = 0;
        }else{
          $tamount = $sumamount['TOTALAMOUNT'];
        }

        if($set_clad['CLAD_AMOUNT']- ($getamount[$key]+$tamount)==0){
          $upd_clad_sql= "UPDATE CLAIM_ORDER_DETAIL SET CLAD_STATUS='Y' WHERE CLAD_NUMBER= '".$set_clad['CLAD_NUMBER']."'";
          $upd_clad_query = mysql_query($upd_clad_sql) or die(mysql_query());
        }

        //GET_PRODUCT_CLAIM_ORDER_DETAIL .... make ID
        $gpcod_id_sql = "SELECT MAX(GPCOD_NUMBER) FROM GET_PRODUCT_CLAIM_ORDER_DETAIL";
        $gpcod_id_query = mysql_query($gpcod_id_sql);
        $gpcod_id = (int)mysql_result($gpcod_id_query,0,0);
        $gpcod_id += 1;

        //GET_PRODUCT_CLAIM_ORDER_DETAIL .... insert to GET_PRODUCT_CLAIM_ORDER_DETAIL table
        $ins_gpcod_sql = "INSERT INTO GET_PRODUCT_CLAIM_ORDER_DETAIL VALUES (\"$gpcod_id\",\"$value\",\"$gpco_id\",'".$set_clad['CLAD_NUMBER']."',\"$getamount[$key]\")";
        $ins_gpcod_query = mysql_query($ins_gpcod_sql) or die(mysql_error());

        //UPDATE amount on PRODUCT table
        $set_pro_sql = "SELECT PRO_AMOUNT FROM PRODUCT WHERE PRO_ID = \"$value\"";
        $set_pro_query = mysql_query($set_pro_sql) or die(mysql_error());
        $set_pro = mysql_fetch_array($set_pro_query);
        $newamount = $set_pro['PRO_AMOUNT'] + $getamount[$key];
        $upd_pro_sql = "UPDATE PRODUCT SET PRO_AMOUNT = $newamount WHERE PRO_ID = \"$value\"";
        $upd_pro_query = mysql_query($upd_pro_sql) or die(mysql_error());
      }

      //UPDATE GETCLAIMSLIP .... STATUS!!
      $gpco_status;
      $set_clad2_sql = "SELECT COUNT(CLAD_STATUS) AS COUNTN FROM CLAIM_ORDER_DETAIL WHERE CLO_ID = \"$clo_id\" AND CLAD_STATUS = 'N'";
      $set_clad2_sql_query = mysql_query($set_clad2_sql) or die(mysql_query());
      $set_clad2 = mysql_fetch_array($set_clad2_sql_query);

      if($set_clad2['COUNTN']==0){
        $upd_gpco_sql = "UPDATE GET_PRODUCT_CLAIM_ORDER SET GPCO_STATUS = 'Y' WHERE GPCO_ID = \"$gpco_id\"" ;
        $upd_gpco_query = mysql_query($upd_gpco_sql) or die(mysql_error());

      }

      echo "<script type='text/javascript'>alert('เพิ่ม ".$gpco_id." เรียบร้อยแล้วค่ะ');</script>" ;
      echo "<meta http-equiv ='refresh'content='0;URL=main_order.php'>";

    }

    //INSERT data of SERVICE to SERVICE table
    if(isset($_POST['action']) && $_POST['action']=='addservice'){
      $sql = "INSERT INTO SERVICE  VALUES ('".$_POST['ser_id']."','".$_POST['ser_name']."','".$_POST['ser_begincost']."')";
      $sql_query = mysql_query($sql) or die(mysql_error());

      echo "<script type='text/javascript'>alert('เพิ่ม ".$_POST['ser_id']." เรียบร้อยแล้วค่ะ');</script>" ;
      echo "<meta http-equiv ='refresh'content='0;URL=service.php'>";
    }

    //INSERT data of repairslip to CUSTOMER,CAR,REPAIRSLIP,SERVICE_DETAIL,REQUISITION TABLE ---- NEW CUSTOMER
    if(isset($_POST['action']) && $_POST['action']=='addrepairslip_newcus'){
      $rep_id = $_POST['rep_id'];
      $cus_id = $_POST['cus_id'];
      $cus_fname = $_POST['cus_fname'];
      $cus_lname = $_POST['cus_lname'];
      $cus_tel = $_POST['cus_tel'];
      $cus_address = $_POST['cus_address'];
      $date = $_POST['date'];
      $getdate = $_POST['getdate'];
      $car_license = $_POST['car_license'];
      $car_province = $_POST['car_province'];
      $car_brand = $_POST['car_brand'];
      $car_model = $_POST['car_model'];
      $car_color = $_POST['car_color'];
      $car_engine = $_POST['car_engine'];
      $car_vin = $_POST['car_vin'];
      $rep_kilomater = $_POST['rep_kilomater'];
      $rep_detail  = $_POST['rep_detail'];
      $empleader = $_POST['empleader'];
      $service = $_POST['service'];
      $seramount = $_POST['seramount'];
      $employee = $_POST['employee'];
      $product = $_POST['product'];
      $proamount = $_POST['proamount'];
      $sertotalcost = $_POST['sertotalcost'];
      $prototalcost = $_POST['prototalcost'];
      $totalcostservice = $_POST['totalcostservice'];
      $totalcostproduct = $_POST['totalcostproduct'];
      $totalcost = $_POST['totalcost'];
      $nettotalcost = $_POST['nettotalcost'];

      //INSERT data of Customer to CUSTOMER TABLE
      $ins_cus_sql = "INSERT INTO CUSTOMER VALUES (\"$cus_id\",\"$cus_fname\",\"$cus_lname\",\"$cus_tel\",\"$cus_address\")";
      $ins_cus_query = mysql_query($ins_cus_sql) or die(mysql_error());

      //INSERT data of Car to CARS TABLE
      $ins_car_sql = "INSERT INTO CARS VALUES (\"$car_vin\",\"$car_engine\",\"$car_license\",\"$cus_id\",\"$car_province\",\"$car_brand\",\"$car_model\",\"$car_color\")";
      $ins_car_query = mysql_query($ins_car_sql) or die(mysql_error());

      //INSERT data of Repairslip to REPAIRSLIP
      $ins_rep_sql = "INSERT INTO REPAIRSLIP(REP_ID,CUS_ID,CAR_VIN,EMP_ID,REP_DATE,REP_DATE_GETCAR,REP_TOTALCOST,REP_DETAIL,REP_KILOMATER,REP_REPAIRSTATUS,REP_PAYMENTSTATUS,REP_NETTOTALCOST) VALUES (\"$rep_id\",\"$cus_id\",\"$car_vin\",\"$empleader\",\"$date\",\"$getdate\",$totalcost,\"$rep_detail\",\"$rep_kilomater\",'N','N',$nettotalcost)";
      $ins_rep_query = mysql_query($ins_rep_sql) or die(mysql_error());

      //INSERT data of Service detail of SERVICE_DETAIL TABLE
      for($i=0;$i<count($service);$i++){
        //CREATE PK for SERD
        $sqlid = "SELECT MAX(SERD_NUMBER) FROM SERVICE_DETAIL";
        $sqlid_query = mysql_query($sqlid);
        $serd_number = (int)mysql_result($sqlid_query,0,0);
        $serd_number += 1;

        $ins_sed_sql = "INSERT INTO SERVICE_DETAIL VALUES ($serd_number,\"$service[$i]\",\"$employee[$i]\",$seramount[$i],\"$rep_id\",$sertotalcost[$i])";
        $ins_sed_query = mysql_query($ins_sed_sql) or die(mysql_error());
      }

      //INSERT data of Requisition product of REQUISITION TABLE
      for($i=0;$i<count($product);$i++){
        //CREATE PK for REQ
        $sqlid = "SELECT MAX(REQ_NUMBER) FROM REQUISITION";
        $sqlid_query = mysql_query($sqlid);
        $req_number = (int)mysql_result($sqlid_query,0,0);
        $req_number += 1;

        $ins_req_sql = "INSERT INTO REQUISITION VALUES ($req_number,\"$rep_id\",\"$product[$i]\",$proamount[$i],$prototalcost[$i])";
        $ins_req_query = mysql_query($ins_req_sql) or die(mysql_error());
      }

      echo "<script type='text/javascript'>alert('เพิ่ม ".$rep_id." เรียบร้อยแล้วค่ะ');</script>" ;
      echo "<meta http-equiv ='refresh'content='0;URL=main_service.php'>";
    }

    //INSERT and UPDATE data of repairslip to CUSTOMER,CAR,REPAIRSLIP,SERVICE_DETAIL,REQUISITION TABLE ---- OLD CUSTOMER
    if(isset($_POST['action']) && $_POST['action']=='addrepairslip_oldcus'){
      $rep_id = $_POST['rep_id'];
      $cus_id = $_POST['cus_id'];
      $cus_fname = $_POST['cus_fname'];
      $cus_lname = $_POST['cus_lname'];
      $cus_tel = $_POST['cus_tel'];
      $cus_address = $_POST['cus_address'];
      $date = $_POST['date'];
      $getdate = $_POST['getdate'];
      $car_license = $_POST['car_license'];
      $car_province = $_POST['car_province'];
      $car_brand = $_POST['car_brand'];
      $car_model = $_POST['car_model'];
      $car_color = $_POST['car_color'];
      $car_engine = $_POST['car_engine'];
      $car_vin = $_POST['car_vin'];
      $rep_kilomater = $_POST['rep_kilomater'];
      $rep_detail  = $_POST['rep_detail'];
      $empleader = $_POST['empleader'];
      $service = $_POST['service'];
      $seramount = $_POST['seramount'];
      $employee = $_POST['employee'];
      $product = $_POST['product'];
      $proamount = $_POST['proamount'];
      $sertotalcost = $_POST['sertotalcost'];
      $prototalcost = $_POST['prototalcost'];
      $totalcostservice = $_POST['totalcostservice'];
      $totalcostproduct = $_POST['totalcostproduct'];
      $totalcost = $_POST['totalcost'];
      $nettotalcost = $_POST['nettotalcost'];

      //UPDATE data of Customer to CUSTOMER TABLE
      if($_POST['updCustomer']=='updCustomer'){
        $upd_cus_sql = "UPDATE CUSTOMER SET CUS_FNAME = \"$cus_fname\", CUS_LNAME = \"$cus_lname\", CUS_TEL = \"$cus_tel\" , CUS_ADDRESS = \"$cus_address\"  WHERE CUS_ID = \"$cus_id\"";
        $upd_cus_query = mysql_query($upd_cus_sql) or die(mysql_error());
      }

      //INSERT data of Car to CARS TABLE
      if($_POST['checknewcar']=='new'){
        $ins_car_sql = "INSERT INTO CARS VALUES (\"$car_vin\",\"$car_engine\",\"$car_license\",\"$cus_id\",\"$car_province\",\"$car_brand\",\"$car_model\",\"$car_color\")";
        $ins_car_query = mysql_query($ins_car_sql) or die(mysql_error());
      }else{
        //UPDATE data of Car to CARS TABLE
        if($_POST['updCars']=='updCars'){
          $upd_car_sql = "UPDATE CARS SET CAR_PROVINCE = \"$car_province\", CAR_MODEL = \"$car_model\" ,CAR_BRAND = \"$car_brand\", CAR_COLOR = \"$car_color\" ,CAR_ENGINE_ID = \"$car_engine\" WHERE CAR_LICENSE = \"$car_license\" AND CAR_VIN = \"$car_vin\"";
          $upd_car_query = mysql_query($upd_car_sql) or die(mysql_error());
        }

      }

      //INSERT data of Repairslip to REPAIRSLIP
      $ins_rep_sql = "INSERT INTO REPAIRSLIP(REP_ID,CUS_ID,CAR_VIN,EMP_ID,REP_DATE,REP_DATE_GETCAR,REP_TOTALCOST,REP_DETAIL,REP_KILOMATER,REP_REPAIRSTATUS,REP_PAYMENTSTATUS,REP_NETTOTALCOST) VALUES (\"$rep_id\",\"$cus_id\",\"$car_vin\",\"$empleader\",\"$date\",\"$getdate\",$totalcost,\"$rep_detail\",\"$rep_kilomater\",'N','N',$nettotalcost)";
      $ins_rep_query = mysql_query($ins_rep_sql) or die(mysql_error());

      //INSERT data of Service detail of SERVICE_DETAIL TABLE
      for($i=0;$i<count($service);$i++){
        //CREATE PK for SERD
        $sqlid = "SELECT MAX(SERD_NUMBER) FROM SERVICE_DETAIL";
        $sqlid_query = mysql_query($sqlid);
        $serd_number = (int)mysql_result($sqlid_query,0,0);
        $serd_number += 1;

        $ins_sed_sql = "INSERT INTO SERVICE_DETAIL VALUES ($serd_number,\"$service[$i]\",\"$employee[$i]\",$seramount[$i],\"$rep_id\",$sertotalcost[$i])";
        $ins_sed_query = mysql_query($ins_sed_sql) or die(mysql_error());
      }

      //INSERT data of Requisition product of REQUISITION TABLE
      for($i=0;$i<count($product);$i++){
        //CREATE PK for REQ
        $sqlid = "SELECT MAX(REQ_NUMBER) FROM REQUISITION";
        $sqlid_query = mysql_query($sqlid);
        $req_number = (int)mysql_result($sqlid_query,0,0);
        $req_number += 1;

        $ins_req_sql = "INSERT INTO REQUISITION VALUES ($req_number,\"$rep_id\",\"$product[$i]\",$proamount[$i],$prototalcost[$i])";
        $ins_req_query = mysql_query($ins_req_sql) or die(mysql_error());
      }

      echo "<script type='text/javascript'>alert('เพิ่ม ".$rep_id." เรียบร้อยแล้วค่ะ');</script>" ;
      echo "<meta http-equiv ='refresh'content='0;URL=main_service.php'>";
    }



  disconnect();
?>
