<?php
header("Content-type:application/json; charset=UTF-8");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
require_once('GMSdb/connect.inc.php');
connect();

////////////////////////////// BEGIN GET LISTITEM //////////////////////////////////////
////////// ส่วนของการคิวรี่แสดงรายการทั้งหมด พร้อมการแบ่งหน้า
if(isset($_POST['action']) && $_POST['action']=="list"){


	$per_page = 10;  // ตัวแปรเก็บจำนวนรายการที่่ต้องการแสดงในแต่ละหน้า (เปลี่ยนค่าได้)

	// รายการต่อไปนี้ไม่ต้องเปลี่ยนค่า
	$total = 0; // ตัวแปรจำนวนข้อูลทั้งหมด
	$start_page = 0; // ตัวแปรเก็บตัวกำหนด offset ใน LIMIT คำส่ัง sql
	$cur_page = 1; // ตำแปรเก็บหน้าปัจจุบัน
	$chk_page = 0;  // ตำแปรเก็บหน้าตรวจสอบ

	// คำสั่ง sql เปลี่ยนค่าตามต้องการ
	$sql = "SELECT * FROM PRODUCT";

	// รายการต่อไปนี้ไม่ต้องเปลี่ยนค่า
	$result = $mysqli->query($sql);
	if($result && $result->num_rows > 0){ // มีรายการข้อมูล
		$total = $result->num_rows; // นับจำนวนรายการทั้งหมดแล้วเก็บในตัวแปร $total
	}
	// มีการส่งหน้าที่ต้องการแสดงมา
	if(isset($_POST['page']) && $_POST['page']>0){
		// เปลี่ยนค่าตัวแปรตามเงื่อนไขค่าที่ส่งมา
		$chk_page = $_POST['page'];
		$cur_page = $_POST['page']+1;
		$start_page = $_POST['page']*$per_page;
	}
	$sql.="LIMIT ".$start_page.",".$per_page."";
	$i=0;
	$result = $mysqli->query($sql);
	if($result && $result->num_rows > 0){
		while($row = $result->fetch_assoc()){
			$i++;
			// เปลี่ยนค่าตามต้องการ item_id ในที่นี้จะเป็นเลขลำดับ ไม่จำเป็นต้องแก้ไข
			// ส่วนค่าอื่นๆ เปลี่ยนไปตามฟิลด์หรือรูปแบบข้อมูลที่ต้องการ
			$json_data['data'][] = array(
        "pros_id" 			=> $row['PRO_ID'],
        "pros_selid" 		=> $row['SEL_ID'],
				"pros_name" 		=> $row['PRO_NAME'],
				"pros_buyprice" => $row['PRO_BUYPRICE'],
        "pros_sellprice" => $row['PRO_SELLPRICE'],
        "pros_amount" => $row['PRO_AMOUNT'],
				"pros_wamount"  => $row['PRO_WAMOUNT'],
				"pros_detail"  => $row['PRO_DETAIL'],
				"pros_status" 			=> $row['PRO_STATUS']
			);
		}
		// รายการต่อไปนี้ไม่ต้องเปลี่ยนค่า  ใช้สำหรับส่งค่าไปใช้ในการกำหนดหน้าข้อมูลที่แสดง
		if($result->num_rows > 0){
			$json_data['curpage'] = $cur_page;
			$json_data['perpage'] = $per_page;
			$json_data['total'] = 	$total;
			$json_data['allpage'] = ceil($total/$per_page);
		}
	}
	// ถ้ามีข้อมูล จะด้ตัวแปร $json_data  สำหรับสร้างเป็น json data
}
////////////////////////////// END GET LISTITEM //////////////////////////////////////



////////////////////////////// BEGIN GET TEM //////////////////////////////////////
//////// ส่วนของการดึงข้อมูลแต่ละรายการ อ้างอิงจาก ค่าที่ส่งมาเช็ค ปกติใช้ primary
if(isset($_POST['action']) && $_POST['action']=="item"){
	/// ในที่นี้เช็คจาก chk_user_id เปลี่ยนค่าและคำสั่ง sql ตามที่นำไปใช้งาน
	if(isset($_POST['chk_pro_id']) && $_POST['chk_pro_id']!=""){
		$sql = "SELECT * FROM PRODUCT WHERE PRO_ID='".$_POST['chk_pro_id']."'";
		$result = $mysqli->query($sql);
		if($result && $result->num_rows > 0){
				$row = $result->fetch_assoc();
				$json_data['data'][] = array(
          "pros_id" 			=> $row['PRO_ID'],
          "pros_selid" 		=> $row['SEL_ID'],
  				"pros_name" 		=> $row['PRO_NAME'],
  				"pros_buyprice" => $row['PRO_BUYPRICE'],
          "pros_sellprice" => $row['PRO_SELLPRICE'],
  				"pros_detail"  => $row['PRO_DETAIL'],
  				"pros_status" 			=> $row['PRO_STATUS']
				);
		}
	}
	// ค่าข้องข้อมูลส่วนนี้จะถูกดึงไป ใช้แสดงใน form เพื่อแก้ไขข้อมูล
	// ถ้ามีข้อมูล จะด้ตัวแปร $json_data  สำหรับสร้างเป็น json data
}
////////////////////////////// END GET TEM //////////////////////////////////////




////////////////////////////// BEGIN EDIT  //////////////////////////////////////
//////////////////////// ส่วนสำรหับส่ง่ค่ามาทำการแก้ไข หรืออัพเดทข้อมูล
if(isset($_POST['action']) && $_POST['action']=="edit"){
	$_error_msg = null;
	$_success_msg = null;
	// อัพเดทข้อมูลโดยอ้างอิงจาก primary ในที่นี้ส่ง userid
	if(isset($_POST['proid']) && $_POST['proid']!=""){
		$sql = "UPDATE PRODUCT SET
    PRO_ID  = '".$_POST['proid']."',
    SEL_ID  = '".$_POST['selid']."',
    PRO_NAME = '".$_POST['proname']."',
    PRO_BUYPRICE = '".$_POST['probuyprice']."',
    PRO_SELLPRICE = '".$_POST['prosellprice']."',
    PRO_DETAIL = '".$_POST['prodetail']."',
    PRO_STATUS = '".$POST['prostatus']."'
		";
		$result = $mysqli->query($sql);
		if($result){
			if($mysqli->affected_rows>0){
				$_success_msg = "Change user data successful!";
			}else{
				$_success_msg = "Update user successful!";
			}
		}else{
			$_error_msg = "อาจมีข้อผิดพลาด กรุณาทำการแก้ไขใหม่อีกครั้งค่ะ";
		}
	}
	$json_data[]=array(
		"success" => $_success_msg,
		"error" => $_error_msg
	);
	// จะได้ตัวแปร $json_data  สำหรับสร้างเป็น json data
}
////////////////////////////// END EDIT  //////////////////////////////////////



////////////////////////////// BEGIN ADD  ////////////////////////////////////////////////////
///////////////////////////////////////////// ส่วนของการเพิ่มข้อมูลใหม่  /////////////////////
if(isset($_POST['action']) && $_POST['action']=="add"){
	$_error_msg = null;
	$_success_msg = null;

	$sql = "INSERT INTO PRODUCT SET
  PRO_ID  = '".$_POST['proid']."',
  SEL_ID  = '".$_POST['selid']."',
  PRO_NAME = '".$_POST['proname']."',
  PRO_BUYPRICE = '".$_POST['probuyprice']."',
  PRO_SELLPRICE = '".$_POST['prosellprice']."',
  PRO_DETAIL = '".$_POST['prodetail']."',
  PRO_STATUS = '".$POST['prostatus']."'
	";
	$result = $mysqli->query($sql);
	if($result && $mysqli->affected_rows>0){
		$insert_userID = $mysqli->insert_id;
		$_success_msg = "ระบบเพิ่มอะไหล่ชิ้นใหม่เสร็จสิ้นเรียบร้อยแล้วค่ะ";
	}else{
		$_error_msg = "อาจมีข้อผิดพลาด กรุณาทำการเพิ่มใหม่อีกครั้งค่ะ";
	}
	$json_data[]=array(
		"success" => $_success_msg,
		"error" => $_error_msg
	);
	// จะได้ตัวแปร $json_data  สำหรับสร้างเป็น json data
}
////////////////////////////// END ADD  //////////////////////////////////////


// แปลงตัวแปร $json_data array เป็นรูปแบบ json string  data
if(isset($json_data)){
    $json= json_encode($json_data);
    if(isset($_GET['callback']) && $_GET['callback']!=""){
    echo $_GET['callback']."(".$json.");";
    }else{
    echo $json;
    }
}



?>
