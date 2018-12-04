<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Landing</title>
<link rel="stylesheet" href="Landing.css">
</head>

<?php session_start()?>

<body>

	<h1 class = "title">Collegiate Movie Review</h1>
	<p class = "centered">Welcome <?php echo $_SESSION["user"] ?></p>
    <p class = "centered">Select a Movie to Look at its Reviews</p>
    <a class = "myreviewslink" href = "myReviews.php"> or click here to look at your own reviews</a>
    <div id="movieList" class = "movielist">
    </div>
</body>
<script>
getAllMovies();
function getAllMovies(){
    var ajax = new XMLHttpRequest();
    ajax.open("POST", "controller.php", true);
    ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajax.send("method=getAllMovies");
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
    		document.getElementById("movieList").innerHTML = ajax.responseText;
        }
    };
}
</script>
</html>
