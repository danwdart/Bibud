<?
# Request: Generate request to server through cURL or etc...
# Accept: Add the key that's in your pool to your approved keys
# List: List added and approved keys
# For now,  make random keys - not secure, but replace later
# Then make nice graphs of how your computer's doing!

$what = (isset($_GET['what']) ? $_GET['what'] : "list";

if ($what == "list") {
# Get the list of peers through SQL
# Nice little canvas / svg graphs?

}

if ($what == "request") {
	$uuid = uniqid();
	
