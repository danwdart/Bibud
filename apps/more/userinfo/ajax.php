<?php
session_start();
include "../../../includes/db_connect.php";
include "../../../includes/functions.php";

/*
if (isset($_GET['read'])) {
include '../../../dbprivate.php';
$query="SELECT ".$_GET['what']." FROM userinfo LIMIT 1;";
$result=mysql_query($query);
if (!$result)
{
echo "Couldn't grab data.";
mysql_error();
break;
}
$row=mysql_fetch_assoc($result);
echo $row[$_GET['what']];
}
*/
$user_id=$_SESSION['user_id'];

# See If Old Password Correct
$result=mysql_query("SELECT * FROM users WHERE id='$user_id' AND password='".sha1($_GET['oldpassword'])."'");
if (mysql_num_rows($result) == 1) {

if (isset($_GET['write'])) {
	if (($_GET['fname']) != "") {
		$query="UPDATE users SET fname='".$_GET['fname']."' WHERE id='$user_id';";
		$result=mysql_query($query);
		if (!$result) {
			echo "Couldn't set data. ".mysql_error();
			break;
		}
	}
	if (($_GET['username']) != "") {
		$query="UPDATE users SET username='".$_GET['username']."' WHERE id='$user_id';";
		$result=mysql_query($query);
		if (!$result) {
			echo "Couldn't set data. ".mysql_error();
			break;
		}
	}
	if (($_GET['lname']) != "") {
		$query="UPDATE users SET lname='".$_GET['lname']."'  WHERE id='$user_id';";
		$result=mysql_query($query);
		if (!$result) {
			echo "Couldn't set data. ".mysql_error();
			break;
		}
	}
	if (($_GET['email']) != "") {
		$query="UPDATE users SET email='".$_GET['email']."' WHERE id='$user_id';";
		$result=mysql_query($query);
		if (!$result) {
			echo "Couldn't set data. ".mysql_error();
			break;
		}
	}
	if (($_GET['password']) != "") {
   		if ($_GET['password'] == $_GET['password2']) {
			$query="UPDATE users SET password='".sha1($_GET['password'])."' WHERE id='$user_id'";
			$result=mysql_query($query);	
	       		if (!$result) {
				echo "Couldn't set password." .mysql_error();
				break;
      			}	      
			else {
				echo "<br />Set Password<br />";
                	}
	    	}
    		else {
			echo "Passwords do not match.";
    		}
	} // end if get password


echo "Set User Info<br />";
}

else {
echo "You cannot run the script like this!";
}

}

else {
echo "Wrong old password.";

}



?>
