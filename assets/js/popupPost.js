$(document).ready(function () {
    $(document).on('click','.t-show-popup',function () {
        var tweet_id= $(this).data('tweet');
          $.ajax({
                    url: 'core/ajax_db/popupPost.php',
                    method: 'POST',
                    dataType: 'text',
                    data: {
                        showpoptweet: tweet_id,
                    }, success: function (response) {
                        $(".popupTweet").html(response);
                        $(".tweet-show-popup-box-cut").click(function () {
                            $(".tweet-show-popup-wrap").hide();
                        });
                        console.log(response);
                    }
                });
    });

     $(document).on('click','.imagePopup',function (e) { 
         e.stopPropagation();
        var tweet_id= $(this).data('tweet');
          $.ajax({
              url: 'core/ajax_db/imagePopup.php',
                    method: 'POST',
                    dataType: 'text',
                    data: {
                        showpimage: tweet_id,
                    }, success: function (response) {
                        $(".popupTweet").html(response);
                        $(".close-imagePopup").click(function () {
                            $(".img-popup").hide();
                        });
                        console.log(response);
                    }
                });
     });
    
    $(document).on('click','.imageViewPopup',function (e) { 
         e.stopPropagation();
        var tweet_id= $(this).data('tweet');
          $.ajax({
              url: 'core/ajax_db/imageViewPopup.php',
                    method: 'POST',
                    dataType: 'text',
                    data: {
                        showpimage: tweet_id,
                    }, success: function (response) {
                        $(".popupTweet").html(response);
                        $(".close-imagePopup").click(function () {
                            $(".img-popup").hide();
                        });
                        console.log(response);
                    }
                });
         });
});