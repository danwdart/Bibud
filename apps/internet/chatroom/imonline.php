<?php
//Add me to the online daemon table!
//This may use up a lot of resources! Replace soon please!
// Later, use an UPDATE so you don't add a new row every 10 seconds!
session_start();
include "../../../includes/db_connect.php";
include "../../../includes/functions.php";

$query="INSERT INTO chatroom_online (user_id,time) VALUES ('".$user_id."', ".date("U").");";
if (!mysql_query($query)) {
echo "Couldn't set online status!".mysql_error();
}
?>