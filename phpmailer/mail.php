<?php

  require "includes/PHPMailer.php";
  require "includes/SMTP.php";
  require "includes/Exception.php";

  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\SMTP;
  use PHPMailer\PHPMailer\Exception;

  class mail {

    public function sendEmail($token, $email) {

      $mail = new PHPMailer(true);

      //make as function instead
      try {

        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.office365.com';                    // Set the SMTP server to send through
        $mail->SMTPAuth   = true;
        $mail->Username   = 'jaspergriffinjsg@hotmail.co.uk';                     // SMTP username
        $mail->Password   = 'lkJmjj1466!';                               // SMTP password
        $mail->SMTPSecure = "tls";         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        $mail->isHTML(true);
        $mail->Subject = 'Jaspergriffin.com [DO NOT REPLY]';
        $mail->Body    = 'This is the HTML message body <b>in bold!</b><br>'.$token;

        $mail->setFrom("jaspergriffinjsg@hotmail.co.uk", "Jasper Griffin");
        $mail->addAddress($email);      //user email

        $mail->Send();

        $mail->smtpClose();

      } catch (Exception $e) {
        echo "Email couldn't be sent. Mailer Error: {$mail->ErrorInfo}";
      }
    }

  }

?>
