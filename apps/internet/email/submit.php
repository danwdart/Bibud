<?php
session_start();
include "../../../includes/db_connect.php";
include "../../../includes/functions.php";

if (isset($_GET['recipient'])) {

$recipient = $_GET['recipient'];


# Find recipient ID
$rcpt = mysql_query("SELECT id FROM users WHERE `username` = '$recipient';");
$ra = mysql_fetch_assoc($rcpt);
$recipient_id = $ra['id'];
$subject = $_GET['subject'];
$text = $_GET['text'];

if ($_GET['text'] != "") {

if (stristr($recipient,"@")) {
// Send an email
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
// Additional headers

$headers .= "From: Bibud Emailer <".$username."_noreply@bibud.com>\r\n";
$headers .= "To: $recipient <$recipient>\r\n";
$headers .= "Reply-To: <".$username."_noreply@bibud.com>\r\n";
$headers .= "Return-Path: <".$username."_noreply@bibud.com>\r\n";
$headers .= "Date: ".date("r")."\r\n";
$headers .= 'X-Mailer: PHP/' . phpversion() . "\r\n";
if (!mail ($recipient,$subject,"Mailed from Bibud. DO NOT REPLY TO THIS MESSAGE. \n<br />From:".$username."\n\n<br /><br />".$text."\n\n<br /><br />Sent from Bibud, http://bibud.com",$headers, "-f".$username."_noreply@bibud.com")) {
echo ("Not OK");
}
}

else {
// File a message
if (!mysql_query ("INSERT INTO email (sender_id,recipient_id,subject,text,date) VALUES ('$user_id','$recipient_id','$subject','$text','".date('Y-m-d')."');")) {
echo ("Not OK");


// Now send an email to the person.

# Get recipient's details.
$q =mysql_query("SELECT * FROM users WHERE `username` = '$recipient'");
$arr = mysql_fetch_assoc($q);
$remail = $arr['email'];
$rfname = $arr['fname'];
$rlname = $arr['lname'];

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
// Additional headers

$headers .= "From: Bibud Emailer <".$username."_noreply@bibud.com>\r\n";
$headers .= "To: $rfname $rlname <$remail>\r\n";
$headers .= "Reply-To: <".$username."_noreply@bibud.com>\r\n";
$headers .= "Return-Path: <".$username."_noreply@bibud.com>\r\n";
$headers .= "Date: ".date("r")."\r\n";
$headers .= 'X-Mailer: PHP/' . phpversion() . "\r\n";
if (!mail ($remail,$subject,"You have received a message from $fname $lname on Bibud. Here is the contents of the message: \n".$text."\n\n<br /><br />Sent from Bibud, http://bibud.com",$headers, "-f".$username."_noreply@bibud.com")) {
echo ("Not OK");
}

}


}

}

}
// echo (mysql_error());
?>
