<?php
session_start();
include "../../../includes/db_connect.php";
include "../../../includes/functions.php";

$result=mysql_query("SELECT concat(u.fname,' ', u.lname) as author, b.* FROM blog b left join users u on u.id=b.author_id ORDER BY b.id DESC;");
if (!$result) {
echo ("Can't find blog table. Did you re-register?");
exit();
}
if (mysql_num_rows($result) == 0) {
  die("There are no blog posts to display. Maybe you could create one?");
}
while ($row = mysql_fetch_assoc($result)) {
    echo "<br /><h3>".$row['title']."</h3>\n" ;
    echo "By ".$row['author'];
    echo " on ".$row['date'];
    if ($row['author_id']==$user_id || $level >= 4) {
    echo " <a href='javascript:blogDeletePost(\"".$row['id']."\")'>Delete</a>";
    }
    echo "\n";
    echo "<br /><br /> ".$row['text']." <br />\n";
}
?>
