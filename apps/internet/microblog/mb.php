<?php
// Give it some SSL, man.
$ch = curl_init();
if ($_GET['service']=="identica") {
curl_setopt($ch, CURLOPT_URL, "http://identi.ca/api/statuses/update.xml");
}
elseif ($_GET['service']=="twitter") {
curl_setopt($ch, CURLOPT_URL, "http://twitter.com/statuses/update.xml");
}
else {
curl_setopt($ch, CURLOPT_URL, "http://".$_GET['service']."/statuses/update.xml");
}
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_POSTFIELDS, "source=bibud&status=".$_GET['status']);
curl_setopt($ch, CURLOPT_USERAGENT, "Bibud a4");
curl_setopt($ch, CURLOPT_USERPWD, $_GET['user'].":".$_GET['pass']);
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
$output = curl_exec($ch);
curl_close($ch);     
echo $output;
?>
