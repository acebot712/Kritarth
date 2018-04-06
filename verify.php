<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Verify</title>
  </head>
  <body>
    <?php

    if($_SERVER["REQUEST_METHOD"] == "POST"){

      $code=md5(mt_rand());


        require_once('PHPMailer/PHPMailerAutoload.php');
        require_once('PHPMailer/class.phpmailer.php');
        require_once('PHPMailer/class.smtp.php');


        $mail = new PHPMailer;
        $mail->isSMTP();/*Set mailer to use SMTP*/
        $mail->Host = "smtp.mandrillapp.com"; // sets the SMTP server
        $mail->Port = 587;
        //$mail->AuthType = 'LOGIN';
        $mail->SMTPAuth = true;/*Enable SMTP authentication*/
        $mail->Username = "Kritarth"; // SMTP account username
        $mail->Password = "UQPuunKrJPNZbwUxYKJ_EQ";        // SMTP account password
        $mail->SMTPDebug=1;
        //$mail->SMTPSecure = 'tls';/*Enable encryption, 'ssl' also accepted*/
        $mail->SetFrom('web@kritarth.org');
        $mail->addAddress($useremail);/*Add a recipient*/
        $mail->isHTML(true);/*Set email format to HTML (default = true)*/
        $mail->Subject = 'Verify Your Account';
        $body    = 'www.kritarth.org/activate.php?code='$code'';

        $mail->MsgHTML($body);
        if(!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
          echo 'Mail Sent';
            //header("Location: ../docs/confirmSubmit.html");
        }


}
    ?>
    <form class="" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
      <input type="hidden" name="name" value="123" />
      <button type="submit" name="button" onclick="">send</button>
    </form>
  </body>
</html>
