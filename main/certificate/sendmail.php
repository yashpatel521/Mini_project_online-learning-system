<?php

$to_mail = "Yash1451999@gmail.com";
$sub = "SMTP mail";
$body = "smpt sended mail";
$from = "From: parthb401@gmail.com";

if(mail($to_mail, $sub, $body, $from)){
	echo "send to $to_mail";
}
else{
	echo "fail";
}

?>