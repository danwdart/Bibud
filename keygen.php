<form>
Email: <input type="text" name="email">
<input type="submit">
</form>

<?php echo md5($_GET['email'].":".date("W:Y")); ?>