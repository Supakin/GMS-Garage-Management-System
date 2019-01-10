
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
</head>
<body class="h-100 w-100 pr-3 ">
  <div class="row">
    <div class="col-3">
      <div class="container-fuild">
        <div class="bg-dark text-white p-3 m-1">
          <h3>dasboard</h3>
        </div>
      </div>
      <div class="container-fuild">
        <div class="bg-dark text-white p-3 m-1 h-25">
          <h3>อะไหล่ที่ถูกใช้ไป</h3><br><br>
        </div>
        <div class="bg-dark text-white p-3 m-1 h-25">
          <h3>อะไหล่ที่ถูกใช้ไป</h3><br><br>
        </div>
        <div class="bg-dark text-white p-3 m-1 h-25">
          <h3>อะไหล่ที่ถูกใช้ไป</h3><br><br>
        </div>
        <div class="bg-dark text-white p-3 m-1">
          <h3>อะไหล่ที่ถูกใช้ไป</h3><br><br>
        </div>
        <div class="bg-dark text-white p-3 m-1">
          <h3>อะไหล่ที่ถูกใช้ไป</h3><br><br>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="container-fuild">
        <div class="row  justify-content-center p-2">
          <div class="col-8">
            <table class ="table table-bordered">
              <tr class="bg-dark text-white">
                <th scope="row">
                  <center>
                      <h2>อู่พ่อบิว แง๊นแง๊น</h2>
                  </center>
                </th>
              </tr>
            </table>
          </div>
        </div>

        <div class="row justify-content-center mt-5 mb-5">
          <button type="button" class="btn btn-info  shadow  w-25  mr-4 ml-4 p-1" onClick = "window.location.replace('main_product.php')">
            <div class="row justify-content-center align-items-center">
              <div class="col p-1">
                <i class="	fas fa-cogs" style='font-size:80px;color:white'></i>
              </div>
              <div class="col">
                <h2>อะไหล่</h2>
              </div>
            </div>
          </button>
          <button type="button" class="btn btn-secondary  shadow  w-25 mr-4 ml-4 p-1" onClick = "window.location.replace('main_seller.php')">
            <div class="row justify-content-center align-items-center">
              <div class="col p-1">
                <i class="fas fa-hands-helping" style='font-size:80px;color:white'></i>
              </div>
              <div class="col">
                <h2>คู่ค้า</h2>
              </div>
            </div>
          </button>
          <button type="button" class="btn btn-primary  shadow  w-25  mr-4 ml-4 p-1" onClick = "window.location.replace('main_employee.php')">
            <div class="row justify-content-center align-items-center">
              <div class="col p-1">
                <i class="fas fa-user" style='font-size:80px;color:white'></i>
              </div>
              <div class="col">
                <h2>พนักงาน</h2>
              </div>
            </div>
          </button>
        </div>

        <div class="row  justify-content-center mt-5 mb-5">
          <button type="button" class="btn btn-warning text-white  shadow  w-25 mr-4 ml-4 p-1" onClick = "window.location.replace('main_service.php')">
            <div class="row justify-content-center align-items-center">
              <div class="col p-1">
                <i class="fas fa-wrench" style='font-size:80px;color:white'></i>
              </div>
              <div class="col">
                <h2>บริการซ่อม</h2>
              </div>
            </div>
          </button>
          <button type="button" class="btn btn-success  shadow  w-25 mr-4 ml-4 p-1" onClick = "window.location.replace('main_employee.php')">
            <div class="row justify-content-center align-items-center">
              <div class="col p-1">
                <i class="fas fa-user-alt" style='font-size:80px;color:white'></i>
              </div>
              <div class="col">
                <h2>ลูกค้า</h2>
              </div>
            </div>
          </button>
          <button type="button" class="btn btn-danger  shadow  w-25 mr-4 ml-4 p-1" onClick = "window.location.replace('main_buy.php')">
            <div class="row justify-content-center align-items-center">
              <div class="col p-1">
                <i class="fab fa-bitcoin" style='font-size:80px;color:white'></i>
              </div>
              <div class="col">
                <h2>ขายอะไหล่</h2>
              </div>
            </div>
          </button>
          </div>
        </div>
      </div>
    </div>


</body>
</html>
