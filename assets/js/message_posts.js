
$(document).ready(function (e) {
    $('.progress-hide').hide();
    $('.progress-navbar').hide();

    $('#post_form').submit(function (event) {
        event.preventDefault();
        var id = $('#id_posts').val();
        var image_name = $('#file').val();
        var textarea = $('#status').val();

        if (image_name == '') {
        
            if (textarea != '') {
                $.ajax({
                    url: "core/ajax_db/message_posts.php",
                    method: "POST",
                    data: {
                        key: 'textarea',
                        id: id,
                        status: textarea,
                    },
                    success: function (response) {
                        $("#response-posts").html(response);
                        setInterval(function () {
                            $("#response-posts").fadeOut();
                        }, 1000);
                        // setInterval(function () {
                        //     location.reload();
                        // }, 1100);
                    }, error: function (response) {
                        $("#response-posts").html(response);
                        setInterval(function () {
                            $("#response-posts").fadeOut();
                        }, 3000);
                    }
                });

            }else{
                $("#empty-posts").html('Type or choose image to post').fadeIn();
                setInterval(function() {
                    $("#empty-posts").fadeOut();
                    }, 6000);
            }
        }else {
            var extensions = $('#file').val().split('.').pop().toLowerCase();
            if (jQuery.inArray(extensions, ['gif', 'png', 'jpg', 'mp4', 'mp3', 'jpeg', 'bmp', 'pdf', 'doc', 'ppt', 'docx', 'xlsx', 'xls', 'zip']) == -1) {
                $("#response-posts").html('Invalid Image File').fadeIn();
                setInterval(function () {
                    $("#response-posts").fadeOut();
                }, 4000);
                $('#file').val('');
                return false;
            } else {
                $.ajax({
                    url: "core/ajax_db/message_posts.php",
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    xhr: function(){
                        var xhr = new XMLHttpRequest();
                        xhr.upload.addEventListener('progress',function(e){
                            var progress= Math.round((e.loaded/e.total)*100);
                            $('.progress-hide').show();
                            $('#pro').css('width',progress +'%');
                            $('#pro').html(progress +'%');
                        });

                        xhr.addEventListener('load', function (e) { 
                            $('.progress-bar').removeClass('bg-info').addClass('bg-success').html('<span>upload completed  <span class="fa fa-check"></span></span>');
                        });
                          return xhr;
                    },
                    success: function (response) {
                        $("#response-posts").html(response).fadeIn();
                        setInterval(function () {
                            $("#response-posts").fadeOut();
                        }, 1000);
                        setInterval(function () {
                            // location.reload();
                        }, 1100);
                    }, error: function (response) {
                        $("#response-posts").html(response).fadeIn();
                        setInterval(function () {
                            $("#response-posts").fadeOut();
                        }, 3000);
                   }
                });
                return false;
            }
        }
    });

});
