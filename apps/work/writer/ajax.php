<?php
if (isset($_GET['showFiles'])) {
$files_array=get_files_in_directory ($_COOKIE['filesdir']);
if (!$files_array) { echo "No Documents."; } else {
foreach ($files_array as $files) {
$file_path_array=explode("/",$files);
$filename=$file_path_array[7];
if ((get_mimetype($files) == "text/html") ){
echo "<br /><a href='javascript:writerEditThis(\"".$filename."\");'>".$filename."</a>";
}
}
}
}


?>