$(document).ready(function () {
    var win = $(window);
    var offset = 10;

    win.scroll(function () {
        if ($(document).height() <= (win.height() + win.scrollTop())) {
            offset += 10;
            $('#loader').show();

            $.ajax({
                url: 'core/ajax_db/fetchPost',
                method: 'POST',
                dataType: 'text',
                data: {
                    fetchPost: offset,
                },
                xhr: function () {
                    var xhr = new XMLHttpRequest();
                    xhr.upload.addEventListener('progress', function (e) {
                        var progress = Math.round((e.loaded / e.total) * 100);
                        $('.progress-navbar').show();
                        $('#progress_width').css('width', progress + '%');
                        $('#progress_width').html(progress + '%');
                    }, false);

                    xhr.addEventListener('load', function (e) {
                        $('.progress-bar').removeClass('bg-info').addClass('bg-danger').html('<span> completed  <span class="fa fa-check"></span></span>');
                        setInterval(function () {
                            $(".progress-navbar").fadeOut();
                        }, 2000);
                    }, false);
                    return xhr;
                }, success: function (response) {
                    $('.posted').html(response);
                    $('#loader').hide();
                    // // console.log(response);
                }
            });
        }

    });

});
