<?php include"header.php"?>
<p><b>Last 10 changes:</b></p>
<?
$con = file_get_contents("http://github.com/dandart/Bibud/commits/master.atom");
$arr = new SimpleXMLElement($con);
$count=0;
foreach ($arr->entry as $entry) {
	$count++;
	echo "<a href='".$entry->link['href']."'>".$entry->title."</a><br />";
	if ($count >=10) { break; }
}
?>
<?php include"footer.php"?>
