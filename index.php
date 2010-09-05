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
<audio><div class="compwarn">It looks like your browser lacks HTML5 support. You may experience some loss of functionality, including the lack of ability to play audio and video. We recommend you upgrade your browser to a more standards-compliant one. For example, <a href="http://getfirefox.com">Mozilla Firefox</a> or <a href="http://google.com/chrome">Google Chrome</a></div></audio>
<div id="oggSupport" class="compwarn">Your browser does not contain the standard codecs required for audio and video in HTML5 (Ogg). If you wish to continue, please make sure you have Ogg support installed - you can find an installer at <a href="http://www.xiph.org/quicktime/download.html">the Xiph website</a>. You could also install a browser with this built in - such as <a href="http://getfirefox.com">Mozilla Firefox</a> or <a href="http://google.com/chrome">Google Chrome</a>
</div>
<div id="login">
<form name="form" action="login.php" method="post" onSubmit="return validate();">
<?php echo $badlogin; ?>
<input type="hidden" name="login" value="Login" /> 
<input type="text" name="username" id="username" class="text" value="Username" onClick="clickuser();" onFocus="clickuser();" onBlur="bluruser();"/>
<br />
<input type="text" name="password" id="password" class="text" value="Password" onClick="clickpass();" onFocus="clickpass();" onBlur="blurpass();"/> 
<br />
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
<a href="javascript:document.Demo.submit();">Demo</a>
</li>

</ul>
<?php include"footer.php";?>
<? } ?>