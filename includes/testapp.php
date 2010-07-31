<?php
setcookie("username","testuser");
?>
<link rel="stylesheet" type="text/css" href="bibud.css" />
<script type="text/javascript" src="bibud.js"></script>
<script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript">
show("<?php echo $_GET['app']; ?>");
</script>
<input type="button" onclick="show('<?php echo $_GET['app']; ?>');" value="Show App" />
<?php
include "apps/".$_GET['cat']."/".$_GET['app']."/app.php";
?>
