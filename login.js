$(document).ready(function () {
  $('#form').submit(function (event) { // changed selector to #login

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
        if (response) {
          window.location.href = "display.html";
        }
      },
      error: function (xhr, status, error) {
        console.log("Error:", error);
      }
    });
    event.preventDefault();
  });
});