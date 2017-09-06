/**
 * Simple function to check if the feild is empty or not.
 */
function CheckEmptyFields(fieldValue, fieldPattern, fieldName) {
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


document.getElementById("collegeForm").onsubmit = function() {

    var collegeCode = $('#col_code').val();

    if (!CheckEmptyFields(collegeCode, '[a-zA-Z0-9]{8,8}', 'College Code')) {
        return false;
    }

    var firstName = $('#c_fname').val();
    if (!CheckEmptyFields(firstName, '[a-zA-Z ]{3,30}', 'First Name')) {
        return false;
    }
    var lastName = $('#c_lname').val();
    var contact = $('#c_contact').val();
    if (!CheckEmptyFields(contact, '[0-9]*', 'Contact Number')) {
        return false;
    }
    var email = $('#c_email').val();
    if (!CheckEmptyFields(email, '^([a-zA-Z0-9_.+-])+@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$', 'Email')) {
        return false;
    }
    var password = $('#c_passwd').val();
    var passwordCnf = $('#c_conf_passwd').val();
    if (password != passwordCnf) {
        alert('Passwords dont match. Check again.', 'Password Mismatch');
        return false;
    }


    //AJAX Confirm
    Play_splash();
    $.post('ajax/register.php', {
        type: 'College',
        collegeCode: collegeCode,
        firstName: firstName,
        lastName: lastName,
        email: email,
        password: password,
        contact: contact
    }, function(data) {
        var jsonData = JSON.parse(data);
        Stop_splash();
        if (jsonData.status == EnumStatus.OK) {
            //alert('Email Verification required. Please check your mail (also SPAM folders) for activation link.', 'Registration Successful');
            setTimeout(function() {
                window.location = 'login.php';
            }, 3000);
        } else {
            alert(jsonData.message, 'Registration Error');
        }
    });
    return false;
}

/**
 * Validate and submit the form using AJAX. [Alumni]
 */
document.getElementById('alumniForm').onsubmit = function() {
    var alumniCode = $('#alu_code').val();
    if (!CheckEmptyFields(alumniCode, '[a-zA-Z0-9]{8,8}', 'Alumni Code')) {
        return false;
    }
    var firstName = $('#a_fname').val();
    if (!CheckEmptyFields(firstName, '[a-zA-Z ]{3,30}', 'First Name')) {
        return false;
    }
    var contact = $('#a_contact').val();
    if (!CheckEmptyFields(contact, '[0-9]*', 'Contact Number')) {
        return false;
    }
    var lastName = $('#a_lname').val();
    var course = $('#course').val();
    var yearGrad = $('#year').val();
    if (yearGrad < 1983 || yearGrad > 2017) {
        return false;
    }
    var email = $('#a_email').val();
    if (!CheckEmptyFields(email, '^([a-zA-Z0-9_.+-])+@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$', 'Email')) {
        return false;
    }
    var password = $('#a_passwd').val();
    var passwordCnf = $('#a_conf_passwd').val();
    if (password != passwordCnf) {
        return false;
    }


    //AJAX Confirm
    Play_splash();
    $.post('ajax/register.php', {
        type: 'Alumni',
        alumniCode: alumniCode,
        firstName: firstName,
        lastName: lastName,
        email: email,
        password: password,
        course: course,
        yearJoin: yearGrad,
        contact: contact
    }, function(data) {
        Stop_splash();
        var jsonData = JSON.parse(data);
        if (jsonData.status == EnumStatus.OK) {
            //alert('Email Verification required. Please check your Inbox and spam folders');
            setTimeout(function() {
                window.location = 'login.php';
            }, 3000);
        } else {
            alert('Registration Error');
        }
    });
    return false;
}