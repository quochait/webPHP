<?php
  include 'source/mysource.php';
  $p = new database();
  session_start();
  $p->checkAdmin();

  $ho = $_POST['ho'];
  $ten = $_POST['ten'];
  $diachi = $_POST['diachi'];
  $role = $_POST['role'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  
  if(isset($ho) && isset($ten) && isset($email) && isset($password) && isset($role) && isset($diachi)){
    echo $p->addUser($ho, $ten, $email, md5($password), $diachi, $role);
  }

?>