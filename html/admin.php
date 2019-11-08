<?php
  include '../source/mysource.php';
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
  <link href="../vendor/fontawesome/css/all.min.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="../vendor/fontawesome/css/fontawesome.min.css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin-2.min.css" rel="stylesheet">
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
            <div class="card-body">
             
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <!-- <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2019</span>
          </div>
        </div>
      </footer> -->
      <!-- End of Footer -->

       
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

  <!-- Bootstrap core JavaScript-->
  <!-- <script src="../js/admin_script.js"></script> -->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="../vendor/chart.js/Chart.min.js"></script>
  
  <!-- Page level custom scripts -->
  <!-- <script src="../js/demo/chart-area-demo.js"></script>
  <script src="../js/demo/chart-pie-demo.js"></script> -->
  <!-- <script>
    $(document).ready(function(){
      alert("test");
    })
  </script> -->
  <!-- <script type="text/javascript" src="../js/admin_script.js"></script> -->
  <script src="../js/admin_script.js"></script>
  
</body>

</html>
