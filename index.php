<?php
  include "source/mysource.php";
  $p = new database();

  if(isset($_POST["add_to_cart"])){
    if(isset($_SESSION['shopping_cart'])){

    }
    else{
      $item_array = array(
        'item_id' => $_GET['id'],
        'item_name' => $_POST['tensp'],
        'item_price' => $_POST['gia']
      );
    }
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Rose</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="vendor/fontawesome/css/all.min.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="css/font.css">
  <link href="css/business-frontpage.css" rel="stylesheet">
  <style>
    .same-height {
      height: 300px;
      object-fit: cover;
    }
  </style>
</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand font-weight-bold" href="index.php">Rose</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
        aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto mr-auto">

          <li class="nav-item">
            <a class="nav-link text-white font-weight-bold mr-2" href="?filter=Son">Son</a>
          </li>

          <li class="nav-item">
            <a class="nav-link text-white font-weight-bold mr-2" href="?filter=Mặt nạ">Mặt nạ</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white font-weight-bold mr-2" href="?filter=Nước tẩy trang">Nước tẩy trang</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white font-weight-bold mr-2" href="#">
              <i class="fas fa-shopping-cart"></i>
              <span class="text-danger" id="countShoppingCart">
              <?php
                $count = count($_SESSION['shopping-cart']);
                if(isset($count)){
                  echo $count;
                }
                else{
                  echo '0';
                }
             ?></span>
            </a>
          </li>
        </ul>
        <div class="ml-auto">
        
          <?php            
            session_start();
            $isLogin = $_SESSION['isLogin'];
            if(isset($isLogin) !== TRUE){
              echo '<button class="btn btn-secondary mr-1" data-toggle="modal" data-target="#darkModalForm">Đăng ký</button>';
              echo '<button class="btn btn-success ml-auto" data-toggle="modal" data-target="#loginForm">Đăng nhập</button>';
            }
            else{
              $role = $_SESSION['role'];
              if($role === "admin"){
                echo '<a href="admin.php" class="btn btn-outline-secondary text-white mr-1">Quản lý</a>';
              }
              echo '<a href="logout.php" class="btn btn-outline-secondary text-white">Đăng xuất</a>';
            }
            
            
          ?>
          </div>
        <form method="get" class="form-inline ml-auto my-1">
          <div class="d-inline-flex">
            <input class="form-control" type="text" name="inputSearch" id="inputSearch" placeholder="Nhập sản phẩm...">
            <button class="btn text-white"><i class="fa fa-search"></i></button>
          
          </div>
        </form>
      </div>
    </div>
  </nav>

  <!-- Header -->
  <header class="masthead">
    <div class="container h-100">
      <div class="row h-100 align-items-center">
        <div class="col-12 text-center">
          <h1 class="font-weight-light">Vertically Centered Masthead Content</h1>
          <p class="lead">A great starter layout for a landing page</p>
        </div>
      </div>
    </div>
  </header>

  <!-- Page Content -->
  <div class="container">

    <div class="row">
      <?php
        $filter = $_GET['filter'];
        
        $listProducts = json_decode($p->loadProduct($filter), true);
        
        for ($index=0; $index < count($listProducts) ; $index++) { 
        
          $element = $listProducts[$index];
          echo '
            <div class="col-md-4 mb-5" id="'. $element['tensp'] .'">
              <div class="card h-100">
                <img class="card-img-top same-height" src="'. $element['path'] .'" alt="'. $element['tensp'] .'">
                <div class="card-body">
                  <h4 class="card-title text-primary" name="tensp">'. $element['tensp'] .'</h4>
                  <p class="card-text">'. $element['mota'] .'</p>
                  <h6 class="text-danger"><i class="fas fa-dollar-sign"></i>'. $element['gia'] .' VND</h6>
                </div>
                <div class="card-footer text-center">
                  <button class="btn btn-primary"><i class="fas fa-pen"></i> Xem thêm</button>
                  <button class="btn btn-danger" onclick="add_to_cart('.$element['tensp'].')"><i class="fa fa-plus"></i> Thêm vào giỏ</button>
                </div>
              </div>
            </div>
          ';
        }
      ?>
    </div>
    <!-- /.row -->

  </div>

  
  <footer class="py-5 bg-dark">
     <div class="container text-center text-md-left">

      <!-- Grid row -->
      <div class="row mt-3">

        <!-- Grid column -->
        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4 text-center">

          <!-- Content -->
          <h6 class="text-uppercase font-weight-bold text-white">Rose</h6>
          <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto text-white" style="width: 60px;">
          <p class="text-white">Chuyên cung cấp các sản phẩm ....</p>

        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4 text-center">

          <!-- Links -->
          <h6 class="text-uppercase font-weight-bold text-white">Sản phẩm</h6>
          <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
          <p>
            <a href="?filter=Son" class="font-weight-bold">Son</a>
          </p>
          <p>
            <a href="?filter=Mặt nạ" class="font-weight-bold">Mặt nạ</a>
          </p>
          <p>
            <a href="?filter=Nước tẩy trang" class="font-weight-bold">Nước tẩy trang</a>
          </p>

        </div>
        <!-- Grid column -->


        <!-- Grid column -->
        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">

          <!-- Links -->
          <h6 class="text-uppercase font-weight-bold text-white">Liên hệ</h6>
          <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
          <p class="text-white">
            <i class="fas fa-home"></i> 12 Nguyễn Văn Bảo, Quận Gò Vấp, Thành phố Hồ Chí Minh</p>
          <p class="text-white">
            <i class="fas fa-envelope"></i> tuongvi@gmail.com</p>
          <p class="text-white">
            <i class="fas fa-address-book"></i> 094....</p>
        </div>
        <!-- Grid column -->
      </div>
      <!-- Grid row -->
    </div>
  </footer>
  <!-- Footer -->


  <!-- Begin register Modal -->
  <div class="modal fade" id="darkModalForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog form-dark" role="document">
      <!--Content-->
      <div class="modal-content card card-image"
        style="background-image: linear-gradient(141deg, #9fb8ad 0%, #1fc8db 51%, #2cb5e8 75%);">
        <div class="text-white rgba-stylish-strong py-5 px-5 z-depth-4">
          <!--Header-->
          <div class="modal-header text-center pb-4">
            <h3 class="modal-title w-100 white-text font-weight-bold" id="myModalLabel"><strong>Đăng ký</strong> <a
                class="green-text font-weight-bold"><strong> </strong></a></h3>
            <button type="button" class="close white-text" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <!--Body-->
          <div class="modal-body">
            <!--Body-->
            <div class="md-form mb-3 text-center">
              <label data-error="wrong" data-success="right" for="Form-email5">Địa chỉ email</label>
              <input type="email" id="inputEmail" class="form-control validate white-text" placeholder="Nhập email">
            </div>

            <div class="md-form mb-3 text-center">
              <label data-error="wrong" data-success="right" for="Form-email5">Họ</label>
              <input type="email" id="inputHo" class="form-control validate white-text" placeholder="Nhập họ">
            </div>

            <div class="md-form mb-3 text-center">
              <label data-error="wrong" data-success="right" for="Form-email5">Tên</label>
              <input type="email" id="inputTen" class="form-control validate white-text" placeholder="Nhập tên">
            </div>

            <div class="md-form mb-3 text-center">
              <label data-error="wrong" data-success="right" for="Form-email5">Địa chỉ</label>
              <input type="text" id="inputAddress" class="form-control validate white-text" placeholder="Nhập địa chỉ">
            </div>


            <div class="md-form pb-3 text-center">
              <label data-error="wrong" data-success="right" for="Form-pass5">Password</label>
              <input type="password" id="inputPassword" class="form-control validate white-text" placeholder="Nhập password">
              <!-- <div class="form-group mt-4 text-center">
                <input class="form-check-input" type="checkbox" id="checkbox624">
                <label for="checkbox624" class="white-text form-check-label">Đồng ý<a href="#"
                    class="green-text font-weight-bold">
                    điều khoản của chúng tôi.</a></label>
              </div> -->
            </div>


            <!--Grid row-->
            <div class="row d-flex align-items-center mb-4 mt-2">

              <!--Grid column-->
              <div class="text-center mb-3 col-md-12 mt-2">
                <button type="submit" class="btn btn-success btn-block btn-rounded z-depth-1" name="button" id="button" onclick="registerUser()">Đăng ký</button>
              </div>
              <!--Grid column-->

            </div>
            <!--Grid row-->

            <!--Grid row-->
            <div class="row">

              <!--Grid column-->
              <div class="col-md-12">
                <p class="font-small white-text d-flex justify-content-end">Đã có tài khoản? <a href="#"
                    class="green-text ml-1 font-weight-bold" onclick="showLogin();">
                    Đăng nhập</a></p>
              </div>
              <!--Grid column-->

            </div>
            <!--Grid row-->

          </div>
        </div>
      </div>
      <!--/.Content-->
    </div>
  </div>
  <!-- End register modal Here -->


  <!-- Begin login modal -->
  <div class="modal fade" id="loginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog form-dark" role="document">
      <!--Content-->
      <div class="modal-content card card-image"
        style="background-image: linear-gradient(141deg, #9fb8ad 0%, #1fc8db 51%, #2cb5e8 75%);">
        <div class="text-white rgba-stylish-strong py-5 px-5 z-depth-4">
          <!--Header-->
          <div class="modal-header text-center pb-4">
            <h3 class="modal-title w-100 white-text font-weight-bold" id="myModalLabel"><strong>Đăng nhập</strong> <a
                class="green-text font-weight-bold"><strong> </strong></a></h3>
            <button type="button" class="close white-text" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <!--Body-->
          <div class="modal-body">
            <!--Body-->
            <form method="post">

              <div class="md-form mb-5 text-center">
                <label data-error="wrong" data-success="right" for="Form-email5">Địa chỉ email</label>
                <input type="email" id="inputEmail" name="inputEmail" class="form-control validate white-text">
              </div>



              <div class="md-form pb-3 text-center">
                <label data-error="wrong" data-success="right" for="Form-pass5">Password</label>
                <input type="password" id="inputPassword" name="inputPassword" class="form-control validate white-text">
              </div>

              <hr>

              <!--Grid row-->
              <div class="row d-flex align-items-center mb-4">

                <!--Grid column-->
                <div class="text-center mb-3 col-md-12">
                  <button type="submit" name="button" id="button" value="Đăng nhập" class="btn btn-success btn-block btn-rounded z-depth-1">Đăng nhập</button>
                </div>
                <!--Grid column-->

              </div>
              <!--Grid row-->

              <!--Grid row-->
              <div class="row">

                <!--Grid column-->
                <div class="col-md-12">
                  <p class="font-small white-text d-flex justify-content-end">Chưa có tài khoản<a href="#"
                      class="green-text ml-1 font-weight-bold" onclick="showLogin();">
                      Đăng ký</a></p>
                </div>
                <!--Grid column-->

              </div>
              <!--Grid row-->
            </form>
          </div>
        </div>
      </div>
      <!--/.Content-->
    </div>
  </div>
  <!-- End login modal here -->

  <?php

    if(isset($_POST['button'])){
      switch ($_POST['button']) {
        case "Đăng nhập":{
          $username = $_POST['inputEmail'];
          $password = $_POST['inputPassword'];
          $p->login($username, $password);
          break;
        }
        case "Đăng xuất":{
          $p->logout();
          break;
        }
      }
    }
    
  ?>


  <!-- Bootstrap core JavaScript -->
  <script src="https://use.fontawesome.com/75139a0ae0.js"></script>
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="js/business-script.js"></script>
  
</body>

</html>