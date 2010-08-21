<div id="email" class="app_large">

<script type="text/javascript">
<!--
var emailNic;
bkLib.onDomLoaded(function() {emailNic= new nicEditor({iconsPath : 'scripts/nicEditorIcons.gif'}).panelInstance('email_text');
doAjax("apps/internet/email/getMsgs.php?page=1","email_msgs");
 });

function wygonemail() {
emailNic=new nicEditor({iconsPath : 'scripts/nicEditorIcons.gif'}).panelInstance("email_text");
}
function wygoffemail() {
emailNic.removeInstance("email_text");
}
function email_submit() {
document.getElementById('email_new').style.display="none";
wygoffemail();
doAjaxFunc('apps/internet/email/submit.php?recipient='+document.email_new_form.recipient.value+'&subject='+document.email_new_form.subject.value+'&text='+document.email_new_form.email_text.value,'hidesender_email();');
wygonemail();
}

doAjax("apps/internet/email/getMsgs.php?page=1","email_msgs");
function hidesender_email() {
document.email_new_form.reset();
document.getElementById('email_new').style.display="none";
doAjax("apps/internet/email/getMsgs.php?page=1","email_msgs");
}

function deleteEmail(id) {
doAjaxFunc("apps/internet/email/emailFuncs.php?del&id="+id,"email_refresh();");
}
function replyEmail(id) {
wygoffemail();
document.email_new_form.email_text.value=trim(doAjaxSynchronous("apps/internet/email/emailFuncs.php?quote&id="+id));
document.email_new_form.recipient.value=trim(doAjaxSynchronous("apps/internet/email/emailFuncs.php?getSender&id="+id));
document.email_new_form.subject.value="Re: " + trim(doAjaxSynchronous("apps/internet/email/emailFuncs.php?getSubject&id="+id));
wygonemail();
document.getElementById("email_new").style.display="block";
}

function forwardEmail(id) {
wygoffemail();
document.email_new_form.email_text.value=trim(doAjaxSynchronous("apps/internet/email/emailFuncs.php?quote&id="+id));
document.email_new_form.recipient.value="";
document.email_new_form.subject.value="Fw: " + trim(doAjaxSynchronous("apps/internet/email/emailFuncs.php?getSubject&id="+id));
wygonemail();
document.getElementById("email_new").style.display="block";
}

function email_refresh() {
doAjax('apps/internet/email/getMsgs.php','email_msgs');
}

function email_new() {
wygoffemail();
document.email_new_form.reset();
wygonemail();
document.getElementById('email_new').style.display="block";
}

// -->
</script>

<!--<a href="#" onclick="hide('email');">Close</a>
&nbsp;&nbsp;&nbsp;&nbsp;-->
<a href="#" onclick="email_new();">New Message</a>
&nbsp;&nbsp;&nbsp;&nbsp;
<a href="#" onclick="email_refresh();">Refresh</a>
<br />
<h2>Inbox:</h2>
<br />

  <div id="email_msgs" style="overflow:auto;height:450px;">
  </div>

<div id="email_new" style="display:none;position:absolute;width:400px;left:550px;top:0px;">
<h2>New Message</h2>
<form name="email_new_form">
<br />To:<br /><input type="text" name="recipient">
<br />Subject:<br /> <input type="text" name="subject" id="subject" />
<br />Text:<br /> <textarea name="email_text" id="email_text" style="width:400px;height:250px;"></textarea>
<br /><input type="button" onclick="email_submit();" value="Send">
<input type="button" onclick="hidesender_email();" value="Discard" />
</form>
</div>


</div>
