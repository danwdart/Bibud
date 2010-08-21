<script type="text/javascript">
var note_num = 1;

doAjaxSynchronous("apps/work/notes/ajax.php?init");
read_note(note_num);
var timer;

function read_notes(num) {
document.getElementById("notes_note").value=trim(doAjaxSynchronous("apps/work/notes/ajax.php?read&num="+num));
}
function timer_notes () {
timer = setTimeout("write_note()",20);
}
function write_note() {
doAjaxSynchronous("apps/work/notes/ajax.php?write&body="+document.getElementById("notes_note").value);
}
//update after 5 seconds after edit
//onchange > count to 5 > if interrupted, recount to 5

</script>
<div id="notes" class="app_custom" style="display:block;position:absolute;height: 250px;width:316px; top: 50px;left:500px;z-index:-2;">
<img src="apps/work/notes/stickynote.png" style="position:absolute;top:0px;left:0px;height: 250px;width:316px;" alt="PostIt" />
<div style="font-size:8pt;position:absolute;top:10px;left:35px;">
<a href='javascript:note_new();'>New</a>&nbsp;&nbsp;<a href='javascript:note_del(note_num);'>Delete</a><!--Share-->
</div>
<div style="font-size:8pt;position:absolute;top:10px;left:110px;">Hold me to move</div>
<div style="font-size:8pt;position:absolute;top:10px;right:25px;">
<a href="#" onclick="read_note();">Refresh</a>&nbsp;&nbsp;<a href="#" onclick="write_note();">Save</a>&nbsp;&nbsp;<!--<input type="button" onclick="hide('notes');" value="X" />--></div>
<textarea id="notes_note" onchange="timer_notes();" onclick="if (this.value==this.defaultValue) {this.value='';}" style="font-family: sans,arial; overflow:auto; position:absolute;height:215px;width:270px;background-color:transparent;border-style:none;top:25px;left:25px;">
Welcome to the notes application. Click to add a note.
</textarea>
</div>
