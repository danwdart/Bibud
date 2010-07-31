 
<?php
include '../../../functions.php';
// WARNING: Only picks up root dir pics
if (isset($_GET['showpics'])) {
$files_array=get_files_in_directory ($_COOKIE['filesdir']);
if (!$files_array) { echo "No Files."; } else {
$i=1;
foreach ($files_array as $files) {
$file_path_array=explode("/",$files);
$filename=$file_path_array[7];
if ((get_mimetype($files) == "image/jpeg") || (get_mimetype($files) == "image/gif") || (get_mimetype($files) == "image/png")){
echo "<a href='javascript:showImg(\"r".$i."\");'><img id='r".$i."' style='position:absolute;max-height:100px;max-width:100px;' border='0' src='/user/".$_COOKIE['username']."/".$filename."'/></a>";
$i++;
}
}
}
}
if (isset($_GET['numpics'])) {
$files_array=get_files_in_directory ($_COOKIE['filesdir']);
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