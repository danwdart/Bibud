<?php include"header.php"?>
<script type="text/javascript">
function themeExpand(){
	if(document.getElementById("themeopp").style.display == "none"){
	document.getElementById("themeopp").style.display = "block"
	}else{
		document.getElementById("themeopp").style.display = "none"
	}
}
</script>
<div id="loginsettings">
<p>Please note that these options are not yet implemented.</p>
<form action="index.php" method="post">
<label>Login automaticaly</label><input type="checkbox" name="autoLogin"/>
<br /><label>User list</label><input type="checkbox" name="Userlist"/>
<br /><label>Login showen</label><input type="checkbox" name="Loginshow"/>
<br /><label>Demo user showen</label><input type="checkbox" name="showdemo"/>
<br /><a href="javascript:themeExpand()"><img src="treenode_expand_plus.gif"/>Show theme options</a>
<div style="display:none;" id="themeopp">
<label>Background colour: #</label><input type="text" name="autoLogin" maxlength="6" style="width:70px;"/>
<br /><label>Text colour: #</label><input type="text" name="Userlist" maxlength="6" style="width:70px;"/>
<br /><label>Login showen: </label><input type="checkbox" name="Loginshow" />
</div>
<br /><input type="submit" name="submit" value="Save"/>
</form>
</div>
<?php include"footer.php";?>