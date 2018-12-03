
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Landing</title>
</head>

<?php session_start()?>

<body>

	<div id="myReviews"></div>
	
	
	
</body>
<script>
function getMyReviews(){
		var username = <?php echo $_SESSION["user"] ?>;
	    var ajax = new XMLHttpRequest();
	    ajax.open("POST", "controller.php", true);
	    ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	    ajax.send("username=" + username + "&password=" + password + "&method=myReviews");
	    ajax.onreadystatechange = function() {
	        if (ajax.readyState == 4 && ajax.status == 200) {
				document.getElementById("myReviews").innerHTML = ajax.responseText;
	        }
	    };
	}
</script>
</html>



