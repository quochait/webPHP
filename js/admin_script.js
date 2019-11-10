// debugger
function loadUser() {
  $("#tagTable>h6").text("Danh sách thành viên");
  $("#showImages").html("");
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

function updateUser(index) {
  let parentEditForm = $("#editUserForm");
  let inputHo = parentEditForm.find("#inputHo").val();
  let inputTen = parentEditForm.find("#inputTen").val();
  let inputRole = parentEditForm.find("#inputRole").val();
  let inputEmail = parentEditForm.find("#inputEmail").val();
  let inputDiachi = parentEditForm.find("#inputDiachi").val();
  let inputPassword = parentEditForm.find("#inputPassword").val();

  if ((inputPassword.length > 4 || !inputPassword) && inputEmail.length > 0){
    $.ajax({
      method: 'POST',
      url: 'updateUser.php',
      data: {ho: inputHo, ten: inputTen, role: inputRole, password: inputPassword, diachi: inputDiachi, email: inputEmail},
      success: function(data){
        alert(data);
        if(data){
          alert("Chỉnh sửa thành công.");

          let parent = $("#user" + index);

          parent.find("td:nth-child(1)").html(inputHo);
          parent.find("td:nth-child(2)").html(inputTen);
          parent.find("td:nth-child(5)").html(inputRole);
          parent.find("td:nth-child(3)").html(inputEmail);
          parent.find("td:nth-child(4)").html(inputDiachi);
        }
        else{
          alert("Chỉnh sửa không thành công.");
        }
      }
    })
  }
  else{
    alert("Nhập password từ 5 tới 12 ký tự hoặc để trống để giữ nguyên.");
  }
}


function showFormEditUser(index) {
  $("#editUserForm").modal("toggle");
  let parent = $("#user" + index);

  let ho = parent.find("td:nth-child(1)").html();
  let ten = parent.find("td:nth-child(2)").html();
  let role = parent.find("td:nth-child(5)").html();
  let email = parent.find("td:nth-child(3)").html();
  let diachi = parent.find("td:nth-child(4)").html();

  let parentEditForm = $("#editUserForm");
  parentEditForm.find("#inputHo").val(ho);
  parentEditForm.find("#inputTen").val(ten);
  parentEditForm.find("#inputEmail").val(email);
  parentEditForm.find("#inputDiachi").val(diachi);
  parentEditForm.find("#inputRole").val(role);

}


function editUser(email, index) {
  showFormEditUser(index);
  $("#editUserForm").find("#buttonSave").attr("onclick", "updateUser(" + index + ");");
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

// show from để thêm user vào database 
function showFormAddUser(){
  $("#tagTable>h6").text("Thêm thành viên");
  $("#showImages").html("");
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

//xóa sản phẩm trong database
function deleteProduct(id){
  $("#showImages").find("#product_" + id).remove();
  // $("#product_" + id).remove();
  // console.log("vao");
  $.ajax({
    method: "POST",
    url: "deleteProduct.php",
    data: {Id: id},
    success: function(data){
      console.log(data);
    }
  });
}

//lấy sử liệu từ database và hiển thị 
function loadProducts() {
  $("#tagTable>h6").text("Danh sách sản phẩm.");
  $("#showImages").html();
  $("#showData>.card>.card-body").html("");

  $.ajax({
    method: "POST",
    url: "getProductType.php",
    success: function (productsType) {
      let selectTag = `
        <select class="form-control col-md-3 mt-2" name="inputFilter" id="inputFilter">
          <option value="0">None</option>
          `+ productsType +`
        </select>
      `;
      // console.log(productsType);
      $("#tagTable>h6").append(selectTag);
    }
  });

  $.ajax({
    method: "POST",
    url: "getProducts.php",
    success: function (data) {
      let listProduct = JSON.parse(data);

      for (let index = 0; index < listProduct.length; index++) {
        let element = listProduct[index];
        let id = "product_" + element.Id;
        let cardTag = `
          <div class="col-md-4 mb-5" id="`+ id +`">
            <div class="card h-100">
              <img class="card-img-top same-height" src="`+ element.path +`" alt="`+ element.ten +`">
              <div class="card-body">
                <h4 class="card-title text-primary">`+ element.tensp +`</h4>
                <p class="card-text">`+ element.mota.substring(0, 30) +`</p>
                <h6 class="text-danger"><i class="fas fa-dollar-sign"></i> `+ element.gia +` VND</h6>
              </div>
              <div class="card-footer text-center">
                <button class="btn btn-primary" onclick="editProduct()"><i class="fas fa-pen"></i> Chỉnh sửa</button>
                <button class="btn btn-danger" onclick="deleteProduct(`+ element.Id +`)"><i class="fas fa-trash"></i> Xóa</button>
              </div>
            </div>
          </div>
        `;

        $("#showImages").append(cardTag);
      }
    }
  });
}

//Show form tạo thêm sản phẩm
function showFormAddProduct() {
  $("#tagTable>h6").text("Thêm sản phẩm");
  $("#showImages").html("");
  $.ajax({
    method: "POST",
    url: "getProductType.php",
    success: function (data) {
      // alert(data);
      let form = `
        <div>
          <div class="row mb-2">
            <label class="col-md-3" for="inputTensp">Tên sản phẩm:</label>
            <input class="form-control col-md-6" type="text" name="inputTensp" id="inputTensp" placeholder="Tên sản phẩm">
          </div>
        </div>

        <div>
          <div class="row mb-2">
            <label class="col-md-3" for="inputGia">Giá:</label>
            <input class="form-control col-md-6" type="text" name="inputGia" id="inputGia" placeholder="Giá sản phẩm">
          </div>
        </div>

        <div>
          <div class="row mb-2">
            <label class="col-md-3" for="inputMota">Mô tả:</label>
            <textarea class="form-control col-md-6" name="inputMota" id="inputMota" cols="30" rows="8" placeholder="Mô tả sản phẩm"></textarea>
          </div>
        </div>

        <div>
          <div class="row mb-2">
            <label class="col-md-3" for="inputLoai">Loại sản phẩm:</label>
            <select class="form-control col-md-6" name="inputLoai" id="inputLoai">
              `+ data +`
            </select>
          </div>
        </div>
        
        <!--
        <div>
          <div class="row mb-2">
            <label class="col-md-3" for="inputNcc">Nhà cung cấp:</label>
            <select class="form-control col-md-6" name="inputNcc" id="inputNcc">
              ` + data + `
            </select>
          </div>
        </div>
        -->

        <div>
          <div class="row mb-2">
            <label class="col-md-3" for="inputSoluong">Số lượng:</label>
            <input class="form-control col-md-6" type="text" name="inputSoluong" id="inputSoluong" placeholder="Số lượng">
          </div>
        </div>

        <div>
          <div class="row mb-2">
            <p class="col-md-3">Hình ảnh: </p>
            <div class="custom-file col-md-6">
              <input type="file" class="custom-file-input" id="inputImages" accept="image/*" multiple>
              <label class="custom-file-label" for="inputImages">Chọn hình ảnh</label>
            </div>
          </div>
        </div>

        <div class="text-center mt-3">
          <button class="btn btn-success" onclick="saveProduct()">Lưu</button>
        </div>
      `;
      $("#showData>.card>.card-body").html(form);

      $("#inputImages").change(function () {
        $("#showImages").html("");
        for (let index = 0; index < this.files.length; index++) {
          addBlockImage(this.files[index], index);
        }
      });
    }
  });
}

//xóa ảnh
function removeBlackImage(index){
  $("#image_" + index).remove();
}


// Show hình ảnh được thêm vào trong thêm sản phẩm
function addBlockImage(input, index) {
  if(input && input){
    let reader = new FileReader();
    reader.onload = function (e){
      let div = `
        <div class="col-md-4 col-lg-3 mt-3 text-center" id="image_`+ index +`">
          <img id="blah" src="`+ e.target.result +`" class="img-fluid w-100 rounded same-height">
          <button class="btn btn-danger mt-2" onclick="removeBlackImage(`+ index +`)">
            Xóa
          </button>
        </div>
      `;
      $("#showImages").append(div);
      // $("#blah").attr("src", e.target.result);
    }
    reader.readAsDataURL(input);
  }
}


// lưu sản phẩm vào database
function saveProduct() {
  let inputGia = $("#inputGia").val();
  let inputMota = $("#inputMota").val();
  let inputLoai = $("#inputLoai").val();
  let inputTensp = $("#inputTensp").val();
  let inputSoluong = $("#inputSoluong").val();
  
  if (checkNotEmpty(inputGia) && checkNotEmpty(inputMota) && checkNotEmpty(inputLoai) && checkNotEmpty(inputTensp) && checkNotEmpty(inputSoluong)){
    $.ajax({
      method: "POST",
      url: "addProduct.php",
      data: { tensp: inputTensp, loaisp: inputLoai, mota: inputMota, gia: inputGia, soluong: inputSoluong},
      success: function (data) {
        if(data == 1){
          alert("Thêm sản phẩm thành công.");
          addImagesToDatabase();
          showFormAddProduct();
        }
        else{
          alert("Thêm sản phẩm không thành công.");
        }
      }
    });
  }
  else{
    alert("Nhập đầy đủ và chính xác thông tin.");
  }
}

// Thêm ảnh sản phẩm vào database
function addImagesToDatabase() {
 
  let images = document.getElementById("inputImages");
  var form_data = new FormData();

  for (let index = 0; index < images.files.length; index++) {
    form_data.append("files["+index+"]", images.files[index]);
  }

  $.ajax({
    method: "POST",
    url: "addImages.php",
    data: form_data,
    contentType: false,
    processData: false,
    success: function(data){
      console.log(data);
    }
  })

  $("#showImages").html("");
}

// function check string truyền vào có rỗng hay không
// trả về true nếu hàm không rỗng
function checkNotEmpty(input) {
  if(input.trim().length > 0){
    return true;
  }
  else{
    return false;
  }
}

$(document).ready(function(){
  loadProducts();
});
