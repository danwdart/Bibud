<div id="settings" class="app_large">
<script type="text/javascript">
doAjax("apps/more/settings/ajax.php?list","settings_userlist");

function settings_refresh_users() {
doAjax("apps/more/settings/ajax.php?list","settings_userlist");
}
function banUser(id) {
doAjaxFunc("apps/more/settings/ajax.php?ban&id="+id, "settings_refresh_users();");
}
function unbanUser(id) {
doAjaxFunc("apps/more/settings/ajax.php?unban&id="+id, "settings_refresh_users();");
}
function setLevel(id,level) {
doAjaxFunc("apps/more/settings/ajax.php?level="+level+"&id="+id, "settings_refresh_users();");
}
function deleteUser(id) {
if (confirm("Really delete user?")) {doAjaxFunc("apps/more/settings/ajax.php?delete&id="+id, "settings_refresh_users();");}
}
</script>
List of users:
<br />
<br /><a href="#" onclick='doAjax("apps/more/settings/ajax.php?list","settings_userlist");'>Refresh</a><br />
<div id="settings_userlist" style="height:80%; overflow:auto;">
Loading user list...
</div>

</div>
