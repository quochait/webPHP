<?php
  class database{
    function messageBox($message){
      echo "<script>
              alert('$message');
            </script>";
    }

    function connect(){
      $conn = mysqli_connect("localhost", "test", "admin");

      if(!$conn){
        $this->messageBox("Không kết nối được cơ sở dữ liệu.");
        exit;
      }
      else{
        mysqli_select_db($conn, "csdlbanhang");
        mysqli_query($conn, "SET NAME UTF-8");
        return $conn;
      }
    }


    function login($username, $password){
      $link = $this->connect();
      $hashed = md5($password);
      $sql = "SELECT Id, email, ho, ten, role FROM users WHERE email='$username' AND password='$hashed' LIMIT 1";
      $result = mysqli_query($link, $sql);
      $i = mysqli_num_rows($result);
      
      if($i == 1){
        $row = mysqli_fetch_array($result);
        $ho = $row['ho'];
        $ten = $row['ten'];
        // $Id = $row['Id'];
        $email = $row['email'];
        $role = $row['role'];
        
        session_start();

        $_SESSION['ho'] = $ho;
        $_SESSION['ten'] = $ten;
        $_SESSION['email'] = $email;
        $_SESSION['role'] = $role;
        $_SESSION['isLogin'] = TRUE;
        
        if($role === "admin"){
          $this->navigationTo("admin.php");
        }
      }
      else{
        $this->messageBox("Tài khoản hoặc mật khẩu không đúng.");
      }
    }

    function executeSql($sql){
      $link = $this->connect();
      if(mysqli_query($link, $sql)){
        return 1;
      }
      else{
        return 0;
      }
    }

    function navigationTo($destination){
      echo "<script>
              window.location = '$destination'
            </script>";
    }

    function confirmUser($ho, $ten, $email, $role)
    {
      $sql = "SELECT email, role FROM users WHERE ho='$ho' AND ten='$ten' AND email='$email' AND role='admin' LIMIT 1";
      $link = $this->connect();
      $result = mysqli_query($link, $sql);
      $i = mysqli_num_rows($result);
      if($i != 1){
        $this->navigationTo("index.php");
      }
    }

    function logout()
    {
      session_unset();
      session_destroy();
    }

    function isExistsUser($email)
    {
      $sql = "SELECT role FROM users WHERE email='$email' LIMIT 1";
      if($this->executeSql($sql) == 1){
        return TRUE;
      }
      else{
        return FALSE;
      }
    }

    function addUser($password, $ho, $ten, $email, $role, $diachi)
    {
      $link = $this->connect();
      if(isExistsUser($email) == FALSE){
        $sql = "INSERT INTO users(ho, ten, email, diachi, password, role) VALUES('$ho', '$ten', '$email', '$diachi', '$password', '$role')";
        if($this->executeSql($sql) == 1){
          $this->messageBox("Thêm thành viên thành công.");
        }
        else{
          $this->messageBox("Hmmm. Có gì đó sai sai.");
        }
      }
      else{
        $this->messageBox("Tài khoản đã tồn tại.");
      }
    }

    function loadProduct($filter){

    }

    function loadUser()
    {
      $link = $this->connect();
      $sql = "SELECT * FROM users";
      $result = mysqli_query($link, $sql);
      $i = mysqli_num_rows($result);
      $output = '';

      if($i > 0){
        while ($row = mysqli_fetch_array($result)) {
          $output .= "
            <div >
              ".$row['ho']. " " . $row['email'] ."
            </div>
          ";
        }
        echo $output;
      }

    }

    function checkAdmin()
    {
      $ho = $_SESSION['ho'];
      $ten = $_SESSION['ten'];
      $role = $_SESSION['role'];
      $email = $_SESSION['email'];

      if(isset($ho) && isset($ten) && isset($email) && isset($role)){
        if($role==="admin"){
          $this->confirmUser($ho, $ten, $email, $role);
        }
      }
      else{
        $this->navigationTo("index.php");
      }
    }

  }
?>