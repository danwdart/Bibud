<div id="background" class="app_small">
<div style="text-align:right;"><a href="#" onclick="hide('background');">Close (X)</a></div>
<script type="text/javascript">
background_refresh();
showBgFiles();
get_repeat();
function setFileAsBg(file) {
doAjaxFunc("apps/more/background/bgfuncs.php?set&file="+file,"background_refresh();");
}
function background_refresh() {
bgfile=doAjaxSynchronous("apps/more/background/bgfuncs.php?refreshbg");
repeatv=doAjaxSynchronous("apps/more/background/bgfuncs.php?getrepeat");
// document.getElementById('apps').style.backgroundColor="black";
// document.getElementById('apps').style.backgroundImage="url('"+bgfile+"')";
// document.getElementById('apps').style.backgroundRepeat=repeatv;
document.body.style.backgroundColor="black";
document.body.style.backgroundImage="url('"+bgfile+"')";
document.body.style.backgroundRepeat=repeatv;
}
function showBgFiles() {
doAjax("apps/more/background/bgfuncs.php?showFiles","background_files");
}
function get_repeat() {
repeatv=doAjaxSynchronous("apps/more/background/bgfuncs.php?getrepeat");
document.getElementById("background_repeat").value=repeatv;
}
function set_repeat() {
repeatv=document.getElementById("background_repeat").value;
doAjaxFunc("apps/more/background/bgfuncs.php?setrepeat&repeat="+repeatv,"background_refresh();");
}

</script>

<h3>Background</h3>
Here you can choose the background picture for your desktop.
<br />You have to upload PNG, JPG or GIF files for this to work.
<br />
<select id="background_repeat" onchange="set_repeat();">
<option value="no-repeat">No Repeat</option>
<option value="repeat-x">Repeat Horizontally</option>
<option value="repeat-y">Repeat Vertically</option>
<option value="repeat">Repeat Both</option>
</select>
<br /><a href="#" onclick="showBgFiles();">Refresh Files</a> <a href="#" onclick="background_refresh();">Refresh BG</a>

<div id="background_files" style="background-color:white;overflow:auto;width:100%;height:50%;">
</div>

</div>
