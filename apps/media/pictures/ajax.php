<?php
session_start();
include "../../../includes/db_connect.php";
include "../../../includes/functions.php";
if (!isset($_GET['size'])) { $_GET['size']='100'; } # Make no one complain
// WARNING: Only picks up root dir pics
if (isset($_GET['showpics'])) {
$files_array=get_files_in_directory ($_SESSION['filesdir']);
if (!$files_array) { echo "No Files."; } else {
$i=1;
foreach ($files_array as $files) {
$file_path_array=explode("/",$files);
$filename=end($file_path_array);
$mt = get_mimetype($files) ;

if (strstr($mt,"image/jpeg") !== false || strstr($mt,"image/gif") !== false || strstr($mt,"image/png") !== false || strstr($mt,"image/bmp") !== false || strstr($mt,"image/x-ms-bmp") !== false ) {
echo "<div style='width:".$_GET['size']."px;height:".$_GET['size']."px;margin:5px;padding:0;text-align:center;background-color:#777777;float:left;'><a href='javascript:showImg(\"r".$i."\");'><img id='r".$i."' class='pictures_picture' style='max-height:".$_GET['size']."px;max-width:".$_GET['size']."px;border-style:none;' src='scripts/embed.php?file=".$filename."'/></a></div>";
$i++;
}
}
}
}


if (isset($_GET['numpics'])) {
$files_array=get_files_in_directory ($_SESSION['filesdir']);
if (!$files_array) { echo "No Files."; } else {
$i=0;
foreach ($files_array as $files) {
$file_path_array=explode("/",$files);
$filename=$file_path_array[7];
if ((get_mimetype($files) == "image/jpeg") || (get_mimetype($files) == "image/gif") || (get_mimetype($files) == "image/png")){
$i++;
}
}
echo $i;
}
}

?>
