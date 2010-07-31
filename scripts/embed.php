<?php
session_start();
include "../includes/db_connect.php";
include "../includes/functions.php";

# Embed files script. Warning: potentially dangerous. Do not let this code execute PHP etc.
$allowed_exts = array();
$allowed_exts[] = "png";
$allowed_exts[] = "jpg";
$allowed_exts[] = "gif";
$allowed_exts[] = "ogg";
$allowed_exts[] = "ogv";
$allowed_exts[] = "oga";
$allowed_exts[] = "webm";

# $username;
$filename = $_GET['file'];

if (stristr($filename, "..")) { die("Naughty naughty!"); }
if (stristr($filename, "/")) { die("Naughty naughty!"); }
$filename = "../$filesroot/$filename";

// required for IE, otherwise Content-disposition is ignored
if(ini_get('zlib.output_compression'))
  ini_set('zlib.output_compression', 'Off');

$file_extension = strtolower(substr(strrchr($filename,"."),1));
if ($file_extension == "ogg" || $file_extension == "oga") { $ctype="audio/ogg"; }
if ($file_extension == "ogv") { $ctype="video/ogg"; } 
if (!isset($ctype)) { $ctype=""; };

if (!in_array($file_extension,$allowed_exts)) { die("That type of file is banned from embedding."); }

if( $filename == "" ) 
{
  echo "No file specified.";
  exit();
} elseif ( ! file_exists( $filename ) ) 
{
  echo "Can't find file: $filename.";
  exit();
};

header("Pragma: public"); // required
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false); // required for certain browsers 
header("Content-Type: $ctype");
// change, added quotes to allow spaces in filenames, by Rajkumar Singh
 header("Content-Disposition: inline"); //; filename=\"".basename($filename)."\";" );
header("Content-Transfer-Encoding: binary");
header("Content-Length: ".filesize($filename));
readfile("$filename"); // DO NOT INCLUDE!!
exit();

?>
    
