<?php
  include "../source/mysource.php";
  $p = new database();
  session_start();
  $p->checkAdmin();
  $sql = "SELECT * FROM users";
  $p->loadUser();
?>

