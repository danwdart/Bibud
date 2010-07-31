<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
<title>Bibud Web Desktop</title>
<link rel="stylesheet" type="text/css" href="styles/bibud.css" />
<script type="text/javascript" src="scripts/bibud.js"></script>
<script type="text/javascript" src="scripts/ajax.js"></script>
<script type="text/javascript" src="scripts/nicEdit.js"></script>
</head>
<body onLoad="init();">

<div id="button_out">
<div id="buttons">

<div class="tab" id="desktoptab"><a href="#" onClick="chgcol(this);hideAll();"><img src='default/desktop.png' style='height:48px;width:48px;border:none;' />Desktop</a></div>

<?   
$directory = "apps";
$includes = array();
if (!is_dir($directory)) { return false; }
   $apps_handle = opendir($directory);
	while (false !== ($cat = readdir($apps_handle))) { // Read categories
		if (is_dir($directory."/".$cat)) {
			$cats_handle = opendir($directory."/".$cat);
				while (false !== ($app = readdir($cats_handle))) { // Read each app dir
					if (is_dir($directory."/".$cat."/".$app)) {
						if (is_file($directory."/".$cat."/".$app."/app.xml")) {
							// Parse XML of each app now.
$appxml = $directory."/".$cat."/".$app."/app.xml";
$xml=simplexml_load_file($appxml);
$app = $xml->app;
	$title = $app->title;
	$longname = $app->longname;
	$desc = $app->description;			
	$shortname = $app->shortname;
	$category = $app->category;
	$minlevel = $app->minlevel;
	$icon = $app->icon;
	$iconpath = "$directory/$category/$shortname/$icon";
	if ($level >= $minlevel) {
		echo "<div class='tab'><a href='#' onClick='chgcol(this);show(\"$shortname\");'><img src='$iconpath' style='height:48px;width:48px;border:none;' alt='$longname - $desc'/>$title</a></div>";
		// Now, what do we have to include?
		$includes[] = "$directory/$category/$shortname/app.php";
}}}}}}
?>


<div class="tab" style="float:right;"><a href="logout.php"><img src='default/logout.png' style='height:48px;width:48px;border:none;' />Logout</a></div>


</div>
</div>

<div id="apps">
<div style="background-color:#dddddd;top:50px;left:50px;width:400px;height:300px;position:absolute;padding:5px;z-index:-1;border-style:ridge;">
<b>Welcome to Bibud Web Desktop.</b>
<br /><br />You are logged in as <?php echo $username." (".$fname." ".$lname.")"; ?>.
<br /><br /><b>New:</b> Alpha 5 features easier app APIs, standalone apps, security and bugfixes
<br /><br /><b>Coming soon:</b> Media sharing and web APIs
</div>


<?php
// TODO: SQL to see which apps are enabled and get their info, then display menu
foreach ($includes as $inc) {include $inc;}
?>
</div>
</body>
</html>
