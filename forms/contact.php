<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
   // Collect input data
   $name = htmlspecialchars(trim($_POST['name']));
   $email = htmlspecialchars(trim($_POST['email']));
   $subject = htmlspecialchars(trim($_POST['subject']));
   $message = htmlspecialchars(trim($_POST['message']));

   // Validate input data
   if (!empty($name) && !empty($email) && !empty($subject) && !empty($message) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
       
       // Initialize PHPMailer
       $mail = new PHPMailer(true);
       
       try {
           // Server settings
           $mail->isSMTP();
           $mail->Host       = 'smtp.gmail.com';
           $mail->SMTPAuth   = true;
           $mail->Username   = 'mikro.inquiry@gmail.com'; // Replace with your Gmail address
           $mail->Password   = 'lwkwddhxqwnuhrgj'; // Replace with your Gmail app password
           $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
           $mail->Port       = 587;
       
           // Recipients
           $mail->setFrom($email, $name);
           $mail->addAddress('mikro.inquiry@gmail.com');
       
           // Content
           $mail->isHTML(false);
           $mail->Subject = $subject;
           $mail->Body    = "Name: $name\nEmail: $email\n\nMessage:\n$message";
       
           // Send email
           $mail->send();
           echo "Your message has been sent. Thank you!";
       } catch (Exception $e) {
           echo "ERROR: There was an error sending your message. Please try again later. Error: {$mail->ErrorInfo}";
       }
       
   } else {
       echo "ERROR: Please fill in all fields correctly.";
   }
} else {
   echo "ERROR: Invalid request method.";
}
?>
