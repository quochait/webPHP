<?php
  include '../source/mysource.php';
  $p = new database();
  session_start();
  $p->checkAdmin();

  $tensp = $_POST['tensp'];
  $mota = $_POST['mota'];
  $loaisp = $_POST['loaisp'];
  // $ncc = $_POST['$ncc'];
  $gia = $_POST['gia'];
  $soluong = $_POST['soluong'];

  // echo $tensp . $mota . $loaisp . $gia . $soluong;
  // echo $loaisp;

  echo $p->addProduct($tensp, $mota, $loaisp, $gia, $soluong);

?>