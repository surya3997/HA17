/**
 * Simple function to check if the feild is empty or not.
 */
function CheckEmptyFields(fieldValue, fieldPattern, fieldName) {
    if (fieldName == 'Secret Code') {
        if (jQuery.trim(fieldValue) == '') {
            return false;
        }
        return true;
    }

    if (jQuery.trim(fieldValue) == '') {
        alert(fieldName + ' is empty. Please fill that field.', 'Empty Field');
        return false;
    }
    if (fieldPattern != '') {
        var matches = fieldValue.match(fieldPattern);
        if (matches == null) {
            alert(fieldName + ' does not conform to the given pattern.', 'Invalid Field');
            return false;
        }
        matches = matches[0];
        if (matches != fieldValue) {
            alert(fieldName + ' does not conform to the given pattern.', 'Invalid Field');
            return false;
        }
    }
    return true;
}

function Play_splash() {
    preload = document.getElementById("preload_splash");
    loading = 0;
    preload.style.animation = "";
    preload.style.display = "block";

    id = setInterval(frame, 64);

    function frame() {
        if (loading == 100) {
            Stop_splash();

        } else if (loading < 100) {
            loading = loading + 1;
            if (loading == 90) {
                Fade_splash()
            }
        }
    }
}

function Fade_splash() {
    preload.style.animation = "fadeout 1s ease";
    loading = 90;
}

function Stop_splash() {
    preload.style.display = "none";
    clearInterval(id);
}


document.getElementById("collegeForm").onsubmit = function(event) {
    var secretCode = $('#col_code').val();
    event.preventDefault();

    if (!CheckEmptyFields(secretCode, '[a-zA-Z0-9]', 'Secret Code')) {
        alert("Invalid Secret code");
        return false;
    }

    var email = $('#c_email').val();
    if (!CheckEmptyFields(email, '^([a-zA-Z0-9_.+-])+@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$', 'Email')) {
        alert("Invalid E-mail id");
        return false;
    }
    var password = $('#c_passwd').val();
    var passwordCnf = $('#c_conf_passwd').val();
    if (password != passwordCnf) {
        alert('Passwords dont match. Check again.');
        return false;
    }


    //AJAX Confirm
    Play_splash();
    $.post('https://hack-a-venture.psglogin.in/ajax/register1.php', {
        code: secretCode,
        email: email,
        password: password
    }, function(data) {
        //alert("got some response");
        var jsonData = JSON.parse(data);
        Stop_splash();
	console.log(jsonData);
        if (jsonData.status == 'Ok') {
            setTimeout(function() {
                window.location = 'login.php';
            }, 2000);
        } else {
            console.log('Registration Error');
            alert(jsonData.message);
	}
    });
}

$("#noScroller").css("overflow-y", "hidden");
$("#reg_col_btn").css("width", "100%");
$("#noScroller").css("padding-right", "0px");
$(".reg-html").css("height", "92%");
$("#details_label").css("margin-left", "30%");
