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
        mysqli_set_charset($conn,"utf8");
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
      $link = $this->connect();
      $sql = "SELECT role FROM users WHERE email='$email'";
      $result = mysqli_query($link, $sql);
      $i = mysqli_num_rows($result);

      return $i;
    }

    function addUser($ho, $ten, $email, $password, $diachi, $role)
    {
      $link = $this->connect();
      if($this->isExistsUser($email) == 0){
        $sql = "INSERT INTO users(ho, ten, email, diachi, password, role) VALUES('$ho', '$ten', '$email', '$diachi', '$password', '$role')";
        $result = $this->executeSql($sql);
        return $result;
      }
      else{
        return 0;
      }
    }

    // lấy sản phẩm trong database 
    function loadProduct($filter){
      $sql = "";
      $sql = "SELECT * FROM sanpham";
      $link = $this->connect();
      $result = mysqli_query($link, $sql);
      $i = mysqli_num_rows($result);
      $output = array();

      if($i > 0){
        while ($row = mysqli_fetch_array($result)) {
          $Id = $row['Id'];
          $path = '';
          
          $sql = "SELECT path FROM hinhanh WHERE Idsanpham='$Id' LIMIT 1";
          $result_image = mysqli_query($link, $sql);

          while ($row_image = mysqli_fetch_array($result_image)) {
            $path = $row_image['path'];
          }
          
          $tmp['tensp'] = $row['tensp'];
          $tmp['mota'] = $row['mota'];
          $tmp['loaisp'] = $row['loaisp'];
          $tmp['gia'] = $row['gia'];
          $tmp['soluong'] = $row['soluong'];
          $tmp['Id'] = $row['Id'];
          $tmp['path'] = $path;

          array_push($output, $tmp);
        }
      }

      return json_encode($output);
    }

    function loadUser()
    {
      $link = $this->connect();
      $sql = "SELECT * FROM users";
      $result = mysqli_query($link, $sql);
      $i = mysqli_num_rows($result);
      $output = '';
      $index = 0;

      if($i > 0){
        while ($row = mysqli_fetch_array($result)) {
          $email = "'" . $row['email'] . "'";
          $output .= '
            <tr id="user'.$index.'">
              <td>'.$row['ho'].'</td>
              <td>'.$row['ten'].'</td>
              <td>'.$row['email'].'</td>
              <td>'.$row['diachi'].'</td>
              <td>'.$row['role'].'</td>
              <td>
                <div class="btn-group">
                  <button class="btn btn-primary" onclick="editUser('. $email .', '. $index .');" ><i class="fas fa-pen"></i></button>
                  <button class="btn btn-danger" onclick="deleteUser('.$email.', '. $index .');"><i class="fas fa-trash"></i></button>
                </div>
              </td>
            </tr>
          ';
          $index += 1;
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

    function deleteUser($email)
    {
      $sql = "DELETE FROM users WHERE email='$email' LIMIT 1";
      $result = $this->executeSql($sql);
      return $result;
    }

    function updateUser($ho, $ten, $role, $password, $diachi, $email)
    {
      $sql = '';
      $hashed = md5($password);
      
      if(strlen($password) > 0){
       $sql = "UPDATE users SET ho='$ho', ten='$ten', role='$role', password='" . $hashed . "', diachi='$diachi', email='$email' WHERE email='$email'"; 
      }
      else{
        $sql = "UPDATE users SET ho='$ho', ten='$ten', role='$role', diachi='$diachi', email='$email' WHERE email='$email'";
      }
      $result = $this->executeSql($sql);
      return $result;
    }

    function getProductType()
    {
      $link = $this->connect();
      $sql = "SELECT Id, tenloai FROM loaisp";
      $result = mysqli_query($link, $sql);
      $i = mysqli_num_rows($result);
      $output = '';

      if($i > 0){
        while ($row = mysqli_fetch_array($result)) {
          $id = $row['Id'];
          $tenloai = $row['tenloai'];
          $output .= '<option value="'.$id.'">'.$tenloai.'</option>';
        }  
      }

      return $output;
    }

    // thêm sản phẩm vào database từ lấy data từ addProduct.php
    function addProduct($tensp, $mota, $loaisp, $gia, $soluong){
      $sql = "INSERT INTO sanpham(tensp, mota, loaisp, gia, soluong) VALUES('$tensp', '$mota', '$loaisp', '$gia', '$soluong')";
      $result = $this->executeSql($sql);
      
      return $result;
    }

    // Thêm ảnh vào folder images/[idsanpham] và database
    function addImage($name, $size, $type, $tmpPath)
    {
      $sql = "SELECT Id FROM sanpham ORDER BY Id DESC LIMIT 1";
      $link = $this->connect();
      $result = mysqli_query($link, $sql);
      $i = mysqli_num_rows($result);
      $Id = 0;

      if($i == 1){
        while ($row = mysqli_fetch_array($result)) {
          $Id = $row['Id'];  
        }
      }

      $des = "../images/sanpham/" . $Id;
     
      if(!is_dir($des)){
       mkdir($des); 
      }

      $des = $des .'/'. md5(time()) . "_" . $name;

      if(!move_uploaded_file($tmpPath, $des)){
        return "Khong upload file duoc\n";
      }

      $sql = "INSERT INTO hinhanh(Idsanpham, path) VALUES('$Id', '$des')";
      $result = $this->executeSql($sql);
      return $result;
    }

    //xóa product và ảnh liên quan
    function deleteProduct($Id){
      $output = '';
      $sql = "DELETE FROM hinhanh WHERE Idsanpham='$Id'";
      $output .= $this->executeSql($sql);
      $sql = "DELETE FROM sanpham WHERE Id='$Id'";
      $des = "../images/sanpham/" . $Id;
      $output .= $this->executeSql($sql);

      //xóa ảnh và folder của ảnh
      if(is_dir($des)){
        $files = glob($des . '/*');
        foreach ($files as $file) {
          unlink($file);
        }
        rmdir($des);
      }

      return $output;
    }
  }
?>