$(document).ready(function() {
  $(document).on('click','.follow-btn',function() {
      var follow_id = $(this).data('follow');
      var profile_id = $(this).data('profile');
      var button = $(this);
      if (button.hasClass('following-btn')) {

             $.ajax({
                    url: 'core/ajax_db/follow.php',
                    method: 'POST',
                    dataType: 'text',
                    data: {
                        unfollow: follow_id,
                        profile: profile_id,
                    }, success: function (response) {
                        response = JSON.parse(response);
                        button.removeClass('following-btn');
                        button.removeClass('unfollow-btn');
                        button.html('<i class="fa fa-user-plus"></i> Follow');
                        $('.count-following').text(response.following);
                        $('.count-followers').text(response.followers);

                        // console.log(response);
                        // console.log(response.following);
                        // console.log(response.followers);
                    }
                });
          
      }else{

            $.ajax({
                    url: 'core/ajax_db/follow.php',
                    method: 'POST',
                    dataType: 'text',
                    data: {
                        follow: follow_id,
                        profile: profile_id,

                    }, success: function (response) {
                        response = JSON.parse(response);
                        button.removeClass('follow-btn');
                        button.addClass('following-btn');
                        button.text('Following').css('color', 'white').css('background-color', '#007bff').css('border', '1px solid #007bff').css('outline', 'none');
                        $('.count-following').text(response.following);
                        $('.count-followers').text(response.followers);

                        // console.log(response);
                        // console.log(response.following);
                        // console.log(response.followers);
                    }
                });
      }
  });
  $('.follow-btn').hover(function () {
      var button= $(this);
      if (button.hasClass('following-btn')) {
          button.addClass('unfollow-btn');
          button.text('Unfollow').css('color', 'white').css('background-color', '#545b62').css('border', ' 1px solid #545b62').css('outline', 'none');
      }
      
  }, function () {
          var button = $(this);
       if (button.hasClass('following-btn')) {
          button.removeClass('unfollow-btn');
          button.text('Following').css('background-color', '#007bff').css('border', '1px solid #007bff').css('outline', 'none');
      }
  });
});