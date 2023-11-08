

<?php
    // Import PHPMailer classes into the global namespace
    // These must be at the top of your script, not inside a function
    require 'vendor/phpmailer/phpmailer/src/Exception.php';
    require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
    require 'vendor/phpmailer/phpmailer/src/SMTP.php';
    require 'vendor/autoload.php';
    
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    Dotenv\Dotenv::createImmutable(__DIR__)->load();

    // Dotenv\Dotenv::createUnsafeImmutable(__DIR__)->load();

    echo $_ENV['EMAIL'];
    
    // echo $dotenv;


    $mail = new PHPMailer(true);
    try {
        $mail->SMTPDebug = SMTP::DEBUG_SERVER; // for detailed debug output
        $mail->SMTPDebug= false;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // $mail->Username = $_ENV['EMAIL']; // YOUR gmail email
        $mail->Username = 'my Gmail address'; // YOUR gmail email
        $mail->Password = 'My password';

        $mail->setFrom('my Gmail address', 'Hackers Poulette');
        $mail->addAddress('my Gmail address', 'Carole Gerard');

        // $mail->Subject = 'Hackers Poulette';
        $mail->Subject = $user['subject'];
        $mail->Body = $body;

        $mail->send();
        echo "Email message sent.";
    } catch (Exception $e) {
        echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";

    }

?>