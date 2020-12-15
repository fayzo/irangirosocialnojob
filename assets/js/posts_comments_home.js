$(document).ready(function () {

    $(document).on('click','#post_HomeComment',function () {
        var tweet_id = $(this).data('tweet');
        var comment = $('#commentHome' + tweet_id).val();
        // var tweet_id = $('#commentHome').data('tweet');
        // var comment = $('#commentHome').val();

        if (comment != "") {
              $.ajax({
                    url: 'core/ajax_db/posts_comments.php',
                    method: 'POST',
                    dataType: 'text',
                    data: {
                        comments: comment,
                        tweet_id: tweet_id,
                    }, success: function (response) {
                        $('#commentsHome' + tweet_id).html(response);
                        $('#commentHome' + tweet_id).val("");
                        console.log(response);
                    }
                });
        }

    });

    $(document).on('click','#post_HomeCommentSecond',function () {
        var comment_id = $(this).data('comment');
        var comment = $('#commentHomeSecond' + comment_id).val();
        // var tweet_id = $('#commentHome').data('tweet');
        // var comment = $('#commentHome').val();

        if (comment != "") {
              $.ajax({
                    url: 'core/ajax_db/posts_comments.php',
                    method: 'POST',
                    dataType: 'text',
                    data: {
                        comments_: comment,
                        comment_id: comment_id,
                    }, success: function (response) {
                        $('#commentsHomeSecond' + comment_id).html(response);
                        $('#commentHomeSecond' + comment_id).val("");
                        console.log(response);
                    }
                });
        }

    });
});

// function myFunction() {
//     $("input[id^='commentHome']").attr('id', '');
//     $("span[id^='commentsHome']").attr('id', '');
// }

// function keyupFunction() {
//    $('.form-control').on('keyup',function(){
//        $(this).attr('id', 'commentHome');
//        $('.commentsHome').attr('id', 'commentsHome');
//     });
// }
