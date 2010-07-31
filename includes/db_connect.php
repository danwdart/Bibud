<?
# In future make setup program set this up.

$server = "localhost";
$username = "bibud";
$password = "koolsound";
$db = "bibud";

if (!mysql_connect($server,$username,$password)) {
  die("Could not connect to the database. Please check the database settings.");
}
if (!mysql_select_db($db)) {
  die("Could not select the database. Please check the database settings.");
}
$_GET = array_map("mysql_real_escape_string",$_GET);
$_POST = array_map("mysql_real_escape_string",$_POST);
//$_SERVER = array_map("mysql_real_escape_string",$_SERVER);
?>
