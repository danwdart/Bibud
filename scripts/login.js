 function init() {
document.form.username.focus();
inittext();
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
document.form.password.value="Password";
document.form.password.type="text";
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
