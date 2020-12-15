
$(document).ready(function (e) {
    $('.progress-Album').hide();

    $('#album_form').submit(function (event) {
        event.preventDefault();
        var id = $('#id_Album').val();
        var image_name = $('#file').val();

        if (image_name == '') {
                $("#empty-Album").html('Type or choose photo to post').fadeIn();
                setInterval(function() {
                    $("#empty-Album").fadeOut();
                    }, 6000);
        }else {
            var extensions = $('#file').val().split('.').pop().toLowerCase();
            if (jQuery.inArray(extensions, ['gif', 'png', 'jpg', 'mp4', 'mp3', 'jpeg', 'doc', 'ppt', 'docx', 'xlsx', 'xls', 'zip','pdf']) == -1) {
                $("#response-Album").html('Invalid Image File').fadeIn();
                setInterval(function () {
                    $("#response-Album").fadeOut();
                }, 4000);
                $('#file').val('');
                return false;
            } else {
                $.ajax({
                    url: "core/ajax_db/album_image.php",
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    xhr: function(){
                        var xhr = new XMLHttpRequest();
                        xhr.upload.addEventListener('progress',function(e){
                            var progress= Math.round((e.loaded/e.total)*100);
                            $('.progress-Album').show();
                            $('#proAlbum').css('width',progress +'%');
                            $('#proAlbum').html(progress +'%');
                        });

                        xhr.addEventListener('load', function (e) { 
                            $('.progress-bar').removeClass('bg-info').addClass('bg-success').html('<span>upload completed  <span class="fa fa-check"></span></span>');
                        });
                          return xhr;
                    },
                    success: function (response) {
                        $("#response-Album").html(response).fadeIn();
                        setInterval(function () {
                            $("#response-Album").fadeOut();
                        }, 1000);
                        setInterval(function () {
                            location.reload();
                        }, 1100);
                    }, error: function (response) {
                        $("#response-Album").html(response).fadeIn();
                        setInterval(function () {
                            $("#response-Album").fadeOut();
                        }, 3000);
                   }
                });
                return false;
            }
        }
    });

});
