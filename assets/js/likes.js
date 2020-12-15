$(document).ready(function () {
    $(document).on('click', '.like-btn', function () {
        var tweet_id = $(this).data('tweet');
        var user_id = $(this).data('user');
        var likescounter = $(this).find('.likescounter');
        var counter = likescounter.text();
        var button = $(this);

        $.ajax({
            url: 'core/ajax_db/likes.php',
            method: 'POST',
            dataType: 'text',
            data: {
                like: tweet_id,
                user_id: user_id,
            }, success: function (response) {
                likescounter.show();
                button.addClass('unlike-btn');
                button.removeClass('like-btn');
                counter++;
                likescounter.text(counter++);
                button.find('.fa-thumbs-o-up').addClass('fa-thumbs-up').css('color', 'red');
                button.find('.fa-thumbs-up').removeClass('fa-thumbs-o-up');

                // location.reload();

                console.log(response);
            }
        });
    });
});

$(document).ready(function () {
    $(document).on('click', '.unlike-btn', function () {
        var tweet_id = $(this).data('tweet');
        var user_id = $(this).data('user');
        var likescounter = $(this).find('.likescounter');
        var counter = likescounter.text();
        var button = $(this);

        $.ajax({
            url: 'core/ajax_db/likes.php',
            method: 'POST',
            dataType: 'text',
            data: {
                unlike: tweet_id,
                user_id: user_id,
            }, success: function (response) {
                likescounter.show();
                button.addClass('like-btn');
                button.removeClass('unlike-btn');
                counter--;
                if (counter === 0) {
                    likescounter.hide();
                } else {
                    likescounter.text(counter--);
                }
                button.find('.fa-thumbs-up').addClass('fa-thumbs-o-up').css('color', '#007bff');
                button.find('.fa-thumbs-o-up').removeClass('fa-thumbs-up');

                console.log(response);
            }
        });
    });
});