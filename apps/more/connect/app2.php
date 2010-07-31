<div id="connect" class="app_large">
<span style="color:red;">ATTENTION: This Connection application is a demo. The fully working version will be found on purchased devices.</span>
<br />
<div style="max-height:97%;width:100%;overflow:auto;">
<form action="#" onsubmit="return false;">

<div style="float:left;min-width:300px;max-width:45%; padding:1%;margin:1%;">
<hr />
<b>By default, sign into, update from and use the resources and files of this server:</b>
<br /><input type="radio" name="server" value="bibud.com" selected /><label for="bibud.com">Bibud Master Server</label>
<br /><input type="radio" name="server" value="localhost" /><label for="localhost">This Computer (io)</label>
<br /><input type="radio" name="server" value="192.168.0.1" disabled /><label for="192.168.0.1">No network servers found</label>
<br /><input type="radio" name="server" value="custom" /><label for="custom">Custom: <input type="text" name="customserver" /></label>
</div>

<div style="float:left;min-width:300px; max-width:45%;padding:1%;margin:1%;">
<hr />
<b>Coupling</b>
<br />Couple with this server, and allow it to remotely administrate this device, applying updates, branding and sharing resources, including management of this device's power and bandwidth usage, user information and allowing remote shutdowns.
<br /><input type="radio" name="admin" value="none" selected /><label for="none">None</label>
<br /><input type="radio" name="admin" value="none" disabled /><label for="net">No network servers found</label>
<br /><input type="radio" name="admin" value="custom" /><label for="custom">Custom: <input type="text" name="customadmin" /></label>
</div>

<div style="float:left;min-width:300px;max-width:45%; padding:1%;margin:1%;">
<hr />
<b>Clustering</b>
<br /><input type="radio" name="cluster" value="1" /><label for="1" selected>Share my processing and disk space with others, allowing me unlimited use of any other shared resources</label>
<br /><input type="radio" name="cluster" value="0" /><label for="0">Do not share my processing and disk space with others. I will be limited to my own computer's resources</label>
</div>



<div style="float:left;min-width:300px;max-width:45%; padding:1%;margin:1%;clear:both;">
<hr />
<input type="submit" value="Apply changes" /><input type="submit" value="Discard changes" />
</div>

</form>
</div>
</div>
