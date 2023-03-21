$(document).ready(function () {
  $('#form').submit(function (event) { // changed selector to #login
    event.preventDefault();

    var formloginData = {
      email: $('#username').val(),
      password: $('#password').val()
    };

    $.ajax({
      type: 'POST',
      url: 'login.php',
      data: formloginData,
      dataType: 'json',
      encode: true,
      success: function (response) {
        console.log(response);
        // if (response.success == true) {
        //   window.location.href = "display.html";
        // } else{
        //   alert("Invalid user");
        // }
      },
      error: function (xhr, status, error) {
        console.log("Error:", error);
      }
    });
    event.preventDefault();
  });
});
