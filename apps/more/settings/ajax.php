<?php
session_start();
include "../../../includes/db_connect.php";
include "../../../includes/functions.php";

if (isset($_GET['list'])) {
?>
<script type="text/javascript" src="../../../includes/ajax.js"></script>
<table>
<tr>
<th>ID</th>
<th>Name</th>
<th>Edit</th>
<th>Mail</th>
<th>Email</th>
<th>IP</th>
<th>Join Date</th>
<th>Last Active</th>
<th>Inactivity</th>
<th>Level</th>
<th>Ban</th>
<th>Delete</th>
</tr>

<?php
$result = mysql_query("SELECT * FROM users order by id");
while ($row=mysql_fetch_assoc($result)) {
$id = $row['id'];
$username = $row['username'];
$enabled = ($row['isEnabled'] == '1') ? "<a href='javascript:banUser(\"$id\");'>Ban</a>" : "<a href='javascript:unbanUser(\"$id\");'>Unban</a>";
$inactivity = floor((time() - strtotime($row['lastActive']))/86400);

$level = "<select id='level' onchange='setLevel(\"$id\",this.value);'>
<option value='0' ".(($row['level']=="0") ? "selected" : "").">Demo User</option>
<option value='1' ".(($row['level']=="1") ? "selected" : "").">User</option>
<option value='2' ".(($row['level']=="2") ? "selected" : "").">Silver Subscriber</option>
<option value='3' ".(($row['level']=="3") ? "selected" : "").">Gold Subscriber</option>
<option value='4' ".(($row['level']=="4") ? "selected" : "").">Minion</option>
<option value='5' ".(($row['level']=="5") ? "selected" : "").">God</option>
</select>";

echo "<tr style='border:1px solid black;'>
<td>".$row['id']."</td>
<td>".$row['fname']." ".$row['lname']." (".$row['username'].")"."</td>
<td><a href='javascript:editUser(\"$id\");'>Edit</a></td>
<td><a href='javascript:emailFriend(\"".$row['username']."\");'>Mail</a></td>
<td><a href='mailto:".$row['email']."'>".$row['email']."</a></td>
<td><a href='http://".$row['IP']."' target='_blank'>".$row['IP']."</a></td>
<td>".$row['joindate']."</td>
<td>".$row['lastActive']."</td>
<td>".$inactivity." days</td>
<td>".$level."</td>
<td>".$enabled."</td>
<td><a href='javascript:deleteUser(\"$id\");'>Delete</a></td>
</tr>";
}

}

if (isset($_GET['ban'])) {
$result=mysql_query("UPDATE users SET isEnabled='0' WHERE id='".$_GET['id']."'");
}
if (isset($_GET['unban'])) {
$result=mysql_query("UPDATE users SET isEnabled='1' WHERE id='".$_GET['id']."'");
}
if (isset($_GET['level'])) {
$result=mysql_query("UPDATE users SET level='".$_GET['level']."' WHERE id='".$_GET['id']."'");
}
if (isset($_GET['delete'])) {
$result=mysql_query("DELETE FROM users WHERE id='".$_GET['id']."'");
}

?>

