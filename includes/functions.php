<?php

# Make variables easier to access.
foreach($_SESSION as $key => $value) {
  $$key = $value;
}

function ar2var() {
foreach($_POST as $key=>$value) {
  $$key = $value;
}
foreach($_GET as $key=>$value) {
  $$key = $value;
}
}


function log_file($type,$text) {
  file_put_contents("logs/$type.txt",$text."\n");
}
function log_error($text) {
  log_file("errors",$text);
}

function get_files_in_directory($directory) {
   if (!is_dir($directory)) { return false; }
   $dir_handle = opendir($directory);
	while (false !== ($file = readdir($dir_handle))) {
	   if (is_file($directory . "/" . $file)) {
	      $abs_location = $directory."/".$file;
		   if (substr($file,0,1) != ".") { //dont show hidden files
		      $dir_contents[] = $abs_location;
     	   }
	   }			
	}
	closedir($dir_handle);
		if (isset($dir_contents)) {
		return $dir_contents;
	} else {
		return false;
	}
}
	
function get_directories_in_directory($directory) {
   if (!is_dir($directory)) { return false; }
   $dir_handle = opendir($directory);
	while (false !== ($file = readdir($dir_handle))) {
	   if (is_dir($directory . "/" . $file)) {
	      $abs_location = $directory . "/" . $file;
		   if (substr($file,0,1) != ".") { //dont show hidden directories
		      $dir_contents[] = $abs_location;
     	   }
	   }			
	}
	closedir($dir_handle);

	if (isset($dir_contents)) {
		return $dir_contents;
	} else {
		return false;
	}
}

function get_previous_directory($path) {
	$split = explode("/", $path);
	$count = count($split);

	unset($split[$count - 1]);
	$count = count($split);
	$join = "";
	for ($x = 0; $x < $count; $x++) {
		$join .= $split[$x] . "/";
	}
	
	//trim trailing slash
	$join = substr($join,0,-1);

	return $join;
}

function get_relative_download_path($absolute_file_path) {
   $dirname = dirname(__FILE__);
   $count = strlen($dirname . "/");
	return substr($absolute_file_path, $count);
}

function get_mimetype($absolute_file_path) {
   $exec = "file \"" . $absolute_file_path . "\" -b -i";
   $ret= exec($exec);
   $rets = explode(" ",$ret);
   return trim($rets[0]);
}
function get_filetype($absolute_file_path) {
$exec = "file \"" . $absolute_file_path . "\" -b";
$type = exec($exec);
/*
if (stristr($type,"vorbis") !== false) {
return "Vorbis";
}
elseif (stristr($type,"theora") !== false) {
return "Theora";
}
elseif (stristr($type,"text") !== false) {
return "Text";
}
else {
*/
return get_mimetype($absolute_file_path);
/*}*/
}


function execute_query($query) {
    return mysql_query($query);
// echo $userdbname." ".$_COOKIE['userdbname']." ".$globalhost." ".$query;
}



?>
