<?php
session_start();
include "../../../includes/db_connect.php";
include "../../../includes/functions.php";


if (isset($_GET['del'])) {

$query="DELETE FROM email WHERE id='".$_GET['id']."' AND recipient_id='$user_id';";
$result=mysql_query($query);
if (!$query) {
echo "Could not delete email message.";
}
}

else if (isset($_GET['quote'])) {
$query="SELECT concat(u.fname,' ',u.lname) as sender, e.text FROM email e left join users u on u.id=e.sender_id WHERE e.id=".$_GET['id']." AND e.recipient_id='$user_id' LIMIT 1;";
$result=mysql_query($query);
if (!$result) {
echo "Could not retreive message.";
mysql_error();
}
$row=mysql_fetch_assoc($result);
echo "\n\n<br /><br />".$row['sender']." wrote:\n<br />".$row['text'];
}
else if (isset($_GET['getSender'])) {
$query="SELECT username as sender FROM email e left join users u on u.id=e.sender_id  WHERE e.id=".$_GET['id']." AND e.recipient_id='$user_id' LIMIT 1;";
$result=mysql_query($query);
if (!$result) {
echo "Could not retreive sender.";
mysql_error();
}
$row=mysql_fetch_assoc($result);
echo $row['sender'];
}
else if (isset($_GET['getSubject'])) {
$query="SELECT subject FROM email WHERE id=".$_GET['id']." AND recipient_id='$user_id' LIMIT 1;";
$result=mysql_query($query);
if (!$result) {
echo "Could not retreive sender.";
mysql_error();
}
$row=mysql_fetch_assoc($result);
echo $row['subject'];
}
else {
echo "You cannot run this script like this.";
}


?>
