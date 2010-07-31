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
<!DOCTYPE html>
<html>
<head>
<meta name="keywords" 
content="bibud,byebud,internet,social,operating,system,html5,php,mysql,javascript,css,website,audio,video,chat,blog,email,friends,platform" 
/>
<meta name="description" content="Bibud: the social web desktop. 
Includes audio and video players, email, blog, chatroom and much more." 
/>
<title>Bibud</title>
<script type="text/javascript" src="scripts/login.js"></script>
<link rel="stylesheet" type="text/css" href="styles/login.css" />
</style>
</head>
<body onload="init();">
<div id="content">
  <img src="images/bibud.png" alt="Bibud logo" style="height:200px;margin:0 100px;"/>
  <form name="form" action="login.php" method="post" onsubmit="return validate();">
<p style="color:purple;font-weight:700;">Alpha 5</p>
    <?php echo $badlogin; ?>
    <input type="hidden" name="login" value="Login" />
    <input type="text" name="username" id="username" class="text" value=" Username " onclick="clickuser();" onfocus="clickuser();" onblur="bluruser();"/>
    <br /><br />
    <input type="text" name="password" id="password" class="text" value=" Password " onclick="clickpass();" onfocus="clickpass();" onblur="blurpass();"/>
    <br /><br />
	<input type="image" src="images/login.png" alt="Login" onclick="return validate();"/>
	<a href="javascript:register();"><img src="images/register.png" alt="Register" /></a>
	<!--<a href="javascript:forgot();"><img src="images/forgot.png" alt="Forgot Password" /></a> -->
  </form>
  <form name="demo" action="login.php" method="post">
    <input type="hidden" name="login" value="Login" />
    <input type="hidden" name="username" value="demouser" />
    <input type="hidden" name="password" value="demopass" />
    <a href="javascript:document.demo.submit();"><img src="images/demo.png" alt="Demo" /></a>
  </form>
<audio><div style="color:red;">Warning: it looks like your browser lacks HTML5 support. You may experience some loss of functionality, including the lack of ability to play audio and video. We recommend you upgrade your browser to a more standards-compliant one. For example, <a href="http://getfirefox.com">Mozilla Firefox</a> or <a href="http://google.com/chrome">Google Chrome</a></div></audio>
<?php 

/*if (stristr($_SERVER['HTTP_USER_AGENT'], "safari")) { ?>
<div style="color:red;">Warning: it looks like you are using Apple Safari: this browser does not by default contain the audio and video codecs recommended in the initial drafts of the HTML5 standard (Ogg). However this is the standard that the system uses. If you wish to continue, please make sure you have Ogg support installed - you can find a package at <a href="http://www.xiph.org/quicktime/download.html">the Xiph website</a>. You could also install a browser with this built in - such as <a href="http://getfirefox.com">Mozilla Firefox</a> or <a href="http://google.com/chrome">Google Chrome</a>
</div>
<?php 
} 
*/?>
</div>
</div>
</body>
</html>
<? } ?>
