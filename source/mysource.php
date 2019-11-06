<?php
  class database{
    function messageBox($message){
      echo "<script>
              alert('$message');
            </script>";
    }

    function connect(){
      $conn = mysqli_connect("localhost", "quocha", "123");

      if(!$conn){
        $this->messageBox("Không kết nối được cơ sở dữ liệu.");
        exit;
      }
      else{
        mysqli_select_db("csdlbanhang");
        mysqli_query($conn, "SET NAME UTF-8");
        return $conn;
      }
    }

    function login($username, $password){
      $link = $this->connect();
      $hashed = md5($password);
      $sql = "SELECT * FROM users WHERE email='$username' AND password='$hashed'";
      $result = mysqli_query($link, $sql);
      $i = mysqli_num_rows($result);
      
      if($i > 0){
        $this->messageBox("Dung");
      }
    }

    function changesProduct($sql){
      $link = $this->connect();
      if(mysqli_query($link, $sql)){
        return 1;
      }
      else{
        return 0;
      }
    }

    function filterChar(){

    }

  }
?>