back_flag = 0;
console.log(back_flag);

function closeChat(option) {
    if (option == 1) {
        $('.msg_box').hide();
    } else {
        $('.msg_box1').hide();
    }
    back_flag = 0;
}

$(document).ready(function() {
    $("#cl1").click(function() {
        closeChat(1);
        console.log(back_flag);
    });
    $("#cl2").click(function() {
        closeChat(2);
        console.log(back_flag);
    });
    $(".user").click(function() {
        $('.msg_wrap').show();
        $('.msg_box').show();
        back_flag = 1;
        console.log(back_flag);
    });
    $(".user1").click(function() {
        $('.msg_wrap1').show();
        $('.msg_box1').show();
        back_flag = 2;
        console.log(back_flag);
    });
    $('#t').keypress(
        function(e) {
            if (e.keyCode == 13) {
                var msg = $(this).val();
                console.log(msg);
                $(this).val('');
                if (msg != '\n') {
                    $("<div class='msg_b'>" + msg + "</div>").insertBefore('.msg_insert');
                    $('.msg_body').scrollTop($('.msg_body')[0].scrollHeight);
                }
            }
        });
    $('#s').keypress(
        function(e) {
            if (e.keyCode == 13) {
                var msg = $(this).val();
                console.log(msg);
                $(this).val('');
                if (msg != '\n') {
                    $("<div class='msg_b'>" + msg + "</div>").insertBefore('.msg_insert1');
                    $('.msg_body1').scrollTop($('.msg_body1')[0].scrollHeight);
                    $("<div class='msg_a1'>There is no time for rubbish talk. Proceed with your work.</div>").insertBefore('.msg_insert1');
                }
            }
        });
});