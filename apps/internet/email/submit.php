<?php
session_start();
include "../../../includes/db_connect.php";
include "../../../includes/functions.php";

if ($_GET['text'] != "") {

if (stristr($_GET['recipient'],"@")) {
// Send an email
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
// Additional headers

$headers .= "From: Bibud Emailer <".$_COOKIE['username']."_noreply@bibud.kevinghadyani.com>\r\n";
$headers .= "To: ".$_GET['recipient']." <".$_GET['recipient'].">\r\n";
$headers .= "Reply-To: <".$_COOKIE['username']."_noreply@bibud.kevinghadyani.com>\r\n";
$headers .= "Return-Path: <".$_COOKIE['username']."_noreply@bibud.kevinghadyani.com>\r\n";
$headers .= "Date: ".date("r")."\r\n";
$headers .= 'X-Mailer: PHP/' . phpversion() . "\r\n";
if (!mail ($_GET['recipient'],$_GET['subject'],"Mailed from Bibud. DO NOT REPLY TO THIS MESSAGE. \n<br />From:".$_COOKIE['username']."\n\n<br /><br />".$_GET['text']."\n\n<br /><br />Sent from Bibud, http://bibud.kevinghadyani.com",$headers, "-f".$_COOKIE['username']."_noreply@bibud.kevinghadyani.com")) {
echo ("Not OK");
}
}

else {
// File a message
if (!mysql_query ("INSERT INTO email (sender,recipient,subject,text,date) VALUES ('".$_COOKIE['username']."','".$_GET['recipient']."','".$_GET['subject']."','".$_GET['text']."','".date('Y-m-d')."');")) {
echo ("Not OK");


// Now send an email to the person.
$result=mysql_query("SELECT * FROM userinfo WHERE `recipient` = '".$_GET['recipient']."'";
$row=mysql_fetch_assoc($result);
$fname = $row['fname'];
$lname = $row['lname'];
$email = $row['email'];

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
// Additional headers

$headers .= "From: Bibud Emailer <".$_COOKIE['username']."_noreply@bibud.com>\r\n";
$headers .= "To: $fname $lname <$email>\r\n";
$headers .= "Reply-To: <".$_COOKIE['username']."_noreply@bibud.com>\r\n";
$headers .= "Return-Path: <".$_COOKIE['username']."_noreply@bibud.com>\r\n";
$headers .= "Date: ".date("r")."\r\n";
$headers .= 'X-Mailer: PHP/' . phpversion() . "\r\n";
if (!mail ($_GET['recipient'],$_GET['subject'],"You have received a message from $fname $lname on Bibud. Here is the contents of the message: \n".$_GET['text']."\n\n<br /><br />Sent from Bibud, http://bibud.com",$headers, "-f".$_COOKIE['username']."_noreply@bibud.com")) {
echo ("Not OK");
}

}


}

}

// echo (mysql_error());
?>
