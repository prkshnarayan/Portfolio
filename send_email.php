<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';  // This loads PHPMailer classes

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Setup PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();  // Use SMTP
        $mail->Host = 'smtp.gmail.com';  // Set the SMTP server to use
        $mail->SMTPAuth = true;         // Enable SMTP authentication
        $mail->Username = 'jayaprakashbommisetty2580@gmail.com'; // SMTP username (your email)
        $mail->Password = 'Prakash@2580';  // SMTP password (your email password or app password)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Encryption type (STARTTLS for Gmail)
        $mail->Port = 587; // SMTP port (587 for TLS, 465 for SSL)

        // Recipients
        $mail->setFrom('jayaprakashbommisetty2580@gmail.com', 'B Jaya Prakash');  // Sender's email and name
        $mail->addAddress('email', 'name'); // Add recipient

        // Content
        $mail->isHTML(true);
        $mail->Subject = "New Message from $name";
        $mail->Body    = "<b>Name:</b> $name<br><b>Email:</b> $email<br><b>Message:</b><br>$message";
        $mail->AltBody = "Name: $name\nEmail: $email\nMessage:\n$message"; // Plain text version of the email

        // Send the email
        if ($mail->send()) {
            echo "Message sent successfully!";
        } else {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
