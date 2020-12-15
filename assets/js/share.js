$(document).ready(function() {
  $(document).on('click','.retweet',function() {
       $tweet_id= $(this).data('tweet');
       $tweet_by= $(this).data('user');
       $counter= $(this).find('.retweetcounter');
       $count= $counter.text();
       $button= $(this);

         $.ajax({
                    url: 'core/ajax_db/share.php',
                    method: 'POST',
                    dataType: 'text',
                    data: {
                        showpopretweet: $tweet_id,
                        tweet_By: $tweet_by,
                    }, success: function (response) {
                        $('.popupTweet').html(response);
                        $('.close-retweet-popup').click(function() {
                             $('.retweet-popup').hide();
                        });

                        console.log(response);
                    }
                });
      });

    $(document).on('click','.retweet-it',function() {
       $comment = $('.retweetMsg').val();

         $.ajax({
                    url: 'core/ajax_db/share.php',
                    method: 'POST',
                    dataType: 'text',
                    data: {
                        retweet: $tweet_id,
                        tweet_By: $tweet_by,
                        comments: $comment
                    }, success: function (response) {
                        $('.retweet-popup').hide();
                        $count++;
                        $counter.text($count++);
                        $button.removeClass('.retweet').addClass('.retweeted');

                        console.log(response);
                    }
                });
      });
});
