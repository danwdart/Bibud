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
<div id="login">
<form name="form" action="login.php" method="post" onSubmit="return validate();">
<?php echo $badlogin; ?>
<input type="hidden" name="login" value="Login" /> 
<input type="text" name="username" id="username" class="text" value="Username" onClick="clickuser();" onFocus="clickuser();" onBlur="bluruser();"/>
<br />
<input type="text" name="password" id="password" class="text" value="Password" onClick="clickpass();" onFocus="clickpass();" onBlur="blurpass();"/> 
<br />
<input type="submit" class="submit" value="Login"/>
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
<a href="javascript:document.Demo.submit();">Demo</a>
</li>

</ul>
<ul class="users">
<li>
<a href="/register.php">Register</a>
</li>
</ul>
<?php include"footer.php";?>
<? } ?>