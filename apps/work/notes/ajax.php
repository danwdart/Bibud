 <?php
session_start();
include "../../../includes/db_connect.php";
include "../../../includes/functions.php";

if (isset($_GET['init'])) {
// ONLY RUN THIS ONCE!
$notesav = mysql_query("SELECT FROM notes WHERE `user_id`='$user_id' limit 1");
if (mysql_num_rows($notesav) == 0) {
mysql_query("INSERT INTO notes SET `user_id`='$user_id';");
}
}

if (isset($_GET['write'])) {
$notesav = mysql_query("SELECT FROM notes WHERE `user_id`='$user_id'");
if (mysql_num_rows($notesav) == 0) {
mysql_query("INSERT INTO notes SET `user_id`='$user_id';");
}
$query="UPDATE notes SET body='".$_GET['body']."' WHERE `user_id`='$user_id' limit 1;";
$result=mysql_query($query);
if (!$result) {
mysql_error();
}
}
else if (isset($_GET['read'])) {
$query="SELECT body FROM notes WHERE `user_id`='$user_id';";
$result=mysql_query($query);
if ($result) {
while ($row=mysql_fetch_array($result)) {
echo $row['body'];
}
}
else {
mysql_query();
}
}
else {
echo "This script should not be run like this.";
}
?>
