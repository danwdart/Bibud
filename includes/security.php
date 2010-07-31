 <?php
$_GET = array_map('trim', $_GET);
$_POST = array_map('trim', $_POST);
$_COOKIE = array_map('trim', $_COOKIE);
$_REQUEST = array_map('trim', $_REQUEST);

/*if(get_magic_quotes_gpc()) {
    $_GET = array_map('stripslashes', $_GET);
    $_POST = array_map('stripslashes', $_POST);
    $_COOKIE = array_map('stripslashes', $_COOKIE);
    $_REQUEST = array_map('stripslashes', $_REQUEST);
} */

if ($dbcnx == true || $dbcnxu == true) {
 $_GET = array_map('mysql_real_escape_string', $_GET);
 $_POST = array_map('mysql_real_escape_string', $_POST);
 $_COOKIE = array_map('mysql_real_escape_string', $_COOKIE);
 $_REQUEST = array_map('mysql_real_escape_string', $_REQUEST);
}


function filterprot($var,$regex) {
	$var = stripslashes($var);

	$var = mysql_real_escape_string($var);

	if (preg_match($regex,$var)) {
		return $var;
	}
	else {
		return false;
	}
}

function makesafe($var) {
return filterprot($var,'/^[a-zA-Z0-9._\-]+$/');
}
function safehtml($value){
    $value = htmlspecialchars(trim($value));
    if (get_magic_quotes_gpc()) 
        $value = stripslashes($value);
    return $value;
}


?>
