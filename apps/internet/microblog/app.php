<div id="microblog" class="app_large">

<script type="text/javascript">
function mbsend() {

if (document.getElementById('twitter').value=="on") {
twusername=document.getElementById('twusername').value;
twpassword=document.getElementById('twpassword').value;
statustext=document.getElementById('status').value;
twstatus=doAjaxSynchronous("apps/internet/microblog/mb.php?service=twitter&user="+twusername+"&pass="+twpassword+"&status="+statustext);
if (twstatus.indexOf("Could not authenticate you") != -1) {
  alert ("I could not authenticate your Twitter account");
}
else if (twstatus.indexOf("twimg") != -1) {
  alert ("Debug: Twitter success");
}
}

if (document.getElementById('identica').value=="on") {
idusername=document.getElementById('idusername').value;
idpassword=document.getElementById('idpassword').value;
statustext=document.getElementById('status').value;
idstatus=doAjaxSynchronous("apps/internet/microblog/mb.php?service=identica&user="+idusername+"&pass="+idpassword+"&status="+statustext);
if (idstatus.indexOf("Could not authenticate you") != -1) {
  alert ("I could not authenticate your Identica account");
}
else if (idstatus.indexOf("bibud") != -1) {
  alert ("Debug: Identica success");
}
}

if (document.getElementById('custom').value=="on") {
cuusername=document.getElementById('cuusername').value;
cupassword=document.getElementById('cupassword').value;
apiurl=document.getElementById('apiurl').value;
statustext=document.getElementById('status').value;
custatus=doAjaxSynchronous("apps/internet/microblog/mb.php?service="+apiurl+"&user="+cuusername+"&pass="+cupassword+"&status="+statustext);
if (custatus.indexOf("Could not authenticate you") != -1) {
  alert ("I could not authenticate your Custom account");
}
else if (custatus.indexOf("bibud") != -1) {
  alert ("Debug: Custom success");
}
}

}
</script>

<div style="width:100%;height:50px;"></div>
<div style="line-height:70px;font-size:16pt;float:left;">Update your status:&nbsp;&nbsp;&nbsp;&nbsp;</div><textarea id="status" name="status" style="width:500px;height:70px;font-size:12pt;float:left;" onchange="mbcount();"></textarea>
&nbsp;&nbsp;&nbsp;&nbsp;
<div style="width:30px;height:70px;float:left;"></div><input type="button" style="width:70px;height:70px;float:left;" value="Update" onclick="mbsend();" /><span style="float:left;padding-left:20px;line-height:70px;">Soft limit: <span id="limit">140</span></span>
<br /><br /><br /><br />
<div style="font-size:14pt;padding-left:100px;">Submit to:</div>
<br />
<div id="twitterbox" style="font-size:14pt;padding-left:30px;">
  Twitter &nbsp;<input type="checkbox" id="twitter" name="twitter" />
  Username: <input type="text" id="twusername" name="twusername" style="width:190px;" />&nbsp;&nbsp;
  Password: <input type="password" id="twpassword" name="twpassword" style="width:190px;" />
</div>
<br />
<div id="identicabox" style="font-size:14pt;padding-left:30px;">
  Identica <input type="checkbox" id="identica" name="identica" />
  Username: <input type="text" id="idusername" name="idusername" style="width:190px;" />&nbsp;&nbsp;
  Password: <input type="password" id="idpassword" name="idpassword" style="width:190px;" />
</div>
<br />
<div id="custombox" style="font-size:14pt;padding-left:30px;">
  Custom &nbsp;<input type="checkbox" id="custom" name="custom" />
  API URL (e.g. brainbird.net/api): &nbsp;&nbsp;<input type="text" id="apiurl" name="apiurl" style="width:290px;" />
  <br /><br />
  <span style="position:relative;left:110px;">
  Username: <input type="text" id="cuusername" name="cuusername" style="width:190px;" />&nbsp;&nbsp;
  Password: <input type="password" id="cupassword" name="cupassword" style="width:190px;" />
  </span>
</div>
</div>