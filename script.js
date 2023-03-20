$(document).ready(function () {
    $('#form').submit(function (event) {

        var formData = {
            fname: $('#fname').val(),
            lname: $('#lname').val(),
            email: $('#email').val(),
            password: $('#password').val()
        };

        $.ajax({
            type: 'POST',
            url: 'signup.php',
            data: formData,
            dataType: 'json',
            encode: true,
            success: function(response) {
                if(response[0].success){
                  alert("Signup Sucessful");
                window.location.href = 'login.html';
        
                }
                else{
                  alert(response[0].message);
                }
              },
            error: function (xhr, status, error) {
                alert("Error:", error);
            }
        });
        event.preventDefault();
    });
});
