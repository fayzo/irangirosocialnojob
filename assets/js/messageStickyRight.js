$(document).ready(function () {

    $(document).on('click', '.collapse-minus1', function () {
        var getmessage = 1;
    
        $.ajax({
            url: 'core/ajax_db/messageStickybottom.php',
            method: 'POST',
            dataType: 'text',
            data: {
                showListMessage1: getmessage,
            }, success: function (response) {
                $("#collapseExample").html(response);
                $("#messages").hide();
                $("#messages1").hide();
                $("#messages2").hide();
                console.log(response);
            }
        });
    });
    
    $(document).on('click', '#direct-chat-contacts-view1', function () {
        var getmessage = 1;

        $.ajax({
            url: 'core/ajax_db/messageStickybottom.php',
            method: 'POST',
            dataType: 'text',
            data: {
                showListMessage2: getmessage,
            }, success: function (response) {
                $("#contacts").html(response);
                $("#messages").hide();
                $("#messages1").hide();
                $("#messages2").hide();
                console.log(response);
            }
        });
    });

    $(document).on('click', '.people-message2', function () {
        var get_id = $(this).data('user');
        // $("#contacts").fadeOut();

        $.ajax({
            url: 'core/ajax_db/messageStickybottom.php',
            method: 'POST',
            dataType: 'text',
            data: {
                showChat: get_id,
            }, success: function (response) {
                $("#collapseExample").html(response);

                if (autoscroll) {
                    scrolldown();
                }
                $('#chats1').on('scroll', function () {
                    if ($(this).scrollTop() < this.scrollHeight - $(this).height()) {
                        autoscroll = false;
                    } else {
                        autoscroll = true;
                    }
                    console.log(response);
                });

                console.log(response);
                $('.close-chat1').click(function () {
                    clearInterval(timer);
                });
                $('.collapse-minus1').click(function () {
                    clearInterval(timer);
                });
            }
        });

        getmessages = function () {
        $("#contacts").fadeOut();

            $.ajax({
                url: 'core/ajax_db/messageStickybottom.php',
                method: 'POST',
                dataType: 'text',
                data: {
                    showChatMessage1: get_id,
                }, success: function (response) {
                    $("#message").html(response);

                    if (autoscroll) {
                        scrolldown();
                    }
                    $('#chats1').on('scroll', function () {
                        if ($(this).scrollTop() < this.scrollHeight - $(this).height()) {
                            autoscroll = false;
                        } else {
                            autoscroll = true;
                        }
                        console.log(response);
                    });

                    $('.close-chat1').click(function () {
                        clearInterval(timer);
                    });

                    $('.collapse-minus1').click(function () {
                        clearInterval(timer);
                    });
                }
            });
        };

        var timer = setInterval(getmessages, 1000);
        getmessages();
        autoscroll = true;
        scrolldown = function () {
            $('#chats1').scrollTop($('#chats1').scrollHeight);
        };

        $("#direct-chat-contacts-view1").on('click', function () {
            clearInterval(timer);
            $("#contacts").fadeIn();
        });

        $(document).on('click', '.deleteMsg', function () {
            var message_id = $(this).data('message');
            $.ajax({
                url: 'core/ajax_db/messageStickybottom.php',
                method: 'POST',
                dataType: 'text',
                data: {
                    DeleteChatpopup: message_id,
                }, success: function (response) {
                    $('#message-del1').html(response);
                    getmessages();
                    console.log(response);
                }
            });

            $(document).on('click', '.delete', function () {

                $.ajax({
                    url: 'core/ajax_db/messageStickybottom.php',
                    method: 'POST',
                    dataType: 'text',
                    data: {
                        deleteMessage: message_id,
                    }, success: function (response) {
                        $('.message-delt').hide();
                        getmessages();
                        console.log(response);
                    }
                });
            });

        });
    });

    $(document).on('keyup', '.search-user1', function () {
        $('.message-recent').hide();
        var searching = $(this).val();
        $.ajax({
            url: 'core/ajax_db/messageStickybottom.php',
            method: 'POST',
            dataType: 'text',
            data: {
                search1: searching,
            }, success: function (response) {
                $(".message-body").html(response);
                console.log(response);
            }
        });
    });

    $(document).on('click', '#send1', function () {
        var message = $('#msg1').val();
        var get_id = $(this).data('user');

        $.ajax({
            url: 'core/ajax_db/messageStickybottom.php',
            method: 'POST',
            dataType: 'text',
            data: {
                sendMessage: message,
                get_idd: get_id,
            },
            success: function (response) {
                getmessages();
                $("#msg").val('');
                console.log(response);
            }
        });
    });

});
