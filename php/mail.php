<?php

    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    $mail = new PHPMailer(true);

    try {
        $mail->SMTPDebug = SMTP::DEBUG_SERVER; // for detailed debug output
        $mail->SMTPDebug= false;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->Username = $_ENV['EMAIL']; 
        $mail->Password = $_ENV['PASSWORD'];

        $mail->setFrom($_ENV['EMAIL'], 'Hackers Poulette');
        $mail->addAddress($_ENV['EMAIL'], $_ENV['FIRSTNAME'] . $_ENV['LASTNAME']);

        $mail->Subject = $user['subject'];
        $mail->Body = $body;

        $mail->send();
        echo "Email message sent.";
    } catch (Exception $e) {
        echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";

    }

?>