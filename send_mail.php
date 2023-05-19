<?php
$to = "zokj18@naver.com";
$subject = "Test email";
$message = "This is a test email.";
$headers = "From: zokj18@naver.com";

if (mail($to, $subject, $message, $headers)) {
    echo "Email sent successfully!";
} else {
    echo "Email sending failed.";
}
?>
