<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <title>Document</title>

  <link rel="stylesheet" href="../lib/bootstrap/css/bootstrap.min.css">


</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
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
      <button class="btn btn-outline-secondary mr-2">Sign up</button>
      <button class="btn btn-outline-primary mr-2" data-toggle="modal" data-target="#loginModal">Sign in</button>
      <input class="form-control mr-sm-2" type="search" placeholder="Nhập sản phẩm..." aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Tìm kiếm</button>
    </form>
  </div>
</nav>



<!-- Begin login modal -->

<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="loginModalLabel">Đăng nhập</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="post" class="row justify-content-center">
          <div class="form-group row">
            <label class="col-md-4 px-auto" for="txtusername">Username: </label>
            <input class="form-control col-md-7" type="text" name="txtusername" id="txtusername" placeholder="Username">
          </div>
          
          <div class="form-group row">
            <label class="col-md-4 px-auto" for="txtpwd">Password</label>
            <input class="form-control col-md-7" type="password" name="txtpwd" id="txtpwd" placeholder="Password">
          </div>
          
        </form>
      </div>
      <div class="modal-footer">
        <div class="btn-group text-center mx-auto">
          <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Thoát</button>
          <button type="button" class="btn btn-success">Đăng nhập</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- End login modal here -->
</body>

<script src="../lib/bootstrap/js/jquery-3.4.1.min.js"></script>
<script src="../lib/bootstrap/js/bootstrap.min.js"></script>

</html>