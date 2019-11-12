<?php
  include 'source/mysource.php';
  $p = new database();
  session_start();
  $p->checkAdmin();
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Website ban hang">
  <meta name="author" content="tuongvi">

  <title>Rose Admin</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome/css/all.min.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="css/font.css">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <style>
    .same-height {
      height: 300px;
      object-fit: cover;
    }
  </style>
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon">
          <i class="fas fa-home"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Trang chủ</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Divider -->
      <hr class="sidebar-divider">
      
      <li class="nav-item m-3 text-center">
        <a class="btn bg-white rounded w-100" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
      </li>

      <!-- Heading -->
      <div class="sidebar-heading">
        Tính năng
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSetting" aria-expanded="true" aria-controls="collapseSetting">
          <i class="fas fa-fw fa-cog"></i>
          <span>Cài đặt chung</span>
        </a>
        <div id="collapseSetting" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Tùy chỉnh:</h6>
            <a class="collapse-item" href="buttons.html">Phân trang</a>
            <a class="collapse-item" href="buttons.html">Liên hệ</a>

          </div>
        </div>
      </li>
      
      <!-- Divider -->
      <hr class="sidebar-divider">
      
      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUser" aria-expanded="true" aria-controls="collapseUser">
          <i class="far fa-user"></i>
          <span>Thành viên</span>
        </a>
        <div id="collapseUser" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded text-center">
            <a class="collapse-item font-weight-bold" onclick="loadUser();">Danh sách</a>
            <a class="collapse-item font-weight-bold" onclick="showFormAddUser();">Thêm thành viên</a>
          </div>
        </div>
      </li>
      
      <!-- Divider -->
      <hr class="sidebar-divider">
      
      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProduct" aria-expanded="true" aria-controls="collapseProduct">
          <i class="fab fa-product-hunt"></i>
          <span>Sản phẩm</span>
        </a>
        <div id="collapseProduct" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded text-center">
            <a class="collapse-item font-weight-bold" onclick="loadProducts();">Danh sách</a>
            <a class="collapse-item font-weight-bold" onclick="showFormAddProduct();">Thêm sản phẩm</a>
          </div>
        </div>
      </li>
      
      <!-- Divider -->
      <hr class="sidebar-divider">
    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <div class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow text-center">
          <h1><i>Trang quản lí Rose</i></h1>
        </div>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid" id="showData">
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3" id="tagTable">
              <h6 class="m-0 font-weight-bold text-primary">Danh sách thành viên</h6>
            </div>
            <!-- begin card body  -->
            <div class="card-body">
              <div>
                <div class="row mb-2">
                  <label class="col-md-3" for="inputTensp">Tên sản phẩm:</label>
                  <input class="form-control col-md-6" type="text" name="inputTensp" id="inputTensp" placeholder="Tên sản phẩm">
                </div>
              </div>

              <div>
                <div class="row mb-2">
                  <label class="col-md-3" for="inputTensp">Giá:</label>
                  <input class="form-control col-md-6" type="text" name="inputTensp" id="inputTensp" placeholder="Giá sản phẩm">
                </div>
              </div>

              <div>
                <div class="row mb-2">
                  <label class="col-md-3" for="inputTensp">Mô tả:</label>
                  <textarea class="form-control col-md-6" name="inputMota" id="inputMota" cols="30" rows="8" placeholder="Mô tả sản phẩm"></textarea>
                </div>
              </div>

              <div>
                <div class="row mb-2">
                  <label class="col-md-3" for="inputTensp">Loại sản phẩm:</label>
                  <select class="form-control col-md-6" name="inputProductsType" id="inputProductsType">
                    <option value="aaa">111</option>
                  </select>
                </div>
              </div>
              
              <div>
                <div class="row mb-2">
                  <label class="col-md-3" for="inputNcc">Nhà cung cấp:</label>
                  <select class="form-control col-md-6" name="inputNcc" id="inputNcc">
                    <option value="aaa">111</option>
                  </select>
                </div>
              </div>

              <div>
                <div class="row mb-2">
                  <label class="col-md-3" for="inputTensp">Số lượng:</label>
                  <input class="form-control col-md-6" type="text" name="inputTensp" id="inputTensp" placeholder="Số lượng">
                </div>
              </div>

              <div>
                <div class="row mb-2">
                  <p class="col-md-3">Hình ảnh: </p>
                  <div class="custom-file col-md-6">
                    <input type="file" class="custom-file-input" id="inputImages">
                    <label class="custom-file-label" for="inputImages">Chọn hình ảnh</label>
                  </div>
                </div>
              </div>

            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

        <div id="showImages" class="row ml-3 mb-3">
        
        </div>


      </div>
      <!-- End of Main Content -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Begin modal edit user -->
  <div class="modal" id="editUserForm">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title text-black">Chỉnh sửa thông tin</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="row mb-2">
            <label class="col-md-3" for="inputHo">Họ và tên lót:</label>
            <input class="form-control col-md-8" type="text" name="inputHo" id="inputHo" placeholder="Họ và tên lót"> 
            <span class="text-danger font-italic ml-4" id="noficationInputHo"></span>
          </div>
          
          <div class="row mb-2">
            <label class="col-md-3" for="inputTen">Tên:</label>
            <input class="form-control col-md-8" type="text" name="inputTen" id="inputTen"  placeholder="Tên">
            <span class="text-danger font-italic ml-4" id="noficationInputTen"></span>
          </div>
          <div class="row mb-2">
            <label class="col-md-3" for="inputEmail">Email:</label>
            <input class="form-control col-md-8" type="email" name="inputEmail" id="inputEmail"  placeholder="Email">
            <span class="text-danger font-italic ml-4" id="noficationInputEmail"></span>
          </div>
          <div class="row mb-2">
            <label class="col-md-3" for="inputPassword">Password:</label>
            <input class="form-control col-md-8" type="password" name="inputPassword" id="inputPassword"  placeholder="Password">
            <span class="text-danger font-italic ml-4" id="noficationInputPassword"></span>
          </div>
          <div class="row mb-2">
            <label class="col-md-3" for="inputDiachi">Địa chỉ:</label>
            <input class="form-control col-md-8" type="text" name="inputDiachi" id="inputDiachi"  placeholder="Địa chỉ">
            <span class="text-danger font-italic ml-4" id="noficationInputDiaChi"></span>
          </div>
          <div class="row mb-2">
            <label class="col-md-3" for="inputRole">Phân quyền:</label> 
            <select class="form-control col-md-5 text-center" name="inputRole" id="inputRole">
            <span class="text-danger font-italic ml-4" id="noficationInputHo"></span>
              <option value="user">Thành viên</option>
              <option value="admin">Quản trị viên</option>
            </select>
          </div>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer mx-auto">
          <button class="btn btn-success mr-2" id="buttonSave">Lưu</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Thoát</button>
        </div>

      </div>
    </div>
  </div>

  <!-- End modal edit user here -->

 

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>
  
  <script src="js/admin_script.js"></script>
  
</body>

</html>
