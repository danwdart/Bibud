<?php
session_start();
include 'includes/db_connect.php';
include 'includes/functions.php';
if ($_POST['login'] == "Login") {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $password = sha1($password);
  $result = mysql_query("SELECT * FROM users WHERE lower(username) = lower('$username') AND `password` = '$password'");
  if (mysql_num_rows($result) == 1) {
    # We have login success! Set the variables and go back to index to make them permanent.
    $row=mysql_fetch_assoc($result);
    $_SESSION['username'] = $username;
    $_SESSION['user_id'] = $row['id'];
    # Set includes dir, include file upload servers etc.
    $_SESSION['includes'] = dirname(__FILE__)."/includes";
    $_SESSION['scripts'] = dirname(__FILE__)."/scripts";
    $_SESSION['apps'] = dirname(__FILE__)."/apps";

    $filesdir = dirname(__FILE__)."/user/".$_SESSION['user_id'];
      if (!is_dir($filesdir)) { mkdir($filesdir); }
    $_SESSION['filesdir'] = $filesdir;
    # Now do relative from apps
    $_SESSION['filesapps'] = "../../../user/".$_SESSION['user_id'];
    # Now do relative from root
    $_SESSION['filesroot'] = "user/".$_SESSION['user_id'];
    # Make variables easier to access
    foreach($row as $key => $value) {
      $_SESSION[$key]=$value;
    }
    #if ($isEnabled == 0) { die("You have been banned from the system. Please contact your systems administrator. <a href='index.php'>Return to the home page</a>"); }

    //Inform Bibud about login to disable old accounts
    $lastActive=date("Y-m-d");
    $sql="UPDATE users SET `lastActive`='$lastActive' WHERE username='".$username."';";
    if (!mysql_query($sql)) { log_errors("Warning: Can't set last active date: $username"); }
    # Now set last IP for security
    $sql="UPDATE users SET `IP`='".$_SERVER['REMOTE_ADDR']."' WHERE username='".$username."';";
    if (!mysql_query($sql)) { log_errors("Warning: Can't set last IP."); }
    header("Location: index.php");
  }
  else 	{
  header("Location: index.php?login=0");
  }
}
else {
echo "You cannot run the script like this!";
}
?>
