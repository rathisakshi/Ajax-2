$(document).ready(function () {
    $('tbody').empty();
   
       

        var formData = {
            userid: $("#userid").val(),
            Title: $("#Title").val(),
            Description: $("#Description").val(),
        };

        $.ajax({
            type: "POST",
            url: "insert.php",
            data: formData,
            dataType: "json",
            encode: true,
            success: function (response) {
                // Clear previous table rows
                $("#table tbody").empty();

                var len = response.length;
                for (var i = 0; i < len; i++) {
                    var id = response[i].id;
                    var userid = response[i].userid;
                    var Title = response[i].Title;
                    var Description = response[i].Description;
                    var tr_str = "<tr>" +
                        "<td>" + id + "</td>" +
                        "<td>" + userid + "</td>" +
                        "<td>" + Title + "</td>" +
                        "<td>" + Description + "</td>" +
                        "<td><button class='deleteBtn' data-id='" + id + "'>Delete</button></td>" +
                        "<td><button class='updateeBtn' data-id='" + id + "'>Update</button></td>" +
                        "</tr>";
                    $("#table tbody").append(tr_str);
                    $('#userid').val('');

                    $('#Title').val('');
                    $('#Description').val('');
                }
                $(".deleteBtn").on("click", function () {
                    var id = $(this).data("id");
                    var row = $(this).closest("tr");
                    $.ajax({
                        type: "POST",
                        url: "delete.php",
                        data: { id: id },
                        success: function () {

                            row.remove();
                        }
                    });
                });
                $(".updateeBtn").on("click", function () {
                    var id = $(this).data("id");
                    sessionStorage.setItem("id", id);
                    window.location.href = 'update.html';
                });
            }
        });


        
    });



