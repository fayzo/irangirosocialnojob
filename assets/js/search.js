$(document).ready(function() {
    $('.search').keyup(function () {
        var searcher = $(this).val();
         $.ajax({
                    url: 'core/ajax_db/search',
                    method: 'POST',
                    dataType: 'text',
                    data: {
                        search: searcher,
                    }, success: function (response) {
                        $(".search-result").html(response);
                        // // console.log(response);
                    }
                });
    });

    $(document).on('keyup', '.search-user', function () {
        $('.message-recent').hide();
        var searching = $(this).val();
        $.ajax({
            url: 'core/ajax_db/searchUserInMeassage',
            method: 'POST',
            dataType: 'text',
            data: {
                search: searching,
            }, success: function (response) {
                $(".message-body").html(response);
                // console.log(response);
            }
        });
    });

    $('.search-siderbar').keyup(function () {
        var searcher = $(this).val();
         $.ajax({
                    url: 'core/ajax_db/search-siderbar',
                    method: 'POST',
                    dataType: 'text',
                    data: {
                        search: searcher,
                    }, success: function (response) {
                        $(".search-result-siderbar").html(response);
                        // // console.log(response);
                    }
                });
    });

   
});