$(document).ready(function () {
  $('#form').submit(function (event) { // changed selector to #login
    event.preventDefault();

    var formloginData = {
      email: $('#email').val(),
      password: $('#password').val()
    };

    $.ajax({

      url: 'login.php',
      type: 'POST',
      data: formloginData,
      dataType: 'JSON',
      success: function (response) {
        console.log(response.success);
        console.log(response.message);
        if (response.success == true) {
          window.location.href = "display.html";
        } else{
          alert("Invalid user");
        }
      },
      error: function (xhr, status, error) {
        console.log("Alert!!!" + error);
      }
    });
  });
});
