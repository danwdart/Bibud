 <?php
session_start();
include "../../../includes/db_connect.php";
include "../../../includes/functions.php";

$result=mysql_query("SELECT concat(u.fname,' ',u.lname) as sender, e.* FROM email e left join users u on u.id=e.sender_id WHERE recipient_id = '$user_id' ORDER BY e.id DESC;");

if (!$result) {
echo ("Can't find email table.");
exit();
}
while ($row = mysql_fetch_assoc($result)) {
    echo "<h3>".$row['subject']."</h3>\n" ;
    echo "&nbsp;&nbsp;<a href='javascript:replyEmail(\"".$row['id']."\");'>Reply</a>";
    echo "&nbsp;&nbsp;<a href='javascript:forwardEmail(\"".$row['id']."\");'>Forward</a>";
    echo "&nbsp;&nbsp;<a href='javascript:deleteEmail(\"".$row['id']."\");'>Delete</a>";
    echo "<br /><br />From ".$row['sender']; 
    echo " on ".$row['date']." \n";
    echo "<br />".$row['text']." <br /><br /> \n";
}
?>