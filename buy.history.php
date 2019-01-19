<?php
require_once('GMSdb/connect.inc.php');
connect();
?>
<!DOCTYPE html>
<html>
<head>
<!-- Always force latest IE rendering engine -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1">
<title> gms.garage-management-systems.com</title>
<!--CSS-bootstrap4-->
<link rel ="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<!--CSS-myCSS-->
<link rel ="stylesheet" href="myCSS.css">

<!--JS-bootstrap4-->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<!--JS-myJS-->
<script type="text/javascript" src="myJS.js"></script>

<!--icon-->
<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.5.0/css/all.css' integrity='sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU' crossorigin='anonymous'>

<!--font-Thai-->
<link href="https://fonts.googleapis.com/css?family=Athiti" rel="stylesheet">

<style media="screen">
html {overflow-y: scroll;}

.tabs {
    list-style: none;
    margin: 0;
    padding: 0;
}

.tabs li {
    display: inline-block;
    padding: 15px 25px;
    background: none;
    text-transform: uppercase;
    cursor: pointer;
}

.tabs li.current {
    background: #e9e9e9;
}

.tab-contents {
    background: #e9e9e9;
    padding: 20px;
}

.tab-pane {
    display: none;
}

.tab-pane.current {
    display: block;
}
</style>
</head>

<body>
<div class="container">
  <div class="row justify-content-center align-content-center">
    <button type="button" class="btn btn-info btn-block mt-2 shadow-sm" onClick = "window.location.replace('main_buy.php')">
      <i class='fab fa-bitcoin' style='font-size:10px;color:white'></i>
      กลับก่อนหน้า
    </button>
  </div>
  <div class="row mt-3 mb-3 align-items-center">
    <div class="col-1">
        <i class="fab fa-bitcoin" style='font-size:65px;color:black'></i>
    </div>
    <div class="col-11">
      <h1>ประวัติการขาย</h1>
    </div>
  </div>
  <div class="tab-example">
    <ul class="tabs" >
      <li class="tab-link current active" data-tab="menu1">ประวัติการขาย</li>
      <li class="tab-link" data-tab="menu2">กำลังดำเนินการเคลม</li>
      <li class="tab-link" data-tab="menu3">ประวัติการเคลม</li>
      <li class="tab-link" data-tab="menu4">ประวัติการรับของลูกค้า</li>
    </ul>

    <div class="tab-contents">
      <!--buyed-->
      <div id="menu1" class="tab-pane current"><br>
        <div id="accordion1">
        <?php
          $sql = "SELECT * FROM BUYSLIP ORDER BY BUY_ID ";
          $sql_query = mysql_query($sql);
          while($row = mysql_fetch_array($sql_query)){
        ?>
          <div class="card">
            <div class="card-header bg-transparent">
              <div class="row">
                <div class="col-9">
                  <a class="card-link" data-toggle="collapse" href="#<?php echo "show".$row['BUY_ID']."buyslip";?>">
                    <?php echo "<b>เลขที่ใบเสร็จ : ".$row['BUY_ID']."</b>";?>
                  </a>
                </div>
                <div class="col-3">
                  <?php echo "วันที่ : <b>".$row['BUY_DATE']."</b>" ?>
                </div>
              </div>
            </div>

            <div id="<?php echo "show".$row['BUY_ID']."buyslip"; ?>" class="collapse" data-parent="#accordion1">
              <div class="card-body">
                <div class="row mr-2 ml-2">
                  <h5>รายการอะไหล่</h5>
                </div>
                  <table class="table table-hover table-bordered table-sm" id="myTable">
                    <thead class="thead-dark">
                      <tr align="center">
                        <th width="10%">รายการ</th>
                        <th>รหัส</th>
                        <th>อะไหล่</th>
                        <th>ราคา/หน่วย</th>
                        <th width="20%">จำนวน</th>
                        <th>ราคารวม</th>
                      </tr>
                    </thead>
                    <?php
                      $i=1;
                      $sql2 = "SELECT * FROM (BUYSLIP NATURAL JOIN BUYSLIP_DETAIL) NATURAL JOIN PRODUCT WHERE BUY_ID = '".$row['BUY_ID']."' ORDER BY BUYD_NUMBER ";
                      $sql2_query = mysql_query($sql2);
                      while($row2 = mysql_fetch_array($sql2_query)){
                    ?>
                      <tr>
                        <td align="center"><?php echo $i ?></td>
                        <td align="center"><?php echo $row2['PRO_ID'] ?></td>
                        <td><?php echo $row2['PRO_NAME'] ?></td>
                        <td align="right"><?php echo $row2['PRO_BUYPRICE'] ?></td>
                        <td align="center"><?php echo $row2['BUYD_AMOUNT'] ?></td>
                        <td align="right"><?php echo $row2['BUYD_TOTALPRICE'] ?></td>
                      </tr>
                    <?php
                      $i++;
                    }
                    ?>
                </table>
                <div class="row mt-2  justify-content-end">
                  <div class="col-5">
                    <div class="row">
                      <div class="col-4">
                        <small>ราคารวมทั้งหมด</small>
                      </div>
                      <div class="col-3 text-right">
                        <h3><b class="text-primary"><?php echo $row['BUY_TOTALPRICE'] ?></b></h3>
                      </div>
                      <div class="col-4">
                        <small>บาท</small>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php
            }
          ?>
        </div>
      </div>

      <!--claiming-->
      <div id="menu2" class="tab-pane"><br>
        <div id="accordion2">
        <?php
          $sql = "SELECT * FROM (CLAIMSLIP_BUY NATURAL JOIN BUYSLIP)  WHERE CLB_STATUS = 'N' ORDER BY CLB_ID ";
          $sql_query = mysql_query($sql);
          while($row = mysql_fetch_array($sql_query)){
        ?>
          <div class="card">
            <div class="card-header bg-transparent">
              <div class="row">
                <div class="col-4">
                  <a class="card-link" data-toggle="collapse" href="#<?php echo "show".$row['CLB_ID']."claimingbuy";?>">
                    <center><?php echo "<b>รหัสการเคลม : ".$row['CLB_ID']."</b>";?></center>
                  </a>
                </div>
                <div class="col-6">
                </div>
                <div class="col-2">
                  <?php
                  if ($row["CLB_STATUS"]=='Y'){
                    echo "<span class='badge badge-success '>";
                    echo "เรียบร้อย";
                    echo "</span>";
                  }else if ($row["CLB_STATUS"]=='N'){
                    echo "<span class='badge badge-danger'>";
                    echo "ยังไม่เรียบร้อย";
                    echo "</span>";
                  }
                  ?>
                </div>
              </div>
            </div>

            <div id="<?php echo "show".$row['CLB_ID']."claimingbuy"; ?>" class="collapse" data-parent="#accordion2">
              <div class="card-body">
                <!--line 1-->
                <div class="row justify-content-start">
                  <div class="col-2 ">
                    เลขที่ใบเสร็จ
                  </div>
                  <div class="col-5">
                    <b><?php echo $row['BUY_ID']; ?></b>
                  </div>
                </div>

                <!--line 2-->
                <div class="row justify-content-start">
                  <div class="col-2 ">
                    วันที่ซื้อ
                  </div>
                  <div class="col-5">
                    <b><?php echo $row['BUY_DATE'] ?></b>
                  </div>
                </div>

                <!--line 3-->
                <div class="row justify-content-start">
                  <div class="col-2 ">
                    วันที่เคลม
                  </div>
                  <div class="col-2">
                    <b><?php echo $row['CLB_DATE']; ?></b>
                  </div>
                </div>

                <!--line 4-->
                <div class="row justify-content-start">
                  <div class="col-2 ">
                    กำหนดวันได้รับ
                  </div>
                  <div class="col-2">
                    <b><?php echo $row['CLB_GETDATE']; ?></b>
                  </div>
                  <div class="col-1">
                  </div>
                  <div class="col-2">
                    <b>สถานะการรับ</b>
                  </div>
                  <div class="col-1">
                    <?php
                    $check_get_sql = "SELECT COUNT(GPCB_ID) AS CHECKGET,GPCB_DATE  FROM GET_PRODUCT_CLAIM_BUY WHERE CLB_ID = '".$row['CLB_ID']."' AND GPCB_STATUS = 'Y'";
                    $check_get_query = mysql_query($check_get_sql);
                    $check_get = mysql_fetch_array($check_get_query) or die(mysql_error());
                    if ($check_get['CHECKGET']>0){
                      echo "<span class='badge badge-success'>";
                      echo "ครบแล้ว";
                      echo "</span>";
                    }else{
                      echo "<span class='badge badge-danger'>";
                      echo "ยังไม่ครบ";
                      echo "</span>";
                    }
                    ?>
                  </div>
                  <?php
                    if($check_get['CHECKGET']>0){
                      echo "<div class='col-2'><b>วันที่รับครบ</b></div>";
                      echo "<div class='col-2'>".$check_get['GPCB_DATE']."</div>";
                    }
                  ?>
                </div>
                <div class="row">
                  <br>
                </div>
                <table class="table table-bordered">
                  <thead>
                    <tr align="center">
                      <th>ลำดับ</th>
                      <th>รหัสอะไหล่</th>
                      <th>ชื่อ</th>
                      <th>จำนวนที่เคลม</th>
                      <th>สถานะการรับ</th>
                    </tr>
                  </thead>
                  <?php
                    $clb_id = $row['CLB_ID'];
                    $sqlt = "SELECT * FROM (CLAIMSLIP_BUY NATURAL JOIN CLAIM_BUY_DETAIL) NATURAL JOIN PRODUCT WHERE CLB_ID = $clb_id ORDER BY CLB_ID,CLBD_NUMBER";
                    $sqlt_query =mysql_query($sqlt);
                    $i=1;
                    while($row2 = mysql_fetch_array($sqlt_query)){
                  ?>
                      <tr>
                        <td align="center" width='5%'><?php echo $i ?></td>
                        <td align="center" width='10%'><?php echo $row2['PRO_ID'] ?></td>
                        <td><?php echo $row2['PRO_NAME'] ?></td>
                        <td align="center" width='20%'><?php echo $row2['CLBD_AMOUNT'] ?></td>
                        <td align="center" width='15%'>
                          <?php
                            if($row2['CLBD_STATUS']=='Y') {
                              echo "<span class='badge badge-success'>";
                              echo "ครบแล้ว";
                              echo "</span>";
                            }else{
                              echo "<span class='badge badge-danger'>";
                              echo "ยังไม่ครบ";
                              echo "</span>";
                            }
                          ?>
                        </td>
                      </tr>
                  <?php
                  $i++;
                    }
                  ?>
                </table>
              </div>
            </div>
          </div>
            <?php
            }
            ?>
        </div>
      </div>

      <div id="menu3" class="tab-pane"><br>
        <div id="accordion3">
        <?php
          $sql = "SELECT * FROM (CLAIMSLIP_BUY NATURAL JOIN BUYSLIP)  WHERE CLB_STATUS = 'Y' ORDER BY CLB_ID ";
          $sql_query = mysql_query($sql);
          while($row = mysql_fetch_array($sql_query)){
        ?>
          <div class="card">
            <div class="card-header bg-transparent">
              <div class="row">
                <div class="col-4">
                  <a class="card-link" data-toggle="collapse" href="#<?php echo "show".$row['CLB_ID']."claimed";?>">
                    <center><?php echo "<b>รหัสการเคลม : ".$row['CLB_ID']."</b>";?></center>
                  </a>
                </div>
                <div class="col-6">
                </div>
                <div class="col-2">
                  <?php
                  if ($row["CLB_STATUS"]=='Y'){
                    echo "<span class='badge badge-success '>";
                    echo "เรียบร้อย";
                    echo "</span>";
                  }else if ($row["CLB_STATUS"]=='N'){
                    echo "<span class='badge badge-danger'>";
                    echo "ยังไม่เรียบร้อย";
                    echo "</span>";
                  }
                  ?>
                </div>
              </div>
            </div>

            <div id="<?php echo "show".$row['CLB_ID']."claimed"; ?>" class="collapse" data-parent="#accordion3">
              <div class="card-body">
                <!--line 1-->
                <div class="row justify-content-start">
                  <div class="col-2 ">
                    เลขที่ใบเสร็จ
                  </div>
                  <div class="col-5">
                    <b><?php echo $row['BUY_ID']; ?></b>
                  </div>
                </div>

                <!--line 2-->
                <div class="row justify-content-start">
                  <div class="col-2 ">
                    วันที่เคลม
                  </div>
                  <div class="col-2">
                    <b><?php echo $row['CLB_DATE']; ?></b>
                  </div>
                </div>

                <!--line 3-->
                <div class="row justify-content-start">
                  <div class="col-2 ">
                    กำหนดวันได้รับ
                  </div>
                  <div class="col-2">
                    <b><?php echo $row['CLB_GETDATE']; ?></b>
                  </div>
                  <div class="col-1">
                  </div>
                  <div class="col-2">
                    <b>สถานะการรับ</b>
                  </div>
                  <div class="col-1">
                    <?php
                    $check_get_sql = "SELECT COUNT(GPCB_ID) AS CHECKGET,GPCB_DATE  FROM GET_PRODUCT_CLAIM_BUY WHERE CLB_ID = '".$row['CLB_ID']."' AND GPCB_STATUS = 'Y'";
                    $check_get_query = mysql_query($check_get_sql);
                    $check_get = mysql_fetch_array($check_get_query) or die(mysql_error());
                    if ($check_get['CHECKGET']>0){
                      echo "<span class='badge badge-success'>";
                      echo "ครบแล้ว";
                      echo "</span>";
                    }else{
                      echo "<span class='badge badge-danger'>";
                      echo "ยังไม่ครบ";
                      echo "</span>";
                    }
                    ?>
                  </div>
                  <?php
                    if($check_get['CHECKGET']>0){
                      echo "<div class='col-2'><b>วันที่รับครบ</b></div>";
                      echo "<div class='col-2'>".$check_get['GPCB_DATE']."</div>";
                    }
                  ?>
                </div>
                <div class="row">
                  <br>
                </div>
                <table class="table table-bordered">
                  <thead>
                    <tr align="center">
                      <th>ลำดับ</th>
                      <th>รหัสอะไหล่</th>
                      <th>ชื่อ</th>
                      <th>จำนวนที่เคลม</th>
                      <th>สถานะการรับ</th>
                    </tr>
                  </thead>
                  <?php
                    $clo_id = $row['CLO_ID'];
                    $sqlt = "SELECT * FROM (CLAIMSLIP_BUY NATURAL JOIN CLAIM_BUY_DETAIL) NATURAL JOIN PRODUCT WHERE CLB_ID = $clb_id ORDER BY CLB_ID,CLBD_NUMBER";
                    $sqlt_query =mysql_query($sqlt);
                    $i=1;
                    while($row2 = mysql_fetch_array($sqlt_query)){
                  ?>
                      <tr>
                        <td align="center" width='5%'><?php echo $i ?></td>
                        <td align="center" width='10%'><?php echo $row2['PRO_ID'] ?></td>
                        <td><?php echo $row2['PRO_NAME'] ?></td>
                        <td align="center" width='20%'><?php echo $row2['CLBD_AMOUNT'] ?></td>
                        <td align="center" width='15%'>
                          <?php
                            if($row2['CLBD_STATUS']=='Y') {
                              echo "<span class='badge badge-success'>";
                              echo "ครบแล้ว";
                              echo "</span>";
                            }else{
                              echo "<span class='badge badge-danger'>";
                              echo "ยังไม่ครบ";
                              echo "</span>";
                            }
                          ?>
                        </td>
                      </tr>
                  <?php
                  $i++;
                    }
                  ?>
                </table>
              </div>
            </div>
          </div>

        <?php
          }
        ?>

        </div>
      </div>


      <div id="menu4" class="tab-pane"><br>
            <div id="accordion4">
            <?php
              $sql = "SELECT * FROM ((GET_PRODUCT_CLAIM_BUY NATURAL JOIN CLAIMSLIP_BUY) NATURAL JOIN BUYSLIP) ORDER BY GPCB_ID ";
              $sql_query = mysql_query($sql);
              while($row = mysql_fetch_array($sql_query)){
            ?>
              <div class="card">
                <div class="card-header bg-transparent">
                  <div class="row">
                    <div class="col-4">
                      <a class="card-link" data-toggle="collapse" href="#<?php echo "show".$row['GPCB_ID']."getclaimbuy";?>">
                        <center><?php echo "<b>รหัสการรับเคลม : ".$row['GPCB_ID']."</b>";?></center>
                      </a>
                    </div>
                    <div class="col-8">
                    </div>
                  </div>
                </div>

                <div id="<?php echo "show".$row['GPCB_ID']."getclaimbuy"; ?>" class="collapse" data-parent="#accordion4">
                  <div class="card-body">
                    <!--line 1-->
                    <div class="row justify-content-start">
                      <div class="col-2 ">
                        รหัสการเคลม
                      </div>
                      <div class="col-5">
                        <b><?php echo $row['CLB_ID']; ?></b>
                      </div>
                    </div>

                    <!--line 2-->
                    <div class="row justify-content-start">
                      <div class="col-2 ">
                        เลขที่ใบเสร็จ
                      </div>
                      <div class="col-5">
                        <b><?php echo $row['BUY_ID']; ?></b>
                      </div>
                    </div>

                    <!--line 3-->
                    <div class="row justify-content-start">
                      <div class="col-2 ">
                        วันกำหนดได้รับ
                      </div>
                      <div class="col-2">
                        <b><?php echo $row['CLB_GETDATE']; ?></b>
                      </div>
                    </div>

                    <!--line 4-->
                    <div class="row justify-content-start">
                      <div class="col-2 ">
                        วันที่รับ
                      </div>
                      <div class="col-2">
                        <b><?php echo $row['GPCB_DATE']; ?></b>
                      </div>
                    </div>

                    <div class="row">
                      <br>
                    </div>
                    <table class="table table-bordered">
                      <thead>
                        <tr align="center">
                          <th>ลำดับ</th>
                          <th>รหัสอะไหล่</th>
                          <th>ชื่อ</th>
                          <th>จำนวนที่รับ</th>
                        </tr>
                      </thead>
                      <?php
                        $gpcb_id = $row['GPCB_ID'];
                        $sqlt = "SELECT * FROM (GET_PRODUCT_CLAIM_BUY NATURAL JOIN GET_PRODUCT_CLAIM_BUY_DETAIL) NATURAL JOIN PRODUCT WHERE GPCB_ID = $gpcb_id ORDER BY GPCB_ID,GPCBD_NUMBER";
                        $sqlt_query =mysql_query($sqlt);
                        $i=1;
                        while($row2 = mysql_fetch_array($sqlt_query)){
                      ?>
                          <tr>
                            <td align="center" width='5%'><?php echo $i ?></td>
                            <td align="center" width='10%'><?php echo $row2['PRO_ID'] ?></td>
                            <td><?php echo $row2['PRO_NAME'] ?></td>
                            <td align="center" width='20%'><?php echo $row2['GPCBD_GETAMOUNT'] ?></td>
                          </tr>
                      <?php
                      $i++;
                        }
                      ?>
                    </table>
                  </div>
                </div>
              </div>

            <?php
              }
            ?>

          </div>
      </div>

    </div>
  </div>

</div>


<script>
$(function() {
    $('.tabs li').on('click', function() {
        var tabId = $(this).attr('data-tab');

        $('.tabs li').removeClass('current');
        $('.tab-pane').removeClass('current');

        $(this).addClass('current');
        $('#' + tabId).addClass('current');
    });
});

</script>

</body>
</html>
<?php
  disconnect();
?>
