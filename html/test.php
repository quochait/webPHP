<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  <form method="post">
    <input type="text" name="inputName" id="inputName">
    <input type="text" name="inputPassword" id="inputPassword">
    <button type="submit" name="login" value="Đăng nhập">Đăng nhập</button>
  </form>

<?php
  include "../source/mysource.php";
  $p = new database();
  
  switch ($_POST['login']) {
    case 'Đăng nhập':
      $username = $_POST['inputName'];
      $password = $_POST['inputPassword'];
      $p->login($username, $password);
      break;
  }
?>
</body>
</html>

