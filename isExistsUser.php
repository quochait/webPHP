<?php
  include 'source/mysource.php';
  $p = new database();
  session_start();
  $p->checkAdmin();
  $email = $_POST['email'];
  echo $p->isExistsUser($email);
?>