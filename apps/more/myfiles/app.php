<div id="myfiles" class="app_large">
<!--<a href="#" onclick="hide('myfiles');">Close</a>-->
<script type="text/javascript">
myfiles_refresh();
function myfiles_refresh() {
doAjax("apps/more/myfiles/filesfuncs.php?refresh","myfiles_files");
}
</script>

<h3>My Files</h3>
Here you can upload and download your files on the server!
<br />Maximum File Size is 2MB for now.

<br /><a href="#" onclick="myfiles_refresh();">Refresh</a>
<br />
<div id="myfiles_files" style="background-color:white;width:500px;height:250px;overflow:auto;">
</div>
<br />


<form name="upload" enctype="multipart/form-data" method="post" action="apps/more/myfiles/filesfuncs.php?upload" target="myfiles_upload_iframe">
<input type="file" name="file">
<input type="submit" name="upload_button" value="Upload">
</form>
<iframe  src="about:blank" id="myfiles_upload_iframe" name="myfiles_upload_iframe" style="border-style:none;width:500px;height:30px;"></iframe>
</div> 
