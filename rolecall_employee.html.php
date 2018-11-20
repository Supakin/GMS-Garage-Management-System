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

<!--font-Thai-->
<link href="https://fonts.googleapis.com/css?family=Athiti" rel="stylesheet">
</head>

<body id="main">
  <div class= "container">
    <div class="row justify-content-center">
      <div class="col-11">
        <h3>ลงเวลาเข้า-เวลาออก</h3>
      </div>
      <div class="col-1 justify-content-end">
          <button type="button" class="btn default" onclick='location.replace("main_employee.php")'>ปิด</button>
      </div>
    </div>
    <div class="row">
      <br>
    </div>
    <div class="row justify-content-center">
      <div class="col-12">
        <table class="table table-hover">
          <div id="accordion">
            <div class="card">
              <div class="card-header">
                <a class="card-link" data-toggle="collapse" href="#checkin">
                  ลงเวลาเข้า
                </a>
              </div>

              <div id="checkin" class="collapse" data-parent="#accordion">
                <div class="card-body">
                  <div class="row form-group">
                    <form method="post" action="checkin.rc.php">
                    <div class="input-group mb-3">
                      <input type="text" name="emp_id" class="form-control" placeholder="รหัสพนักงาน">
                      <div class="input-group-append"><button class="btn btn-success" type="submit">ลงเวลาเข้า</button> </div>
                    </div>
                  </form>
                  </div>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header">
                <a class="card-link" data-toggle="collapse" href="#checkout">
                  ลงเวลาออก
                </a>
              </div>
              <div id="checkout" class="collapse" data-parent="#accordion">
                <div class="card-body">
                  <div class="row form-group">
                    <div class="input-group mb-3">
                      <input type="text" class="form-control" placeholder="รหัสพนักงาน">
                      <div class="input-group-append"><button class="btn btn-success" type="submit">ลงเวลาออก</button> </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </table>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-6">
        <h5>เวลาเข้า</h5>
        <table class="table table-hover">
          <thead>
            <tr>
              <th>วัน</th>
              <th>เวลา</th>
              <th>รหัสพนักงาน</th>
              <th>ชื่อพนักงาน</th>
            </tr>
          </thead>
          <?php
            include('showCHECKINtable.php');
           ?>
        </table>
      </div>
      <div class="col-6">
        <h5>เวลาออก</h5>
        <table class="table table-hover">
          <thead>
            <tr>
              <th>วัน</th>
              <th>เวลา</th>
              <th>รหัสพนักงาน</th>
              <th>ชื่อพนักงาน</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>

  <!---------------------------------------------------------------------------->


</body>
</html>
