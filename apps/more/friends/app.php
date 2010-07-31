<div id="friends" class="app_large">
<!--
Needs to know if you've requested - when you log back in youc an request multiple times
-->

<br />
<script type="text/javascript">
doAjax("apps/more/friends/ajax.php?show","friend_list");
doAjax("apps/more/friends/ajax.php?reqs","friend_reqs");

function refresh_friends() {
doAjax("apps/more/friends/ajax.php?show","friend_list");
}
function refresh_reqs() {
doAjax("apps/more/friends/ajax.php?reqs","friend_reqs");
}
function friends_search() {
doAjax("apps/more/friends/ajax.php?search&string="+document.getElementById('friends_string').value,"friend_search");
}
function friend_add(fuser,id) {
doAjax("apps/more/friends/ajax.php?add&fuser="+fuser,id);
}
function friend_remove(fuser,id) {
doAjax("apps/more/friends/ajax.php?remove&fuser="+fuser,id);
refresh_friends();
}
function friend_accept(fuser,id) {
doAjax("apps/more/friends/ajax.php?accept&fuser="+fuser,id);
refresh_friends();
refresh_reqs();
}
function friend_decline(fuser,id) {
doAjax("apps/more/friends/ajax.php?decline&fuser="+fuser,id);
refresh_reqs();
}
function emailFriend(fuser) {
hideAll();
show('email');
email_new();
document.email_new_form.recipient.value=fuser;
document.email_new_form.subject.focus();
}


</script>

  <div style="width:300px;height:100%;float:left;">
    <h1>Friend List</h1>
    <div id="friend_list"></div>  
  </div>
  <div style="width:350px;height:500px;float:left;">
    <h1>Friend Search</h1>
  
      Search:
      <input type="text" name="friends_string" id="friends_string" />
      <input type="button" value="Search" onclick="friends_search();" />
  
<div id="friend_search" style="height:90%;overflow:auto;"></div>
  </div>
  <div style="width:250px;height:500px;float:left;">
    <h1>Friend Requests</h1>
    <div id="friend_reqs"></div>
  </div>

</div>