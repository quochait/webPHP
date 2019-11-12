<?php
  include 'source/mysource.php';
  $p = new database();
  // session_start();

  $diachi = $_POST['address'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $ho = $_POST['ho'];
  $ten = $_POST['ten'];
  
  if(isset($email) && isset($password) && isset($diachi) && isset($ho) && isset($ten)){
    if($p->isExistsUser($email) == 0){
      echo $p->registerUser($email, $diachi, $password, $ho, $ten);
    }
    else{
      echo "Email đã tồn tại.";
    }
  }
  else {
    echo "Nhập đầy đủ thông tin.";
  }
  
  // echo $p->addUser($ho, $ten, $email, md5($password), $diachi, $role);
  // $p->messageBox($diachi);
  // $p->messageBox($email);
  // $p->messageBox($password);
?>