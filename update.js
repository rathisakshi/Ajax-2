$(document).ready(function () {
    $("form").submit(function (event) {
        var id = sessionStorage.getItem("id");

        var formData = {
            id: id,
            Post_description: $("#Description").val(),
            Post_title: $("#Title").val()
        }

        $.ajax({
           
            url: "update.php",
            type: "POST",
            data: formData,
            dataType: "JSON",
            encode: true,
            success: function (response) {
                if (response[0]['message']) {
                    alert(response[0]['message']);
                    window.location.href = 'updateview.html';

                }
            },
            error: function (xhr, status, error) {
                alert("failed" + xhr + status + error);
            }

        });

        event.preventDefault();
    });
});