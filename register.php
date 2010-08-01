<?php include"header.php"?>
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
<div class="registration">
<form action="registered.php" method="post" onSubmit="return verify();" >
<br /><label><span style="color:#F00;font-size:12px;">*</span>Username</label><input type="text" name="username" />
<br /><label><span style="color:#F00;font-size:12px;">*</span>First Name</label><input type="text" name="fname" />
<br /><label><span style="color:#F00;font-size:12px;">*</span>Last Name</label><input type="text" name="lname" />
<br /><label><span style="color:#F00;font-size:12px;">*</span>Password</label><input type="password" name="password" />
<br /><label><span style="color:#F00;font-size:12px;">*</span>Repeat Password</label><input type="password" name="password2" />
<br /><label>Email Address</label><input type="text" name="email" />
<br /><label></label><input type="submit" name="submit" value="Register" />
</div>
<p style="font-size:12px;">fields marked with a <span style="color:#F00;">*</span> are required</p>
</form>
<?php include"footer.php"?>