<?php
use PHPMailer\PHPMailer\PHPMailer;
require_once 'phpMailer/PHPMailer.php';
require_once 'phpMailer/SMTP.php';
require_once 'phpMailer/Exception.php';

// use PHPMailer\PHPMailer\SMTP;
// use PHPMailer\PHPMailer\Exception;

class Mailer {
    private $mail;
    private $smtp_sender = SMTP_SENDER;
    private $smtp_host   = SMTP_HOST;
    private $smtp_port   = SMTP_PORT;
    private $smtp_pass   = SMTP_PASS;
    private $smtp_name   = SMTP_NAME;
    public function __construct() {
        $this->mail = new PHPMailer();
        $this->mail->isSMTP();
        $this->mail->Host = $this->smtp_host;
        $this->mail->SMTPAuth = true;
        $this->mail->SMTPSecure = "ssl";
        $this->mail->Port = $this->smtp_port;
        $this->mail->Username = $this->smtp_sender;
        $this->mail->Password = $this->smtp_pass;
    }
    public function sendMail($subject, $body, $reciever) {
        $this->mail->isHtml();
        $this->mail->Subject = $subject;
        $this->mail->setFrom($this->smtp_sender,$this->smtp_name);
        $this->mail->Body =  $body;
        
        $this->mail->addAddress($reciever);
        $this->mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        try{
            if($this->mail->send()) {
              return true;
            }else {
                echo $this->mail->ErrorInfo;
            }
        }catch(Exception $e) {
            echo $e;die;
        }
        $this->mail->smtpClose();
    }
}