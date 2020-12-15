$(document).ready(function () {
    $(document).on('click', '.like-second-btn', function () {
        var comment_id = $(this).data('comment');
        var user_id = $(this).data('user');
        var likescounter = $(this).find('.likescounter_');
        var counter = likescounter.text();
        var button = $(this);

        $.ajax({
            url: 'core/ajax_db/post_likes.php',
            method: 'POST',
            dataType: 'text',
            data: {
                like: comment_id,
                user_id: user_id,
            }, success: function (response) {
                likescounter.show();
                button.addClass('unlike-second-btn');
                button.removeClass('like-second-btn');
                counter++;
                likescounter.text(counter++);
                button.find('.fa-heart-o').addClass('fa-heart').css('color', 'red');
                button.find('.fa-heart').removeClass('fa-heart-o');

                // location.reload();

                console.log(response);
            }
        });
    });

    $(document).on('click', '.unlike-second-btn', function () {
        var comment_id = $(this).data('comment');
        var user_id = $(this).data('user');
        var likescounter = $(this).find('.likescounter_');
        var counter = likescounter.text();
        var button = $(this);

        $.ajax({
            url: 'core/ajax_db/post_likes.php',
            method: 'POST',
            dataType: 'text',
            data: {
                unlike: comment_id,
                user_id: user_id,
            }, success: function (response) {
                likescounter.show();
                button.addClass('like-second-btn');
                button.removeClass('unlike-second-btn');
                counter--;
                if (counter === 0) {
                    likescounter.hide();
                } else {
                    likescounter.text(counter--);
                }
                button.find('.fa-heart').addClass('fa-heart-o');
                button.find('.fa-heart-o').removeClass('fa-heart').css('color', 'red');

                console.log(response);
            }
        });
    });

    $(document).ready(function () {
        $(document).on('click', '.dislike-btn', function () {
            var comment_id = $(this).data('comment');
            var user_id = $(this).data('user');
            var likescounter = $(this).find('.dislikescounter');
            var counter = likescounter.text();
            var button = $(this);

            $.ajax({
                url: 'core/ajax_db/post_likes.php',
                method: 'POST',
                dataType: 'text',
                data: {
                    dislike: comment_id,
                    user_id: user_id,
                }, success: function (response) {
                    likescounter.show();
                    button.addClass('undislike-btn');
                    button.removeClass('dislike-btn');
                    counter++;
                    likescounter.text(counter++);
                    button.find('.fa-thumbs-o-down').addClass('.fa-thumbs-down').css('color', 'green');
                    button.find('.fa-thumbs-down').removeClass('.fa-thumbs-o-down');

                    // location.reload();

                    console.log(response);
                }
            });
        });
    });

    $(document).ready(function () {
        $(document).on('click', '.undislike-btn', function () {
            var comment_id = $(this).data('comment');
            var user_id = $(this).data('user');
            var likescounter = $(this).find('.dislikescounter');
            var counter = likescounter.text();
            var button = $(this);

            $.ajax({
                url: 'core/ajax_db/post_likes.php',
                method: 'POST',
                dataType: 'text',
                data: {
                    undislike: comment_id,
                    user_id: user_id,
                }, success: function (response) {
                    likescounter.show();
                    button.addClass('dislike-btn');
                    button.removeClass('undislike-btn');
                    counter--;
                    if (counter === 0) {
                        likescounter.hide();
                    } else {
                        likescounter.text(counter--);
                    }
                    button.find('.fa-thumbs-down').addClass('fa-thumbs-o-down').css('color', '#007bff');
                    button.find('.fa-thumbs-o-down').removeClass('fa-thumbs-down');

                    console.log(response);
                }
            });
        });
    });
});