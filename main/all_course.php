<?php

// phpinfo();

// ini_set('SMTP', "smtp.gmail.com");
// ini_set('smtp_port', "25");
// ini_set('sendmail_from', "parthb401@gmail.com");

$to_email = "parthb401@gmail.com";
$subject = "Simple Email Test via PHP";
$body = "Hi, This is test email send by PHP Script";
$headers = "From: parthb401@gmail.com";

if (mail($to_email, $subject, $body, $headers)) {
    echo "Email successfully sent to $to_email...";
} else {
    echo "Email sending failed...";
}
