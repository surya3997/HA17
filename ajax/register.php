<?php
    include '../includes/config.php';

    $jsonMessage = array();

    if($session->isLoggedIn()) {
        $jsonMessage['status'] = 'Session_Exists';
        die(json_encode($jsonMessage));
    }

    $type = clean($_POST['type']);
    if($type == 'College') {
        $collegeCode = strtoupper(clean($_POST['collegeCode']));
        $sql = 'SELECT *
                    FROM '.DBT_COLLEGE_CODE.'
                    WHERE `code` = \''.$collegeCode.'\'';
        $query = $db->query($sql);
        if($db->numRows($query) != 0) {
            //This is invalid
            $jsonMessage['status'] = ENUM_STATUS_FAILED;
            $jsonMessage['message'] = 'Invalid College Code';
            die(json_encode($jsonMessage));
        }
        $db->freeResults($query);
        
        $type = '0';
    } else {
        $alumniCode = clean($_POST['alumniCode']);
        /* change this */
        if('log16alu' != strtolower($alumniCode)) {
            $jsonMessage['status'] = ENUM_STATUS_FAILED;
            $jsonMessage['message'] = 'Invalid Alumni Code';
            die(json_encode($jsonMessage));
        }
        $yearJoin = clean($_POST['yearJoin']);
        $course = clean($_POST['course']);
        $type = '1';
    }

    //Proceed with the registration
    $firstName = clean($_POST['firstName']);
    $lastName = clean($_POST['lastName']);
    $email = clean($_POST['email']);
    $password = clean($_POST['password']);
    $activationLink = sha1($firstName.$lastName.$email);
    $contact = clean($_POST['contact']);
    //Check Email
    $sql = 'SELECT `email` 
            FROM '.DBT_USER.'
            WHERE `email` = \''.$email.'\'';
    $query = $db->query($sql);
    if($db->numRows($query) > 0) {
        $jsonMessage['status'] = ENUM_STATUS_FAILED;
        $jsonMessage['message'] = 'Email ID Already exists.';
        die(json_encode($jsonMessage));
    }

    //All clear to register the user.
    $passwordHash = sha1($password);
    if($type == '0') {
        $sql = 'INSERT INTO '.DBT_USER.'(`name`, `pass`, `type`, `email`, `lname`, `code`, `activation_link`, `contact`)
                    VALUES '."('{$firstName}', '{$passwordHash}', '{$type}', '{$email}', '{$lastName}', '{$collegeCode}', '{$activationLink}', '{$contact}')";
    } else {
        $sql = 'INSERT INTO '.DBT_USER.'(`name`, `pass`, `type`, `email`, `lname`, `code`, `activation_link`, `course`, `year_join`, `contact`)
                    VALUES '."('{$firstName}', '{$passwordHash}', '{$type}', '{$email}', '{$lastName}', '{$alumniCode}', '{$activationLink}', '{$course}', '{$yearJoin}', '{$contact}')";
    }
    $query = $db->query($sql);
    if(!$query) {
        $jsonMessage['status'] = ENUM_STATUS_FAILED;
        $jsonMessage['message'] = 'Registration failed. Please try again after some time.';
        die(json_encode($jsonMessage));
    }

    //Send the activation mail to the user.
    $activationCodeSafe = urlencode($activationLink);
    $activationMailBody = "Hi {$firstName},<br />Thank you for Registering for Hack-a-Venture 2017. <br />To confirm your account click on the following link.<br /> <a href=\"http://hackaventure.psgtechlogin.in/ha/email_activation.php?email={$email}&verification_code={$activationCodeSafe}\">Email Verification</a>";
    $activationMailSender = new EmailSender($email, $activationMailBody);
    $activationMailSender->SendMail();

    $sql = 'SELECT `id` FROM '.DBT_USER.' WHERE LOWER(`email`) = LOWER(\''.$email.'\')';
    $query = $db->query($sql);
    $result = $db->result($query);
    $user_id = $result->id;

    //Create all the required data.
    //LevelCompletionManager::CreateInitSettings($user_id);

    //Send the Registration confirmation Mail. 
    $jsonMessage['status'] = ENUM_STATUS_OK;
    echo json_encode($jsonMessage);
?>