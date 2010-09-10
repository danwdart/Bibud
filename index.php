<?php
session_start();
if (isset($_GET['badlogin'])) {
  $badlogin = "<span style='color:red;'>Incorrect username or password. Please try again.</span>";
}
else {
  $badlogin="";
}
if (isset($_SESSION['user_id'])) {
  foreach ($_SESSION as $key=>$value) {
    $$key=$value;
  }
  include 'includes/bibudui.php';
}
else {
?>
<?php include"header.php"?>
<audio>
<p class='color; orange;'>Warning: some features such as Audio and Video will not work until you upgrade your browser.</p>
<p>Supported browsers:</p>
<p>Firefox 3.5+, Internet Explorer 9+ (with WebM plugin), Chrome 3+, Opera 10.50+, Safari 5+ (with Quicktime plugin)</p>
</audio>
</div>
<div id="login">
<form name="form" action="login.php" method="post" onSubmit="return validate();">
<?php echo $badlogin; ?>
<input type="hidden" name="login" value="Login" /> 
<input type="text" name="username" id="username" class="text" value="Username" onClick="clickuser();" onFocus="clickuser();" onBlur="bluruser();"/>
<br />
<input type="text" name="password" id="password" class="text" value="Password" onClick="clickpass();" onFocus="clickpass();" onBlur="blurpass();"/> 
<br />
<input type="checkbox" name="save" id="save" /><label for="save">Save username and password</label>
<br />
<!--<input type="checkbox" name="autologin" id="autologin" /><label for="autologin">Login automatically</label>
<br /> -->
<input type="submit" class="submit" value="Login"/>
<input type="button" onClick="window.location.href='/register.php'" class="submit" value="Register"/>
<br />
</form>
</div>
<ul class="users">
<li>
<form name="Demo" action="login.php" method="post"> 
    <input type="hidden" name="login" value="Login" /> 
    <input type="hidden" name="username" value="demouser" /> 
    <input type="hidden" name="password" value="demopass" /> 
</form>
<a href="javascript:document.Demo.submit();" style='text-align:center;'>Try out the system without logging in</a>
</li>

</ul>
<?php include"footer.php";?>
<? } ?>
