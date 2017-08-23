/**
 * Simple function to check if the feild is empty or not.
 */
/* function CheckEmptyFields(fieldValue, fieldPattern, fieldName) {
    //Clear the last toast 
    // toastr.clear();
    if (jQuery.trim(fieldValue) == '') {
        // toastr.error(fieldName + ' is empty. Please fill that field.', 'Empty Field');
        console.log(fieldName + ' is empty. Please fill that field.', 'Empty Field');
        return false;
    }
    if (fieldPattern != '') {
        var matches = fieldValue.match(fieldPattern);
        if (matches == null) {
            // toastr.error(fieldName + ' does not conform to the given pattern.', 'Invalid Field');
            console.log(fieldName + ' does not conform to the given pattern.', 'Invalid Field');
            return false;
        }
        matches = matches[0];
        if (matches != fieldValue) {
            // toastr.error(fieldName + ' does not conform to the given pattern.', 'Invalid Field');
            console.log(fieldName + ' does not conform to the given pattern.', 'Invalid Field');
            return false;
        }
    }
    return true;
} */

/* change this */
function CheckEmptyFields(a, b, c) {
    return true;
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
        // toastr.error('Passwords dont match. Check again.', 'Password Mismatch');
        console.log('Passwords dont match. Check again.', 'Password Mismatch');
        return false;
    }

    //AJAX Confirm
    /* PlaySplashScreen(); */
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
        //HideSplashScreen();
        if (jsonData.status == EnumStatus.OK) {
            // toastr.info('Email Verification required. Please check your mail (also SPAM folders) for activation link.', 'Registration Successful');
            console.log('Email Verification required. Please check your mail (also SPAM folders) for activation link.', 'Registration Successful');
            setTimeout(function() {
                window.location = 'login.php';
            }, 3000);
        } else {
            // toastr.error(jsonData.message, 'Registration Error');
            console.log(jsonData.message, 'Registration Error');
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
        // toastr.error('Year of Graduation is not valid.', 'Invalid Year of Graduation');
        return false;
    }
    var email = $('#a_email').val();
    if (!CheckEmptyFields(email, '^([a-zA-Z0-9_.+-])+@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$', 'Email')) {
        return false;
    }
    var password = $('#a_passwd').val();
    var passwordCnf = $('#a_conf_passwd').val();
    if (password != passwordCnf) {
        // toastr.error('Passwords dont match. Check again.', 'Password Mismatch');
        return false;
    }

    console.log(alumniCode, firstName, lastName, course, contact, yearGrad, email, password, passwordCnf);

    //AJAX Confirm
    /* PlaySplashScreen(); */
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
        // HideSplashScreen();
        var jsonData = JSON.parse(data);
        if (jsonData.status == EnumStatus.OK) {
            // toastr.info('Email Verification required. Please check your mail (also SPAM folders) for activation link.<br /> <button onclick="window.location=\'login.php\';"> Close </button>', 'Registration Successful');
            alert('Email Verification required. Please check your mail', 'Registration Successful');
        } else {
            // toastr.error(jsonData.message, 'Registration Error');
            alert('Registration Error');
        }
    });
    return false;
}