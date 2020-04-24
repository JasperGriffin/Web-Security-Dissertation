<?php

  require "includes/PHPMailer.php";
  require "includes/SMTP.php";
  require "includes/Exception.php";
  //include "../mvc/views/user-view.php";

  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\SMTP;
  use PHPMailer\PHPMailer\Exception;

  class mail {

    public function sendEmail($token, $username, $email, $ip) {

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

        $view = new user_view();
        $message = $view->sendMessage($token, $username, $ip);

        $mail->isHTML(true);
        $mail->Subject = 'Jaspergriffin.com [DO NOT REPLY]';
        $mail->Body    = $message;

        $mail->setFrom("jaspergriffinjsg@hotmail.co.uk", "Jasper Griffin");
        $mail->addAddress($email);      //user email

        $mail->Send();

        $mail->smtpClose();

        return true;

      } catch (Exception $e) {
        echo "Email couldn't be sent. Mailer Error: {$mail->ErrorInfo}";
        header("Location: ../account/login.php?mail_server_disconnected");
      }
    }

  }

?>
