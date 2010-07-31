<div id="messenger" class="app_small">
<h1>Messenger</h1>
<div id="messenger_offline">
<button onclick="messenger_logon();">Click to start chatting</button>
</div>
<div id="messenger_online">
<button onclick="messenger_logoff();">Click to stop chatting</button>
<p>Who's online:</p>
<div id="messenger_whosonline" style="overflow:auto;"></div>
</div>
<div id="messenger_ims"></div>
</div>


<style type="text/css">
.im {
float:left;
bottom:0px;
width:150px;
height:250px;
}
</style>
<script type="text/javascript">
imonline=0;
var who;
var check;
var online;

function messenger_logon() {
hide ("messenger_offline");
show("messenger_online");
who=setTimeout("messenger_whosonline();",2000);
check=setTimeout("checkIMs();",1000);
imonline=setTimeout("imonline();",30000);
imonline();
}

function messenger_logoff() {
hide ("messenger_online");
show("messenger_offline");
clearTimeout(who);
clearTimeout(check);
clearTimeout(imonline);
imoffline();
}

function messenger_whosonline() {
doAjax("apps/internet/messenger/whosonline.php","messenger_onlinefriends")
}

function checkIMs() {
// Get all messages addressed to you or sent to you by date.
// Split them per person.
doAjax("apps/internet/messenger/checkims.php","messenger_ims");
}

function imonline() {
doAjaxSynchronous("apps/internet/messenger/imonline.php");
}
</script>