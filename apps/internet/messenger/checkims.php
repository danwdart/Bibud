<?php
include '../../../dbpublic.php';
$query="SELECT from,to,text,date FROM messenger WHERE from='.$_COOKIE['username'].' OR to='.$_COOKIE['username'].' SORT BY date;";
$result=mysql_query($query);
while ($row=mysql_fetch_assoc($result) {
//For each user, create a new frame. So sort by user


}