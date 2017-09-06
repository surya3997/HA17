<?php
    include '../includes/config.php';

    $jsonMessage = array();

    $email = strtolower(clean($_POST['username']));
    $code = strtolower(clean($_POST['clg_code']));

    $sql = 'SELECT `activation_link`, `name` 
            FROM '.DBT_USER.'
            WHERE LOWER(`email`) = \''.$email.'\'
                AND LOWER(`code`) = \''.$code.'\'';
    $query = $db->query($sql);
    
    if($db->numRows($query) > 0) {

        $result = $db->result($query);
        if($result->activation_link == '') {
            //Already activated.
            die(json_encode(array('status' => ENUM_STATUS_ILLEGAL)));    
        }
        //Send the activation mail to the user.
        $activationCodeSafe = urlencode($result->activation_link);
        $firstName = urlencode($result->name);
        $activationMailBody = "Hi {$firstName},<br />Thank you for registering in Hack-a-Venture 2017. <br />To confirm your account click on the following link.<br /> <a href=\"http://www.hackaventure.ga/HA17/email_activation.php?email={$email}&verification_code={$activationCodeSafe}\">Email Verification</a>";
        $activationMailSender = new EmailSender($email, $activationMailBody);
        $activationMailSender->SendMail();
        die(json_encode(array('status' => ENUM_STATUS_OK)));
    } else {
        die(json_encode(array('status' => ENUM_STATUS_FAILED)));
    }
?>
