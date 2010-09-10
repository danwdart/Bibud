function init() {
	document.form.username.focus();
	inittext();
	if(!supports_ogg){
		document.getElementById("oggSupport").style.display = "block";
	}
	if (getCookie('username') != "") {
		document.form.save.checked='1';
		document.form.username.value=getCookie('username');
		// And give them focus
		clickpass();
		clickuser();
		document.form.password.value=getCookie('password');
	}
}

function getCookie(c_name)
{
if (document.cookie.length>0)
  {
  c_start=document.cookie.indexOf(c_name + "=");
  if (c_start!=-1)
    {
    c_start=c_start + c_name.length+1;
    c_end=document.cookie.indexOf(";",c_start);
    if (c_end==-1) c_end=document.cookie.length;
    return unescape(document.cookie.substring(c_start,c_end));
    }
  }
return "";
}

function supports_video() {
  return !!document.createElement('video').canPlayType;
}
function supports_ogg() {
	if (!supports_video()) { return false; }
	var v = document.createElement("video");
	return v.canPlayType('video/ogg; codecs="theora, vorbis"');
}
function register() {
window.location="register.php";
}
function forgot() {
window.location="forgot.php";
}
function demo() {
document.form.username.value="demouser";
document.form.password.value="demopass";
}

function clickuser() {
if (document.form.username.value==document.form.username.defaultValue) {
document.form.username.value="";
document.form.username.style.color="#000000";
}
}

function clickpass() {
if (document.form.password.value==document.form.password.defaultValue) {
document.form.password.value="";
document.form.password.type="password";
document.form.password.style.color="#000000";
}
}

function bluruser() {
if (document.form.username.value=="") {
document.form.username.value="Username";
document.form.username.style.color="#999999";
}
}

function blurpass() {
if (document.form.password.value=="") {
document.form.password.type="text";
document.form.password.value="Password";
document.form.password.style.color="#999999";
}
}
function inittext() {
if (document.form.username.value != document.form.username.defaultValue) {
document.form.username.style.color="#000000";
}
if (document.form.password.value != document.form.password.defaultValue) {
document.form.password.style.color="#000000";
}
}
function validate() {
if (document.form.username.value == "" || document.form.password.value == "") {
alert ("You can't have empty values!");
return false;
}
else {
return true;
}
}
