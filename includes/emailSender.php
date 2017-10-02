<?php 
include_once "phpmailer_folder/PHPMailer.php";
include_once "phpmailer_folder/SMTP.php";

use PHPMailer\PHPMailer\PHPMailer;

class EmailSender {
    private $mToId;
    private $mMailBody;

    public function __construct($toID, $mailBody) {
        $this->mToId = $toID;
        $this->mMailBody = $mailBody;
    }

    /** 
     * Method for sending mail using the provided information.
     */
    public function SendMail() {
        // Sanitize E-mail Address
        $email =filter_var($this->mToId, FILTER_SANITIZE_EMAIL);
        // Validate E-mail Address
        $email= filter_var($email, FILTER_VALIDATE_EMAIL);

        //Setup the SMTP data
        //Create a new PHPMailer instance
        $mail = new PHPMailer;

        //Tell PHPMailer to use SMTP
        $mail->isSMTP();

        //Enable SMTP debugging
        // 0 = off (for production use)
        // 1 = client messages
        // 2 = client and server messages
        $mail->SMTPDebug = 0;

        //Ask for HTML-friendly debug output
        //$mail->Debugoutput = 'html';

        //Set the hostname of the mail server
        $mail->Host = 'smtp.gmail.com';

        //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
        $mail->Port = 587;

        //Set the encryption system to use - ssl (deprecated) or tls
        $mail->SMTPSecure = 'tls';

        //Whether to use SMTP authentication
        $mail->SMTPAuth = true;

        /* Change the username and password */
        //Username to use for SMTP authentication - use full email address for gmail
        $mail->Username = "";

        //Password to use for SMTP authentication
        $mail->Password = "";

        //Set who the message is to be sent from
        $mail->setFrom('', 'PSG Login 2017 HA - Admin');

        //Set who the message is to be sent to
        $mail->addAddress($email);

        //Set the subject line
        $mail->Subject = 'Login 2017 HA Authentication.';

        //$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
        $mail->msgHTML('<html><body>'.$this->mMailBody.'</body></html>');

        //send the message, check for errors
        return $mail->send();
    }
}

?>
