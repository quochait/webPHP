

function loadUser(){
  $.ajax({
    type: "POST",
    url: "loadUser.php",
    success: function (data) {
      console.log(data);
    }
  });
}