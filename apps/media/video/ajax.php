<?php
// Globals
session_start();
include "../../../includes/db_connect.php";
include "../../../includes/functions.php";
$user_id=$_SESSION['user_id'];
// Locals
include('getid3.php');

$what = $_GET["what"];

if ($what == "index_video") {
   // Clear Videos
	$user_id=$_SESSION['user_id'];
	mysql_query("DELETE FROM video WHERE `user_id`='$user_id'");
    $user_dir = $_SESSION['filesdir'];
   $files = get_files_in_directory($user_dir);
   $dirs = get_directories_in_directory($user_dir);
   $total_files = Array();
      
   if ($files == "" ) {
      $files = Array(); //so that array_merge doesnt cry
   }
   if ($dirs == "") {
      $dirs = Array(); //so that array_merge doesnt cry
   } 
      
   $total_files = array_merge($files, $dirs);
   $x = 0;
   while (isset($dirs[0])) {
      $new_files = get_files_in_directory($dirs[0]);
      $new_dirs = get_directories_in_directory($dirs[0]);
         
      if ($new_dirs != "") {
         $total_files = array_merge($total_files, $new_dirs);
         $dirs = array_merge($dirs, $new_dirs);
      }
      if ($new_files != "") {
         $total_files = array_merge($total_files, $new_files);
      }
         
      if (count($dirs) != 1) {
         unset($dirs[0]);
         $dirs = array_values($dirs);
      } else {
         unset ($dirs);
      }
      /* Uncomment this to debug the while loop, sometimes it recurses infinitely and hangs the whole webserver 
    	$x++;
   	if ($x >= 10) {
     		break;
      }*/
   }

   if ($total_files != "") {
      foreach ($total_files as $file) {

$path_parts = pathinfo($file);
$extension = $path_parts['extension'];
// RedHat         
//$mimetype = get_mimetype($file);
//         if ($mimetype == "application/ogg") {

// Debian
/*
$filetype=get_filetype($file);
if ($filetype == "Theora") {  
*/
if ($extension== "ogg" || $extension == "ogv") {

          $getid3 = new getID3();
            $fileinfo = $getid3->analyze($file);
		      getid3_lib::CopyTagsToComments($fileinfo);
			if (isset($fileinfo['tags'])) {
		      $artist = (isset($fileinfo['tags']['vorbiscomment']['artist'][0]) ? $fileinfo['tags']['vorbiscomment']['artist'][0] : "Unknown Artist");
		      $album = (isset($fileinfo['tags']['vorbiscomment']['album'][0]) ? $fileinfo['tags']['vorbiscomment']['album'][0] : "Unknown Album");
		      $title = (isset($fileinfo['tags']['vorbiscomment']['title'][0]) ? $fileinfo['tags']['vorbiscomment']['title'][0] : "Unknown Title");
		      $track = (isset($fileinfo['tags']['vorbiscomment']['tracknumber'][0]) ? $fileinfo['tags']['vorbiscomment']['tracknumber'][0] : "1");            
			}
            //store in database
		if (!isset($artist)) { $artist = "Unknown Artist"; }
		if (!isset($album)) { $album = "Unknown Album"; }
		if (!isset($title)) { $title = "Unknown Title"; }
		if (!isset($track)) { $track = "1"; }
		echo "Found video: $track: $title by $artist on $album";
            insert_video($artist, $album, $title, $track, $file);
         }
      }       
   }
}

if ($what == "playlist") {

   $result = mysql_query("SELECT * FROM video WHERE `user_id`='$user_id' ORDER BY artist, album, track");
   $return = "<table border='0' width='100%'>";
   $x = 0;
if (mysql_num_rows($result) > 0) {
   while ($row = mysql_fetch_assoc($result)) {
      $return .= "<tr>";
      	$title = get_title($row);
      	$path = basename($row["path"]);
      	$id = "video_video_$x";
         $return .= "<td><a id='$id' data-path='$path' data-title='$title' style='font-size:8pt;' href='javascript:video_play(\"".$x."\");'>$title</a></td>";
      $return .= "</tr>";
      $x++;
   }
}
else {
echo "<td>No videos present. Use 'My Files' to upload some!";
}
   $return .= "</table>";
   echo $return;
}

if ($what == "num_videos") {
	$result = execute_query("SELECT id FROM video WHERE `user_id`='$user_id'");
	echo mysql_num_rows($result);
}

if ($what == "next_video_path") {
	$path = $_GET["current_video"];
	$result = execute_query("SELECT * FROM video");
	$num_videos = mysql_num_rows($result);
	
	$result = execute_query("SELECT * FROM video WHERE path LIKE '%$path' AND `user_id` = '$user_id'");
	$row = mysql_fetch_assoc($result);
	$next_video_id = $row["id"] + 1;
	
	if ($next_video_id > $num_videos) {
		$next_video_id = 0;
	}
	
	$result = execute_query("SELECT path FROM video WHERE id=$next_video_id AND `user_id` = '$user_id'");
	$row = mysql_fetch_assoc($result);
	echo get_relative_download_path($row["path"]);
}

if ($what == "next_video_title") {
	$path = $_GET["video"];
	$result = execute_query("SELECT * FROM video WHERE path LIKE '%$path' AND `user_id` = '$user_id'");
	$row = mysql_fetch_assoc($result);
	echo get_title($row);
}

if (isset($_GET['info'])) {
  $id=$_GET['info'];
    	$result = execute_query("SELECT * FROM video WHERE id = ".$id." AND `user_id` = '$user_id'");
	$row = mysql_fetch_assoc($result);
	echo "Name: ".$row['title']."<br />Artist: ".$row['artist']."<br />Album: ".$row['album']."<br />Info:<br />".$row['comments'];
}
/* FUNCTIONS */

function insert_video($artist, $album, $title, $track, $path) {
	$user_id=$_SESSION['user_id'];
   execute_query("INSERT INTO video (user_id, artist, album, title, track, path) VALUES('$user_id','$artist','$album','$title','$track', '$path')");
}


function get_title($row) {
$artist=$row["artist"];
$title=$row["title"];
$album=$row["album"];

	  if (trim($artist)=="") { $artist="Unknown"; }
	  if (trim($title)=="") { $title=basename($row['path']); }
	  if (trim($album)=="") { $album="Unknown"; }

	return $title; //." by ".$artist." on ".$album;
}
?>
