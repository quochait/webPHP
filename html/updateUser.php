
<?php
  include '../source/mysource.php';
  $p = new database();
  session_start();
  $p->checkAdmin();

  $ho = $_POST['ho'];
  $ten = $_POST['ten'];
  $role = $_POST['role'];
  $password = $_POST['password'];
  $diachi = $_POST['diachi'];
  $email = $_POST['email'];

  $p->messageBox($password);
  
  echo $p->updateUser($ho, $ten, $role, $password, $diachi, $email);

?>