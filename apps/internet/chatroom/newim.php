<?php
session_start();
include "../../../includes/db_connect.php";
include "../../../includes/functions.php";

if (isset($_GET['text'])) {

$text=$_GET['text'];
$text=htmlspecialchars($text,ENT_QUOTES);

// Begin optional censoring. If you don't want this, comment it out. str_ireplace(search, replace, subject)
$text=str_ireplace("fuck","****",$text);
$text=str_ireplace("shit","****",$text);
$text=str_ireplace("cunt","****",$text);
$text=str_ireplace("vagina","****",$text);
$text=str_ireplace("dick","****",$text);
$text=str_ireplace("porn","****",$text);
$text=str_ireplace("prick","****",$text);
$text=str_ireplace("crap","****",$text);
$text=str_ireplace("clit","****",$text);
$text=str_ireplace("douche","****",$text);
$text=str_ireplace("fck","****",$text);
$text=str_ireplace("whore","****",$text);
$text=str_ireplace("bitch","****",$text);
$text=str_ireplace("asshole","****",$text);
$text=str_ireplace("nigger","****",$text);
$text=str_ireplace("viagra","****",$text);
$text=str_ireplace("rxmed","****",$text);
/* 
teach it leet
teach it not to look at white spaces if X conditions are met
shit
cunt
douche
lol
screw
mother
motha
fsk
fsck
bitch
whore
bastard
asshole
ass
flatulent bastard
yellowstone national park
horton hear's a whoo
*/

// End optional censoring

$date=date("U");
$query="INSERT INTO chatroom SET user_id='$user_id',chattext='$text',chatdate='$date';";
$result=mysql_query($query);
if (!$result) {
echo "Could not submit chat! ",mysql_error()." ".$query;
}
}
else {
echo "You're not allowed to run this script like this!";
}
?>
