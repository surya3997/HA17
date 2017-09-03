$('.form').find('input, textarea').on('keyup blur focus', function(e) {
    var $this = $(this),
        label = $this.prev('label');
    if (e.type === 'keyup') {
        if ($this.val() == '') {
            label.removeClass('active highlight');
        } else {
            label.addClass('active highlight');
        }
    } else if (e.type === 'blur') {
        if ($this.val() == '') {
            label.removeClass('active highlight');
        } else {
            label.removeClass('highlight');
        }
    } else if (e.type === 'focus') {
        if ($this.val() == '') {
            label.removeClass('highlight');
        } else if ($this.val() != '') {
            label.addClass('highlight');
        }
    }
});

function InvokeCustomMessageDialog(message, customHandler) {
    $('#general-info-dialog-content').html(message);
    if (customHandler != undefined) { //Have to reset the dialog properties
        $('#general-info-dialog').dialog({
            close: customHandler
        });
    }
    $('#general-info-dialog').dialog("open");
}

$(document).ready(function() {
    setTimeout(function() {
        if ($('#email').val() == '') {
            $($('#email').prev('label')).removeClass('active highlight');
        } else if ($('#email').val() != '') {
            $($('#email').prev('label')).addClass('active highlight');
        }
        if ($('#code').val() == '') {
            $($('#code').prev('label')).removeClass('active highlight');
        } else if ($('#code').val() != '') {
            $($('#code').prev('label')).addClass('active highlight');
        }
    }, 100);

    $('#general-info-dialog').dialog({
        autoOpen: false,
        width: 450,
        height: 250,
        modal: true,
        buttons: [{
            text: "Ok",
            click: function() {
                $(this).dialog("close");
            }
        }]
    });

    document.getElementById('resend_form').onsubmit = function() {
        var username = $('#activ_name').val();
        var clg_code = $('#activ_code').val();

        $.post('ajax/resend_activation.php', { username: username, clg_code: clg_code }, function(response) {
            var jsonResult = JSON.parse(response);
            if (jsonResult.status == 'OK') {
                alert("Activation mail has been sent. Please check your Inbox and spam folders.")
                window.location = 'login.php';
            } else if (jsonResult.status == 'ILLEGAL') {
                alert('Your email id is already activated.')
                window.location = 'login.php';
            } else {
                alert("Invalid request.")
                $('#activ_name').val('');
                $('#activ_code').val('');
            }
        });

        return false;
    }
});