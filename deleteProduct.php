<?php
  include 'source/mysource.php';
  $p = new database();
  session_start();
  $p->checkAdmin();

  $Id = $_POST['Id'];

  if(isset($Id)){
    echo $p->deleteProduct($Id);
  }
?>