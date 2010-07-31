<?php
session_start();
include "../../../includes/db_connect.php";
include "../../../includes/functions.php";
$user_id=$_SESSION['user_id'];


if (isset($_GET['showFiles'])) {
$files_array=get_files_in_directory ($_SESSION['filesdir']);
if (!$files_array) { echo "No Files."; } else {
foreach ($files_array as $files) {
$file_path_array=explode("/",$files);
$filename=end($file_path_array);
$mt = get_mimetype($files) ;

if (strstr($mt,"image/jpeg") !== false || strstr($mt,"image/gif") !== false || strstr($mt,"image/png") !== false || strstr($mt,"image/bmp") !== false || strstr($mt,"image/x-ms-bmp") !== false ){
echo "<br /><a href='javascript:setFileAsBg(\"".$filename."\");'>".$filename."</a>";
}
}
}
}

elseif (isset($_GET['set'])) {
$query="UPDATE `users` SET `background`='".$_GET['file']."' WHERE id='$user_id' LIMIT 1;";
$result=mysql_query($query);
if (!$result) {
echo "Could not set BG!";
}
}

elseif (isset($_GET['refreshbg'])) {
$queryr="SELECT `background` FROM `users` WHERE `id`='$user_id' LIMIT 1;";
$result=mysql_query($queryr);
$bgfilea=mysql_fetch_assoc($result);
$bgfile=$bgfilea['background'];
echo "scripts/embed.php?file=$bgfile";
}

elseif (isset($_GET['getrepeat'])) {
$query="SELECT `background_repeat` FROM `users` WHERE id='$user_id' LIMIT 1;";
if ($result=mysql_query($query)) {
$repeata=mysql_fetch_assoc($result);
$repeat=$repeata['background_repeat'];
echo $repeat;
}
else {
echo "no-repeat";
}
}

elseif (isset($_GET['setrepeat'])) {
$query="UPDATE `users` SET `background_repeat`='".$_GET['repeat']."' WHERE id='$user_id';";
$result=mysql_query($query);
if (!$result) {
echo "Could not set Repeat!".$query.mysql_error();
}
}

else {
echo "You cannot run this script like this.";
}
?>
