<?php
include("apps/internet/messenger/xmpphp/XMPP.php");
$xmppaddress=explode("@",$username);
$xmppuser=$xmppaddress[0];
$xmppdomain=$xmppaddress[1];
$conn = new XMPP($_GET['server'], $_GET['port'], $xmppuser, $_GET['password'], $_GET['bibud'], $xmppdomain, $printlog=False, $loglevel=LOGGING_INFO);
if (!conn) {
echo "Not OK";
}
else {
$conn->connect();
$conn->processUntil('session_start');
echo "OK";
}
?>