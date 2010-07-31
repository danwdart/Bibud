<?php
// Globals
session_start();
include "../../../includes/db_connect.php";
include "../../../includes/functions.php";

$user_id=$_SESSION['user_id'];

// Locals
include('getid3.php');

$what = $_GET["what"];

if ($what== "anymusic") {

$result = execute_query("SELECT * FROM media WHERE `user_id`='$user_id';");
if (!$result) { echo "No Entries."; } else {
if (mysql_num_rows($result) == false || mysql_num_rows($result) == 0) {
echo "false";
}
else {
echo "true";
}
}
}


if ($what == "index_music") {
   
mysql_query("DELETE FROM media WHERE `user_id`='$user_id'");
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
if ($extension== "ogg" || $extension == "oga") {

          $getid3 = new getID3();
            $fileinfo = $getid3->analyze($file);
		      getid3_lib::CopyTagsToComments($fileinfo);
			if (isset($fileinfo['tags'])) {
		      $artist = (isset($fileinfo['tags']['vorbiscomment']['artist'][0]) ? $fileinfo['tags']['vorbiscomment']['artist'][0] : "Unknown Artist");
		      $album = (isset($fileinfo['tags']['vorbiscomment']['album'][0]) ? $fileinfo['tags']['vorbiscomment']['album'][0] : "Unknown Album");
		      $title = (isset($fileinfo['tags']['vorbiscomment']['title'][0]) ? $fileinfo['tags']['vorbiscomment']['title'][0] : "Unknown Title");
		      $track = (isset($fileinfo['tags']['vorbiscomment']['tracknumber'][0]) ? $fileinfo['tags']['vorbiscomment']['tracknumber'][0] : "1");            
			}          
		if (!isset($artist)) { $artist = "Unknown Artist"; }
		if (!isset($album)) { $album = "Unknown Album"; }
		if (!isset($title)) { $title = "Unknown Title"; }
		if (!isset($track)) { $track = "1"; }
            //store in database
            insert_song($artist, $album, $title, $track, $file);
         }
      }       
   }
}

if ($what == "playlist") {
   $result = execute_query("SELECT * FROM media WHERE user_id='$user_id' ORDER BY artist, album, track");
  if (!$result) {echo "No Entries."; } else {
   $return = "<table border='0' width='100%'>";
   $x = 0;
   while ($row = mysql_fetch_assoc($result)) {
      if ( ((int)$x)%2 == 0 ) { $color="#dddddd"; } else { $color="#ffffff";}
      $return .= "<tr style='background-color:$color;'>";
      	$title = get_title($row);
//	if (trim($title)) == "") { $title = "Untitled"; }
      	$path = 'scripts/embed.php?file='.basename($row["path"]);
      	$id = "audio_song_$x";
	$playing=get_playing($row);
         $return .= "<td><b><a id='$id' data-path='$path' data-title='$title' data-playing='$playing'  style='font-size:8pt;' href='javascript:audio_play(\"".$x."\");'>$title</a></b></td><td>".$row['artist']."</td><td>".$row['album']."</td><td><a href='javascript:shareAudio(\"".$row['id']."\");'>Share</a></td>";
      $return .= "</tr>";
      $x++;
   }
   $return .= "</table>";
}
   echo $return;
}

if ($what == "num_songs") {
	$result = execute_query("SELECT * FROM media WHERE user_id='$user_id'");
	echo mysql_num_rows($result);
}

if ($what == "next_song_path") {
	$path = $_GET["current_song"];
	$result = execute_query("SELECT * FROM media WHERE user_id='$user_id'");
	$num_songs = mysql_num_rows($result);
	
	$result = execute_query("SELECT * FROM media WHERE path LIKE '%$path' AND user_id='$user_id'");
	$row = mysql_fetch_assoc($result);
	$next_song_id = $row["id"] + 1;
	
	if ($next_song_id > $num_songs) {
		$next_song_id = 0;
	}
	
	$result = execute_query("SELECT path FROM media WHERE id=$next_song_id AND user_id='$user_id'");
	$row = mysql_fetch_assoc($result);
	echo get_relative_download_path($row["path"]);
}

if ($what == "next_song_title") {
	$path = $_GET["song"];
	$result = execute_query("SELECT * FROM media WHERE path LIKE '%$path' AND user_id='$user_id'");
	$row = mysql_fetch_assoc($result);
	echo get_title($row);
}

/* FUNCTIONS */

function insert_song($artist, $album, $title, $track, $path) {
	if (trim($artist) == "") { $artist="Unknown Artist"; }
	if (trim($album) == "") { $album="Unknown Album"; }
	if (trim($title) == "") { $title="Unknown"; }
$user_id=$_SESSION['user_id'];
   mysql_query("INSERT INTO media (`user_id`, `artist`, `album`, `title`, `track`, `path`) VALUES('$user_id','$artist','$album','$title','$track', '$path')");
}


function get_title($row) {
	return $row["title"];
}
function get_playing($row) {
	return $row["title"]. " by ".$row["artist"]." on ".$row["album"];
}
?>
