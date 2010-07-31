<div id="chatroom" class="app_large">
  <h1>Chatroom</h1>
  <div id="chatroom_offline" >
    <button onclick="chatroom_logon();">Click to start chatting</button>
  </div>
  <div id="chatroom_online" style="display:none;">
    <button onclick="chatroom_logoff();">Click to stop chatting</button>
    <br />
    <div id="chatroom_left" name="chatroom_left"  style="width:73%;height:500px;padding:5px;float:left;overflow:auto;">
      <div id="chatroom_ims" name="chatroom_ims"  style="height:440px;background-color:white;overflow:auto;"></div>
      <form name="chatroom" action="#"><input type="text" name="chattext" id="chattext" style="width:60%;"><input type="submit" name="send" value="Send" onclick="chnewim();return false" /></form>
    </div>
    <div id="chatroom_right" name="chatroom_right"  style="width:23%;height:500px;padding:5px;float:left;overflow:auto;">
      <p>Who's online:</p>
      <div id="chatroom_whosonline">Coming Soon!</div>
    </div>
  </div>
<script type="text/javascript">

var chwho;
var chcheck;
var chmeonline;

function chatroom_logon() {
document.getElementById('chatroom_offline').style.display="none";
document.getElementById('chatroom_online').style.display="block";
chcheckIMs();
chimonline();
chatroom_whosonline();
document.chatroom.chattext.focus();
}

function chatroom_logoff() {
document.getElementById('chatroom_online').style.display="none";
document.getElementById('chatroom_offline').style.display="block";
doAjaxReturn("apps/internet/chatroom/logoff.php"); // Close down daemon!
clearTimeout(chwho);
clearTimeout(chcheck);
clearTimeout(chmeonline);

}

function chatroom_whosonline() {
doAjax("apps/internet/chatroom/whosonline.php","chatroom_whosonline");
chwho=setTimeout("chatroom_whosonline();",4000);
}

function chcheckIMs() {
// NO: Get all messages addressed to you or sent to you by date.
// NO: Split them per person.
doAjaxAndFunc("apps/internet/chatroom/checkims.php","chatroom_ims","chscroll();");
chcheck=setTimeout("chcheckIMs();",1500);
}

function chimonline() {
doAjaxReturn("apps/internet/chatroom/imonline.php");
chmeonline=setTimeout("chimonline();",4000);
}

function chnewim() {
doAjaxFunc("apps/internet/chatroom/newim.php?text="+document.chatroom.chattext.value,"chcheckIMs();");
// Make yours appear now. Eliminate any appearance of lag. document.getElementById('chatroom_ims')
document.chatroom.chattext.value="";
document.chatroom.chattext.focus();
}

function chscroll() {
var bob = document.getElementById("chatroom_ims");
bob.scrollTop=bob.scrollHeight+50;
}
</script>

</div>

