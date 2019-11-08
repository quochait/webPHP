<?php
  include '../source/mysource.php';
  $p = new database();
  session_start();
  $p->checkAdmin();

  $email = $_POST['email'];

  if(isset($email)){
    echo $p->deleteUser($email);
  }

?>