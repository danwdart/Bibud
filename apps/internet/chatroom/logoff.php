<?php
session_start();
include "../../../includes/db_connect.php";
include "../../../includes/functions.php";

$query="DELETE FROM chatroom_online WHERE user_id='$username'";
if (!mysql_query($query)) {
echo "Couldn't logoff!".mysql_error();
}
?>
