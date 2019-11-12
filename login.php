<?php
  include 'source/mysource.php';
  $p = new database();
  $email = $_POST['email'];
  $password = $_POST['password'];

  $p->login($email, $password);
?>