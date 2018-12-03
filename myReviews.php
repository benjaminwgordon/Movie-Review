
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Landing</title>
</head>

<?php session_start()?>

<body>
	
	<h4><?php echo $_SESSION["user"] ?>'s reviews:</h4>
	

	
	<p>Welcome <?php echo $_SESSION["user"] ?></p>
	
</body>
</html>



