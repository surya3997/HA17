$('.form').find('input, textarea').on('keyup blur focus', function (e) {
	var $this = $(this),
	label = $this.prev('label');
	if (e.type === 'keyup') {
		if ($this.val() == '') {
			label.removeClass('active highlight');
		} else {
			label.addClass('active highlight');
		}
	} else if (e.type === 'blur') {
		if( $this.val() == '' ) {
			label.removeClass('active highlight'); 
		} else {
			label.removeClass('highlight');   
		}   
	} else if (e.type === 'focus') {
		if( $this.val() == '' ) {
			label.removeClass('highlight'); 
		} 
		else if( $this.val() != '' ) {
			label.addClass('highlight');
		}
	}
});

function InvokeCustomMessageDialog(message, customHandler) {
    $('#general-info-dialog-content').html(message);
    if(customHandler != undefined) { //Have to reset the dialog properties
        $('#general-info-dialog').dialog({
            close : customHandler
        });
    }
    $('#general-info-dialog').dialog("open");
}

$(document).ready(function() {
	setTimeout(function(){
		if( $('#email').val() == '' ) {
			$($('#email').prev('label')).removeClass('active highlight'); 
		} else if( $('#email').val() != '' ) {
			$($('#email').prev('label')).addClass('active highlight');
		}
		if( $('#code').val() == '' ) {
			$($('#code').prev('label')).removeClass('active highlight'); 
		} else if( $('#code').val() != '' ) {
			$($('#code').prev('label')).addClass('active highlight');
		}
	}, 100);
	
	$('#general-info-dialog').dialog({
        autoOpen: false,
        width: 450,
        height: 250,
        modal: true,
        buttons: [
            {
                text: "Ok",
                click: function() {
                    $( this ).dialog( "close" );
                }
            }
        ]
    });

	document.getElementById('loginForm').onsubmit = function() {
		var username = $('#loginForm :input[name=email]').val();
		var password = $('#loginForm :input[name=code]').val();

		$.post('ajax/resend_activation.php', { username : username, password : password }, function(response){
			var jsonResult = JSON.parse(response);
			if(jsonResult.status == 'OK')    {
				window.location = 'login.php';
			} else {
				InvokeCustomMessageDialog(jsonResult.status);
				$('#loginForm :input[name=email]').val('');
				$('#loginForm :input[name=code]').val('');
			}
		});

		return false;
	}
});