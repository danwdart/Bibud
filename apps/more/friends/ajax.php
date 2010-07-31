<?php
/*
New friend: User_1: You User_2: Them, Status: requested

To accept: Change requested to confirmed fuser=you, xgroup=friends

To reject: Delete record where fuser=you and username=them and  xstatus=requested,

To delete: Delete record where username=you and fuser=them, and fuser=you and username=them

xgroup should be friend for now until we introduce some other types.

*/

# Globals
session_start();
include "../../../includes/db_connect.php";
include "../../../includes/functions.php";

# Ajax from inside
?> <script type="text/javascript" src="../../../ajax.js">
</script>
<?

if (isset($_GET['show'])) {
$query="SELECT f.*, u.fname, u.lname, u.username, u.id as user_id FROM friends f left join users u on f.user_2=u.id WHERE f.user_1='$user_id' AND xstatus='confirmed';";
$result=mysql_query($query);
if (!$result) { echo "No Friends.";} else {
  while($row=mysql_fetch_assoc($result)) {
echo $row['fname']. " ".$row['lname']." - ".$row['username']." &nbsp;&nbsp;&nbsp;&nbsp;<a href='javascript:emailFriend(\"".$row['user_id']."\")'>Email</a><div id='remove_".$row['user_id']."'><a href='javascript:friend_remove(\"".$row['user_id']."\",\"remove_".$row['user_id']."\")'>Remove</a></div>";
}
}
}


if (isset($_GET['search'])) {
$string=$_GET['string'];
$string=mysql_real_escape_string($string);
$string=htmlspecialchars($string,ENT_QUOTES);
$string=explode(" ",$string);
$string[]="";
$query="SELECT username,fname,lname,email, id FROM users WHERE id != '$user_id' AND ( username LIKE '".$_GET['string']."' OR fname LIKE '".$string[0]."' OR lname LIKE '".$string[1]."' OR email='".$_GET['string']."');";
$result=mysql_query($query);
if (!$result) { echo "No Results."; } else {
if (mysql_num_rows($result) == 0) { echo "<br />No Results."; }
while ($row=mysql_fetch_assoc($result)) {
echo "<br />".$row['fname']." ".$row['lname']." - ".$row['username']." &nbsp;&nbsp;&nbsp;&nbsp;<div id='add_".$row['id']."'><a href='javascript:friend_add(\"".$row['id']."\",\"add_".$row['id']."\")'>Add</a></div>";
}
}
}

if (isset($_GET['reqs'])) {
$query="SELECT f.*, u.fname, u.lname, u.username, u.id as user_id FROM friends f left join users u on f.user_1=u.id WHERE user_2='$user_id' AND xstatus='request';";
$result=mysql_query($query);

if (!$result) { echo "No Requests.";} else {
while ($row=mysql_fetch_assoc($result)) {
  echo $row['fname']." ".$row['lname']." - ".$row['username']." &nbsp;&nbsp;&nbsp;&nbsp;<div id='accept_".$row['user_id']."'><a href='javascript:friend_accept(\"".$row['user_id']."\",\"accept_".$row['user_id']."\")'>Accept</a></div><div id='decline_".$row['user_id']."'><a href='javascript:friend_decline(\"".$row['user_id']."\",\"decline_".$row['user_id']."\")'>Decline</a></div>";
}
}
}

if (isset($_GET['add'])) {
$query="
INSERT INTO friends SET user_1='$user_id', user_2='".$_GET['fuser']."', xgroup='friends', xstatus='request';";
$result=mysql_query($query);
if (!$result) { echo "Cannot request!".mysql_error().$query;} else {
echo "Requested";
}
}


if (isset($_GET['remove'])) {
$query="
DELETE FROM friends WHERE user_1='$user_id' AND  user_2='".$_GET['fuser']."';";
$result=mysql_query($query);
if (!$result) { echo "Cannot remove!";} else {
echo "Removed";
}
$query="
DELETE FROM friends WHERE user_2='$user_id' AND  user_1='".$_GET['fuser']."';";
$result=mysql_query($query);
if (!$result) { echo "Cannot remove!";} else {
//Removed from their friends' list
}


}
if (isset($_GET['accept'])) {
$query="UPDATE friends SET xstatus='confirmed' WHERE user_2='$user_id' AND  user_1='".$_GET['fuser']."' AND xstatus='request';";
$result=mysql_query($query);
if (!$result) { echo "Cannot accept!";} else {
echo "Accepted";
}
$query="
INSERT INTO friends SET user_1='$user_id', user_2='".$_GET['fuser']."', xgroup='friends',xstatus='confirmed';";
$result=mysql_query($query);
if (!$result) { echo "Cannot add you to their friends list!";} else {
// Added to Friends List
}
}


if (isset($_GET['decline'])) {
$query="
DELETE FROM friends WHERE user_2='$user_id' AND user_1='".$_GET['user_2']."' AND xstatus='request';";
$result=mysql_query($query);
if (!$result) { echo "Cannot decline!";} else {
echo "Declined";
}
}
