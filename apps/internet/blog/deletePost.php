 <?php
session_start();
include "../../../includes/db_connect.php";
include "../../../includes/functions.php";

// Make sure the post REALLY DOES belong to the user
if ($level >= 4) {
$query = "DELETE FROM blog WHERE id='".$_GET['id']."';";
}
else {
$query="DELETE FROM blog WHERE author_id='$user_id' AND id='".$_GET['id']."';";
}
$result=mysql_query($query);
if (!$result) {
echo "Can't delete post! Does it REALLY belong to you?";
}
?>
