<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<body>
<form action="save.php" method="post">
<textarea name="data" cols=160 rows=32><?php echo file_get_contents("data.csv"); ?></textarea>
<input type="submit">
</form>
</body>
</html>

