<div id="appstore" class="app_large">
<p>Here is a list of all apps currently installed:</p>
<p>
<pre>
<?
$dir = "apps/";
if ($dh = opendir($dir)) {
	while (($file = readdir($dh)) !== false) {
		if ($file != "." && $file != "..") {
		//	echo "$file:\n";
			if (filetype($dir . $file) == "dir") {
				$dh2 = opendir($dir . $file."/");
				while ($file2 = readdir($dh2)) {
					if ($file2 != "." && $file2 != "..") {	
					// include $dir.$file."/".$file2."/app.php";
//						echo "\t<a href='show(\"$file2\");'>$file2</a> \n";
$text .=$file2.", ";
					}
				}
			}
		}
	}
}
echo wordwrap($text,72,"<br />");
?>
</pre>


</div>
