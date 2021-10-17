<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

$subject = "New ";
$subject .= htmlspecialchars($_POST["request"], ENT_QUOTES, 'UTF-8');

$body = "First Name: ".htmlspecialchars($_POST["first-name"], ENT_QUOTES, 'UTF-8')."\r\n";
$body .= "Last Name: ".htmlspecialchars($_POST["last-name"], ENT_QUOTES, 'UTF-8')."\r\n";
$body .= "Email Address: ".htmlspecialchars($_POST["email-address"], ENT_QUOTES, 'UTF-8')."\r\n";
$body .= "Phone Number: ".htmlspecialchars($_POST["phone-number"], ENT_QUOTES, 'UTF-8')."\r\n";

if ($_POST["request"] == "booking")
{
    $body .= "Booking Date: ".htmlspecialchars($_POST["booking-date"], ENT_QUOTES, 'UTF-8')."\r\n";
    $body .= "Booking Time: ".htmlspecialchars($_POST["booking-time"], ENT_QUOTES, 'UTF-8')."\r\n";
    $body .= "Number of People: ".htmlspecialchars($_POST["num-of-people"], ENT_QUOTES, 'UTF-8')."\r\n";
}
else
{
    $body .= "Subject: ".htmlspecialchars($_POST["subject"], ENT_QUOTES, 'UTF-8')."\r\n";
}   

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

$mail->isSMTP();
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'ssl';
$mail->Host = 'ssl://smtp.gmail.com';
$mail->Port = '465';
$mail->isHTML(false);
$mail->Username = 'noreply.jackseathouse@gmail.com';
$mail->Password = 'HackeyMcHackFace';
$mail->setFrom('noreply@jackseathouse.com');
$mail->Subject = htmlspecialchars_decode($subject, ENT_QUOTES);
$mail->Body = htmlspecialchars_decode($body, ENT_QUOTES);


//To get email address

require_once '../bootstrap.php';
require_once '../database.php';

$db = new Db(); 
$email = $db -> select("SELECT email FROM `email`");
$email = htmlspecialchars_decode($email[0]["email"], ENT_QUOTES);
$mail->AddAddress($email);
try
{
    $mail->send();
}
catch(Exception $e)
{
    echo "<script>alert('Problem with sending email: ".$e->getMessage()."');window.location.href='contact.php';</script>";
}

echo "<script>alert('Email successfully sent');window.location.href='contact.php';</script>";


?>