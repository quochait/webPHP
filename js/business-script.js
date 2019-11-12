
function showLogin(){
  $("#darkModalForm").modal("toggle");
   // alert("test");
  $("#loginForm").modal("toggle");
}

function test() {
  alert("test");
} 

function registerUser() {
  let inputEmail = $("#inputEmail").val();
  let inputAddress = $("#inputAddress").val();
  let inputPassword = $("#inputPassword").val();
  let inputHo = $("#inputHo").val();
  let inputTen = $("#inputTen").val();


  if(checkNotEmpty(inputEmail) && checkNotEmpty(inputAddress) && checkNotEmpty(inputPassword) && checkNotEmpty(inputHo) && checkNotEmpty(inputTen)){
    $.ajax({
      method: "POST",
      url: "registerUser.php",
      data: {email: inputEmail, address: inputAddress, password: inputPassword, ho: inputHo, ten: inputTen},
      success: function(data){
        if(data == 1){
          alert("Đăng ký thành công.");
          $.ajax({
            method: "POST",
            url: "login.php",
            data: {email: inputEmail, password: inputPassword},
            success:function(){
              location.reload();
            }
          })
        }
        else{
          alert(data);
        }
      }
    });
  }
}

function checkNotEmpty(input) {
  if (input.trim().length > 0) {
    return true;
  }
  else {
    return false;
  }
}

function add_to_cart(tensp){
  $.ajax({
    method: 'POST',
    url: 'addToShoppingCart.php',
    data: {tensp: tensp},
    success: function(){
      
    }
  });
}