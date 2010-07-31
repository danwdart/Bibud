<?php
include '../../../dbpublic.php';
/*
  	id  	int(11)  	 	  	No  	None  	auto_increment  	  Browse distinct values   	  Change   	  Drop   	  Primary   	  Unique   	  Index   	 Fulltext
	timestamp 	int(11) 			No 	None 		Browse distinct values 	Change 	Drop 	Primary 	Unique 	Index 	Fulltext
	username 	varchar(20) 	latin1_swedish_ci 		No 	None 		Browse distinct values 	Change 	Drop 	Primary 	Unique 	Index 	Fulltext
	location 	varchar(256) 	latin1_swedish_ci 		No 	None 		Browse distinct values 	Change 	Drop 	Primary 	Unique 	Index 	Fulltext
	title 	varchar(128) 	latin1_swedish_ci 		No 	None 		Browse distinct values 	Change 	Drop 	Primary 	Unique 	Index 	Fulltext
	description 	varchar(1024) 	latin1_swedish_ci 		No 	None 		Browse distinct values 	Change 	Drop 	Primary 	Unique 	Index 	Fulltext
	tags 	varchar(512) 	latin1_swedish_ci 		No 	None 		Browse distinct values 	Change 	Drop 	Primary 	Unique 	Index 	Fulltext
	views 	int(11) 			No 	None

*/


if (isset($_GET['add'])) {
$sql="INSERT INTO videos SET username='$username', 
}

if (isset($_GET['remove'])) {

}

if (isset($_GET['edit'])) {

}

if (isset($_GET['search'])) {

}

if (isset($_GET['comment'])) {

}

if (isset($_GET['delcomment'])) {

}
?>