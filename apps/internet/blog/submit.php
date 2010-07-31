<?php
session_start();
include "../../../includes/db_connect.php";
include "../../../includes/functions.php";

if ($_GET['text'] != "") {
	if (!mysql_query ("INSERT INTO blog (author_id,title,text,date) VALUES ('$user_id','".$_GET['title']."','".$_GET['text']."','".date('Y-m-d')."');")) {
	echo ("Not OK");
	}
}
// echo (mysql_error());
?>