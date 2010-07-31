<!--

PHP Registered Script.
This needs extra security.
TODO:
Add md5 BEFORE sending.
Alternatively just add SSL.

-->

<html>
<head>
<title>Bibud - Registered</title>
<style type="text/css">
body {
color: black;
background-color: white;
}
#indent {
position: absolute;
right: 100px;
}
</style>
</head>
<body>
<?php
include 'includes/db_connect.php';


if ($_POST['submit'] == "Register") {

	// getting variables from userinput
	$username = $_POST['username'];
	$password = $_POST['password'];
	$firstname = $_POST['fname'];
	$lastname = $_POST['lname'];
	$email = $_POST['email']; 
	

#	$username = filterprot($username,'/^[a-zA-Z0-9._\-]+$/');
#	$password = filterprot($password,'/^[a-zA-Z0-9@#$%^&+=\-!]+$/');
#	$firstname = filterprot($firstname,'/^[a-zA-Z0-9._\-]+$/');
#	$lastname = filterprot($lastname,'/^[a-zA-Z0-9._\-]+$/');
#	if ($email) { // email is optional
#		$email = filterprot($email,'/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.]+\.[a-zA-Z0-9]+$/');
#	}
#	else { $email = True; } // 'True' that it contains no dangerous code

	// if all goes well, allow more actions to be taken
	if ($username && $password && $firstname && $lastname) {
	    $password = sha1($password);
	$q_userinfo = "INSERT INTO `users` (`username`,`password`,`fname`,`lname`,`email`,`useragent`,`IP`,`joindate`,`isEnabled`,`level`,
	    `lastActive`,`theme`,`background`,`background_repeat`) VALUES (
		 '$username','$password','$firstname','$lastname','$email','".$_SERVER['HTTP_USER_AGENT']."','".$_SERVER['REMOTE_ADDR']."',
		  '".date("Y-m-d")."','1','1','".date("Y-m-d")."','default','../../desktop/default/emotion1.jpg','none');";


		$result=mysql_query($q_userinfo);
		if (!$result) {
			echo("Can't insert userinfo! Error performing query: " .
			mysql_error() );
			exit();
		}

		else {
			echo ("You have successfully registered. <a href='index.php'>Return to main page</a>");
		}
	}

	else {
		echo "Error: Illegal characters";
	}
}

else {
	echo ("You cannot run this script like this.");
}

?>

</body>
</html>
