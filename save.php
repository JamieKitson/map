<html>
<body>
<?php 
	file_put_contents("data.csv", stripslashes($data));
	echo file_get_contents("data.csv");
?>
</body>
</html>

