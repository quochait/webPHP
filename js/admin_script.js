function loadUser() {
  $("#tagTable>h6").text("Danh sách thành viên");
  $.ajax({
    method: 'GET',
    url: 'loadUser.php',
    success: function(data){
      $("#showData>.card>.card-body").html(`
         <div class="table-responsive">
          <table class="table table-bordered" id="mainTable" width="100%" cellspacing="0">
            <thead class="text-center">
              <tr>
                <th>Họ</th>
                <th>Tên</th>
                <th>Email</th>
                <th>Địa chỉ</th>
                <th>Quyền</th>
                <th id="changeButton">Chỉnh sửa</th>
              </tr>
            </thead>
            
            <tbody class="text-center">
              
            </tbody>
          </table>
        </div>
      `);
      $("#mainTable>tbody").html("");
      $("#mainTable>tbody").append(data);
    }
  });
}

function editUser(email) {
  $.ajax({
    method: 'POST',
    url: "editUser.php"
  })
}

function deleteUser(email, index) {
  $.ajax({
    method: 'POST',
    url: "deleteUser.php",
    data: {email: email},
    success: function(data){
      if(data === '1'){
        $("#user" + index).remove();
        alert("Xóa thành viên thành công.");
      }
      else{
        alert("Không xóa được thành viên.");
      }
    }
  })
}

function checkPassword(password) {
  let regex = /^\w{5,12}$/;

  if(!regex.test(password)){
    $("#noficationInputPassword").html("*Độ dài từ 5 tới 12 ký tự");
    return 0;
  }
  else{
    return 1;
  }

}

function addUserToDatabase(ho, ten, email, password, role, diachi) {
  
  $.ajax({
    method: 'POST',
    url: 'addUser.php',
    data: { ho: ho, ten: ten, email: email, password: password, role: role, diachi: diachi},
    success: function (data) {
      if(data === '1'){
        alert("Thêm thành viên thành công.");
        // $(":input").html("");
      }
      else{
        alert("Thêm thành viên thất bại.")
      }
    }
  })
}

function checkEmail(email) {
  let regex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  if(!regex.test(email)){
    $("#noficationInputEmail").html("* Nhập đúng dạng email.");
    return 0;
  }else{
    return 1;
  }
}


function addUser() {
  let ho = $("#inputHo").val();
  let ten = $("#inputTen").val();
  let email = $("#inputEmail").val();
  let diachi = $("#inputDiachi").val();
  let password = $("#inputPassword").val();
  let role = $("#inputRole").children("option:selected").val();
  
  checkEmail(email);

  if(ho !== '' && ten !== '' && email !== '' && password !== '' && role !== '' && diachi !== '' && checkPassword(password) && checkEmail(email)){
    $.ajax({
      method: 'POST',
      url: 'isExistsUser.php',
      data: {email: email},
      success: function(data){
        if(data == '0'){
          addUserToDatabase(ho, ten, email, password, role, diachi);
        }
        else{
          alert("Email đã tồn tại.");
        }
      }
    });
  }
  else{
    alert("Vui lòng nhập đầy đủ thông tin.");
  }
}

function showFormAddUser(){
  $("#tagTable>h6").text("Thêm thành viên");
  $("#mainTable").html("");
  let form = `
      <div class="row mb-2">
        <label class="col-md-3" for="inputHo">Họ và tên lót:</label>
        <input class="form-control col-md-5" type="text" name="inputHo" id="inputHo" placeholder="Họ và tên lót"> 
        <span class="text-danger font-italic ml-4" id="noficationInputHo"></span>
      </div>
      
      <div class="row mb-2">
        <label class="col-md-3" for="inputTen">Tên:</label>
        <input class="form-control col-md-5" type="text" name="inputTen" id="inputTen"  placeholder="Tên">
        <span class="text-danger font-italic ml-4" id="noficationInputTen"></span>
      </div>
      <div class="row mb-2">
        <label class="col-md-3" for="inputEmail">Email:</label>
        <input class="form-control col-md-5" type="email" name="inputEmail" id="inputEmail"  placeholder="Email">
        <span class="text-danger font-italic ml-4" id="noficationInputEmail"></span>
      </div>
      <div class="row mb-2">
        <label class="col-md-3" for="inputPassword">Password:</label>
        <input class="form-control col-md-5" type="password" name="inputPassword" id="inputPassword"  placeholder="Password">
        <span class="text-danger font-italic ml-4" id="noficationInputPassword"></span>
      </div>
      <div class="row mb-2">
        <label class="col-md-3" for="inputDiachi">Địa chỉ:</label>
        <input class="form-control col-md-5" type="text" name="inputDiachi" id="inputDiachi"  placeholder="Địa chỉ">
        <span class="text-danger font-italic ml-4" id="noficationInputDiaChi"></span>
      </div>
      <div class="row mb-2">
        <label class="col-md-3" for="inputRole">Phân quyển</label> 
        <select class="form-control col-md-5 text-center" name="inputRole" id="inputRole">
        <span class="text-danger font-italic ml-4" id="noficationInputHo"></span>
          <option value="user">Thành viên</option>
          <option value="admin">Quản trị viên</option>
        </select>
      </div>

      <div class="row mb-2 col-md-10">
        <div class="mx-auto btn-group">
          <button class="btn btn-success" onclick="addUser();">Thêm thành viên</button>
          <button class="btn btn-warning" type="reset">Reset</button>
        </div>
      </div>

  `;
  $("#showData>.card>.card-body").html(form);

  let script_check = `
    <script>
      checkEmpty("#inputHo","#noficationInputHo");
      checkEmpty("#inputTen","#noficationInputTen");
      checkEmpty("#inputEmail","#noficationInputEmail");
      checkEmpty("#inputDiachi","#noficationInputDiaChi");
      checkEmpty("#inputPassword","#noficationInputPassword");
     
    </script>
  `;

  $("body").append(script_check);
}

function checkEmpty(target, targetNofication) {
  $(target).blur(function () {
    if (!$(this).val()) {
      $(targetNofication).html(" *Bắt buộc");
    }
    else {
      $(targetNofication).html("");
    }
  });
}