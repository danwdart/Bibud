<?php
$email="da.ndart@googlemail.com";
$subject="Bibud Feedback: ".$_GET['subject'];
$text=$_GET['name']. " says:\n".$_GET['text'];
$headers="From: ".$_GET['name']." <".$_GET['email'].">" . "\r\n" .
    "Reply-To: ".$_GET['name']." <".$_GET['email'].">" . "\r\n" .
    "X-Mailer: PHP/" . phpversion();

if (!mail($email, $subject, $text, $headers))
{
echo "Cannot send mail";
}
else {
echo "Sent";
}
