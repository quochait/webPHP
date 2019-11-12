<?php
  include 'source/mysource.php';
  $p = new database();
  session_start();
  $p->checkAdmin();

  $count = count($_FILES['files']['name']);

  for ($index=0; $index < $count ; $index++) { 
    $name = $_FILES['files']['name'][$index];
    $size = $_FILES['files']['size'][$index];
    $type = $_FILES['files']['type'][$index];
    $tmpPath = $_FILES['files']['tmp_name'][$index];

    if($size > 1024*1024*5){
      echo 'Ảnh phải có dung lượng dưới 5MB.';
    }
    else{
      echo $p->addImage($name, $size, $type, $tmpPath);
    }
 }
?>