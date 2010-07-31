<?php
//Check whose daemon refreshed in the last 5 seconds.
//This may use up a lot of resources! Replace soon please!

//echo "The date is ".date("U"). "and the date 5 seconds before is ".strval(intval(date("U"))-5);

session_start();
include "../../../includes/db_connect.php";
include "../../../includes/functions.php";

$query="SELECT DISTINCT c.user_id, u.username FROM chatroom_online c left join users u on u.id=c.user_id WHERE time > ".strval(intval(date("U"))-7)." ORDER BY username;";
//echo $query."<br />";
$result=mysql_query($query);
if (!$result) {
echo "Couldn't get online people!".mysql_error();
}
else {
if (mysql_num_rows($result) == 0) {
    echo "No one is online! This is weird.";
    exit;
}
while ($rows=mysql_fetch_assoc($result)) {
echo $rows['username']."<br />";
}
}
?>