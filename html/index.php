<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <title>Document</title>

  <link rel="stylesheet" href="../lib/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/index_style.css">

</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <a class="navbar-brand" href="#">Rose</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Dropdown
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Something else here</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
        </li>
      </ul>
      <form class="form-inline my-2 my-lg-0">
        <button class="btn btn-outline-secondary mr-2" data-toggle="modal" data-target="#registerModal">Đăng ký</button>
        <button class="btn btn-outline-primary mr-2" data-toggle="modal" data-target="#loginModal" onclick="navigation('login.php')">Đăng nhập</button>
        <input class="form-control mr-sm-2" type="search" placeholder="Nhập sản phẩm..." aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Tìm kiếm</button>
      </form>
    </div>
  </nav>


  <!-- Begin top slide -->
  <div id="topSlideIndicators" class="carousel slide container rounded" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#topSlideIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#topSlideIndicators" data-slide-to="1"></li>
        <li data-target="#topSlideIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
      
      <div class="carousel-item active">
          <img class="d-block w-100" src="../image/slide/anh1.jpg" alt="First slide">
          <div class="carousel-caption d-none d-md-block">
            
            <h5 class="text-white">My Caption Title (1st Image)</h5>
            
            <p>The whole caption will only show up if the screen is at least medium size.</p>
          </div>
      </div>
    
      <div class="carousel-item">
          <img class="d-block w-100" src="../image/slide/anh2.jpg" alt="Second slide">
      </div>
      <div class="carousel-item">
          <img class="d-block w-100" src="../image/slide/anh3.jpg" alt="Third slide">
      </div>
    </div>
    <a class="carousel-control-prev" href="#topSlideIndicators" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#topSlideIndicators" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
  <!-- End top slide here -->




  
  <!-- Begin footer -->
  <footer class="mt-5">
    <div>
      <!-- <h1>test</h1> -->
    </div>
  </footer>
  <!-- End footer here -->
</body>

<script src="../lib/bootstrap/js/jquery-3.4.1.min.js"></script>
<script src="../lib/bootstrap/js/popper.min.js"></script>
<script src="../lib/bootstrap/js/bootstrap.min.js"></script>
<script src="../js/index_script.js"></script>
</html>