<style>
.indent {
left:175px;
position:absolute;
}
</style>

<script type="text/javascript">
function userinfo_apply() {
//prompt for old password.
//if old password not ok then error
//if passwords are blank then ok
//if passwords are not the same then not ok
//if passwords the same then ok
doAjax("apps/more/userinfo/ajax.php?write&oldpassword="+document.userinfo_details.oldpassword.value+"&password="+document.userinfo_details.password.value+"&password2="+document.userinfo_details.password2.value+"&fname="+document.userinfo_details.fname.value+"&lname="+document.userinfo_details.lname.value
+"&username="+document.userinfo_details.username.value
+"&email="+document.userinfo_details.email.value,"userinfo_status");
}
</script>

<div id="userinfo" class="app_large">


<h3>User Info</h3>
You can change your details here.
<div style="line-height:175%;">
<form name="userinfo_details">
<p>To change your details, you must enter your old password. If you wish to set
<br />a new password, you may do by entering it twice in the provided boxes.</p>
<br /><label for="oldpassword">Old Password:</label><input class="indent" type="password" name="oldpassword" />
<br />
<br /><label for="username">Username:</label><input class="indent" type="text" name="username" value="<?php echo $username; ?>" />
<br /><label for="password">New Password:</label><input class="indent" type="password" name="password" />
<br /><label for="password2">New Password again:</label><input class="indent" type="password" name="password2" />
<br /><label for="fname">First Name:</label><input class="indent" type="text" name="fname" value="<?php echo $fname; ?>" />
<br /><label for="lname">Last Name:</label><input class="indent" type="text" name="lname" value="<?php echo $lname; ?>" />
<br /><label for="email">Email:</label><input class="indent" type="text" name="email" value="<?php echo $email; ?>" />
<br /><input type="button" value="Apply"  onclick="userinfo_apply();"/>
</form>
<br /><div id="userinfo_status"></div>
</div>
</div>

