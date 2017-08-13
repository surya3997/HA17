<?php 

include_once 'phpmailer_folder/PHPMailerAutoload.php';

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

        //Username to use for SMTP authentication - use full email address for gmail
        $mail->Username = "hackaventure2k17@gmail.com";

        //Password to use for SMTP authentication
        $mail->Password = "HackMeIfYouCan";

        //Set who the message is to be sent from
        $mail->setFrom('hackaventure2k17@gmail.com', 'HackArena - Admin');

        //Set who the message is to be sent to
        $mail->addAddress($email);

        //Set the subject line
        $mail->Subject = 'HackArena Authentication.';

        //$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
        $mail->msgHTML('<html><body>'.$this->mMailBody.'</body></html>');

        //send the message, check for errors
        return $mail->send();
    }
}

?>