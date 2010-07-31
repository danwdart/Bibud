<?php
session_start();
include "../../../includes/db_connect.php";
include "../../../includes/functions.php";

if (isset($_GET['refresh'])) {
$files_array=get_files_in_directory ($_SESSION['filesdir']);
if (!$files_array) { echo "No Files."; } else {
foreach ($files_array as $files) {
// $file_path_array=explode("/",$files);
// $filename=$file_path_array[6];
$filename=basename($files);
echo "<a href='scripts/download.php?file=$filename' target='_blank'>". $filename."</a><br />";
}
}
}
if (isset($_GET['upload'])) {

/*
if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/pjpeg"))
&& ($_FILES["file"]["size"] < 20000))
  {

*/

if (($_FILES["file"]["size"] <= 10000000) && ($_FILES["file"]["type"] != "text/x-php") && ($_FILES["file"]["type"] != "text/x-cgi") && (substr(strrchr($_FILES["file"]["name"], '.'), 1) != "php") && (substr(strrchr($_FILES["file"]["name"], '.'), 1) != "cgi") && (substr(strrchr($_FILES["file"]["name"], '.'), 1) != "php4") &&  (substr(strrchr($_FILES["file"]["name"], '.'), 1) != "php5") &&  (substr(strrchr($_FILES["file"]["name"], '.'), 1) != "php6") &&  (substr(strrchr($_FILES["file"]["name"], '.'), 1) != "php3")  && (substr(strrchr($_FILES["file"]["name"], '.'), 1) != "phtml"))

{
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
    }
  else
    {
/*
    echo "Upload: " . $_FILES["file"]["name"] . "<br />";
    echo "Type: " . $_FILES["file"]["type"] . "<br />";
    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
    echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";
*/
    if (file_exists($_SESSION['filesdir']."/" . $_FILES["file"]["name"]))
      {
      echo $_FILES["file"]["name"] . " already exists. ";
      }
    else
      {
      move_uploaded_file($_FILES["file"]["tmp_name"], $_SESSION['filesdir'] . "/" . $_FILES["file"]["name"]);
      echo "Stored as: " . $_FILES["file"]["name"];
      }
    }
  }
else
  {
  echo "Invalid file";
  }
}

?>
