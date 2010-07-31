<?php
session_start();
include "../../../includes/db_connect.php";
include "../../../includes/functions.php";

$query="SELECT u.username as chatfrom, c.* from chatroom c left join users u on c.user_id=u.id ORDER BY chatdate;";
$result=mysql_query($query);
if (mysql_fetch_assoc($result)) {
while ($row=mysql_fetch_assoc($result)) {

if (date("d/m/y") != date("d/m/y",$row['chatdate'])) {
echo "<span style='color:#990099'>".date("d/m/y",$row['chatdate'])."</span> ";
}

echo "<span style='color:blue;'>".date("H:i:s O",$row['chatdate'])."</span> <span style='color:red;'>".$row['chatfrom']."</span> said: ".stripslashes($row['chattext'])."<br />";
}
}
else {
echo "No Messages!";
}
?>
