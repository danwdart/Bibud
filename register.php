<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<!-- <link rel="stylesheet" type="text/css" href="register.css" />-->
<style type="text/css">
label {
  width:200px;
  text-align:right;
  padding:2px;
}
</style>
<meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
<title>Bibud - Register</title>
<script type="text/javascript">
<!--
function verify() {
if ( document.newuser.password.value != document.newuser.password2.value) {
alert ("Passwords not the same. Please enter the same password twice.");
return false;
}
if ( document.newuser.password.length < 6 )
{
alert ("Your password must be at least 6 characters in length.");
return false;
}
if ( document.newuser.username.value == "" ||
document.newuser.fname.value == "" ||
document.newuser.lname.value == "" ||
document.newuser.password.value == "" ||
document.newuser.email.value == "" )
{
alert ("You have not filled in all required fields.");
return false;
}
else
{
return true;
}
// -->
</script>
</head>
<body>
<div class="main">
<h1>Registration</h1>
<form action="registered.php" method="post" onSubmit="return verify();" >
<br /><label>Username</label><input type="text" name="username" />
<br /><label>First Name</label><input type="text" name="fname" />
<br /><label>Last Name</label><input type="text" name="lname" />
<br /><label>Password</label><input type="password" name="password" />
<br /><label>Repeat Password</label><input type="password" name="password2" />
<br /><label>Email Address (optional)</label><input type="text" name="email" />
<br /><label></label><input type="submit" name="submit" value="Register" />
</div>
</form>
</body>
</html>