back_flag = 0;

function closeChat(option) {
    if (option == 1) {
        $('.msg_box').hide();
    } else {
        $('.msg_box1').hide();
    }
    back_flag = 0;
}

function openHelpDesk() {
    $('.msg_wrap').show();
    $('.msg_box').show();
    back_flag = 1;
    $.post('ajax/getResponses.php', {}, function(resp) {
        var data = JSON.parse(resp);
        console.log(data);
        for (var i = 0; i < data.query.length; i++) {
            $("<div class='msg_b'>SOMEONE ASKED : " + data.query[i] + "</div>").insertBefore('.msg_insert');
            $('.msg_body').scrollTop($('.msg_body')[0].scrollHeight);
            $("<div class='msg_a'>OUR RESPONSE : " + data.response[i] + "</div>").insertBefore('.msg_insert');
            $('.msg_body').scrollTop($('.msg_body')[0].scrollHeight);
        }
    });
}

function openMillionaire() {
    $('.msg_wrap1').show();
    $('.msg_box1').show();
    back_flag = 2;
}

$(document).ready(function() {
    $("#cl1").click(function() {
        closeChat(1);
    });
    $("#cl2").click(function() {
        closeChat(2);
    });
    $(".user").click(function() {
        openHelpDesk();
    });
    $(".user1").click(function() {
        openMillionaire();
    });
    $('#t').keypress(
        function(e) {
            if (e.keyCode == 13) {
                var msg = $(this).val();
                $(this).val('');
                if (msg != '\n' && msg.length > 10) {
                    $("<div class='msg_b'>" + msg + "</div>").insertBefore('.msg_insert');
                    $('.msg_body').scrollTop($('.msg_body')[0].scrollHeight);
                    $.post('ajax/insertQuery.php', {
                        query: msg
                    }, function(data) {
                        var jsonData = JSON.parse(data);
                        if (jsonData.status == "Fail") {
                            alert("Message insertion failed.");
                        } else {
                            alert("Message inserted. Wait for response.");
                        }
                    });
                }
            }
        });
    $('#s').keypress(
        function(e) {
            if (e.keyCode == 13) {
                var msg = $(this).val();
                $(this).val('');
                if (msg != '\n') {
                    $("<div class='msg_b'>" + msg + "</div>").insertBefore('.msg_insert1');
                    $('.msg_body1').scrollTop($('.msg_body1')[0].scrollHeight);
                    $("<div class='msg_a1'>There is no time for rubbish talk. Proceed with your work.</div>").insertBefore('.msg_insert1');
                }
            }
        });


});

setTimeout(function() { OpenPhone(); }, 1500);
setTimeout(function() { chat(); }, 2700);
setTimeout(function() { openMillionaire(); }, 3500);