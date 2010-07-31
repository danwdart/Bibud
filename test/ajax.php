<?php

if (isset($_GET['artist'])) {
	$text = file_get_contents("http://api.jamendo.com/get2/id+name+url+image+artist_name/artist/json/?n=50&searchquery=".$_GET['artist']."&order=listened");
	$arr = json_decode($text,1);
	foreach ($arr as $el) {
		echo $el['name']."<br />";
	}
}

if (isset($_GET['album'])) {
	$text = file_get_contents("http://api.jamendo.com/get2/id+name+url+image+artist_name/album/json/?n=50&searchquery=".$_GET['album']."&order=listened");
	$arr = json_decode($text,1);
	foreach ($arr as $el) {
		echo $el['name']."<br />";
	}
}



?>
