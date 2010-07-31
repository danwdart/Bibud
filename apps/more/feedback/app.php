<div id="feedback" class="app_large">
<script type="text/javascript">
function feedback_submit() {
document.getElementById('feedback_status').innerHTML="";
document.getElementById('feedback_status').style.display="block";
doAjax("apps/more/feedback/ajax.php?name=<?php echo $fname." ".$lname; ?>&email=<?php echo $email; ?>&subject="+document.feedback.subject.value+"&text="+document.feedback.text.value,"feedback_status");
setTimeout("document.getElementById('feedback_status').style.display='none';",3000);
}
</script>
<!--<a href="#" onclick="hide('feedback');">Close</a>
<br />-->
<h1>Feedback</h1>
If you have any comments about the service, please feel free to post them here.
<br />
<form name="feedback">
Subject:
<input type="text" name="subject" />
<br />
Comments:
<br />
<textarea name="text" style="width:300px;height:200px;"></textarea>
<br /><input type="button" value="Submit" onclick="feedback_submit();" />
</form>
<br /><div id="feedback_status" style="color:green;font-weight:700;"></div>
</div>