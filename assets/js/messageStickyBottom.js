$(document).ready(function () {
    
    $(document).on('click', '.collapse-minus', function () {
        var getmessage = 1;

        $.ajax({
            url: 'core/ajax_db/messageStickybottom',
            method: 'POST',
            dataType: 'text',
            data: {
                showListMessage0: getmessage,
            }, success: function (response) {
                $("#collapseExample4").html(response);
                $("#messages").hide();
                $("#messages1").hide();
                $("#messages2").hide();
                // console.log(response);
            }
        });
    });


    $(document).on('click', '#direct-chat-contacts-view', function () {
        var getmessage = 1;

        $.ajax({
            url: 'core/ajax_db/messageStickybottom',
            method: 'POST',
            dataType: 'text',
            data: {
                showListMessage: getmessage,
            }, success: function (response) {
                $("#contacts0").html(response);
                $("#messages").hide();
                $("#messages1").hide();
                $("#messages2").hide();
                // console.log(response);
            }
        });
    });

    $(document).on('click', '.people-message1', function () {
        var get_id = $(this).data('user');

        $.ajax({
            url: 'core/ajax_db/messageStickybottom',
            method: 'POST',
            dataType: 'text',
            data: {
                showChat0: get_id,
            }, success: function (response) {
                $("#collapseExample4").html(response);

                if (autoscroll) {
                    scrolldown();
                }
                $('#chats1').on('scroll', function () {
                    if ($(this).scrollTop() < this.scrollHeight - $(this).height()) {
                        autoscroll = false;
                    } else {
                        autoscroll = true;
                    }
                    // console.log(response);
                });

                // console.log(response);

                $('.close-chat').click(function () {
                    clearInterval(timer);
                });
                $('.collapse-minus').click(function () {
                    clearInterval(timer);
                });
            }
        });

        getmessages = function () {
            $("#contacts0").fadeOut();

            $.ajax({
                url: 'core/ajax_db/messageStickybottom',
                method: 'POST',
                dataType: 'text',
                data: {
                    showChatMessage: get_id,
                }, success: function (response) {
                    $("#messages0").html(response);

                    if (autoscroll) {
                        scrolldown();
                    }
                    $('#chats').on('scroll', function () {
                        if ($(this).scrollTop() < this.scrollHeight - $(this).height()) {
                            autoscroll = false;
                        } else {
                            autoscroll = true;
                        }
                        // console.log(response);
                    });

                    $('.close-chat').click(function () {
                        clearInterval(timer);
                    });
                    $('.collapse-minus').click(function () {
                        clearInterval(timer);
                    });
                }
            });
        };

        var timer = setInterval(getmessages, 1000);
        getmessages();
        autoscroll = true;
        scrolldown = function () {
            $('#chats').scrollTop($('#chats').scrollHeight);
        };

        $("#direct-chat-contacts-view").on('click', function () {
            clearInterval(timer);
            $("#contacts0").fadeIn();
        });

        $(document).on('click', '.deleteMsg', function () {
            var message_id = $(this).data('message');
            $.ajax({
                url: 'core/ajax_db/messageStickybottom',
                method: 'POST',
                dataType: 'text',
                data: {
                    DeleteChatpopup: message_id,
                }, success: function (response) {
                    $('#message-del').html(response);
                    getmessages();
                    // console.log(response);
                }
            });
            
            $(document).on('click', '.cancel', function () {
                // $('.message-delt').hide();
                $('.alert-dismissible').hide();
            });

            $(document).on('click', '.delete', function () {

                $.ajax({
                    url: 'core/ajax_db/messageStickybottom',
                    method: 'POST',
                    dataType: 'text',
                    data: {
                        deleteMessage: message_id,
                    }, success: function (response) {
                        $('.message-delt').hide();
                        getmessages();
                        // console.log(response);
                    }
                });
            });

        });
    });

    $(document).on('keyup', '.search-user0', function () {
        $('.message-recent').hide();
        var searching = $(this).val();
        $.ajax({
            url: 'core/ajax_db/messageStickybottom',
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

    $(document).on('click', '#send0', function () {
        var message = $('#msg0').val();
        var get_id = $(this).data('user');

        $.ajax({
            url: 'core/ajax_db/messageStickybottom',
            method: 'POST',
            dataType: 'text',
            data: {
                sendMessage: message,
                get_idd: get_id,
            },
            success: function (response) {
                getmessages();
                $("#msg0").val('');
                // console.log(response);
            }
        });
    });

});