<?php

session_start();
require_once "DatabaseAdaptor.php";
$databaseAdaptor = new DatabaseAdaptor();


if (isset($_POST["method"])){
    $method = $_POST["method"];
}

//user login method
if ($method == "login"){
    if (isset($_POST["username"])){
        $username = $_POST["username"];
    }
    if (isset($_POST["password"])){
        $password = $_POST["password"];
    }
    if (isset($_POST["username"]) && isset($_POST["password"])){
        if ($databaseAdaptor->checkUserCredentials($username, $password) == TRUE){
            $_SESSION["user"] = $username;
            echo true;
        }
        else{
            echo false;
        }
    }
}

if ($method == "registration"){
    if (isset($_POST["username"])){
        $username = $_POST["username"];
    }
    if (isset($_POST["password"])){
        $password = $_POST["password"];
    }
        
    $arr = $databaseAdaptor->checkForUsername($username);
    if (count($arr) > 0){
        echo "Userame taken, try a different username";
    }
    else{
        $databaseAdaptor->insertNewUser($username, $password);
        echo 'Registration succesful';
    }
}

if ($method == "myReviews"){
    if (isset($_SESSION["user"])){
        echo "<h3>Welcome ".$_SESSION["user"]."</h3>";
		echo "<h4>".$_SESSION["user"]."'s reviews:</h4>";
		$movies = json_decode($databaseAdaptor->getMyReviews($_SESSION["user"]), true);
        if (count($movies) > 0){
            for ($i = 0; $i < count($movies); $i++){
                echo "<ul>";
                echo "<li>".$movies[$i]["movieTitle"].": </li>";
                echo "<li>".$movies[$i]["reviewText"]."</li>";
                echo "</ul>";
            }
        }
        else{
            echo "you havent posted any reviews yet";
        }
    }
    else{
        echo "<p>please login to view your reviews</p>";
    }
}

if ($method == "getAllMovies"){
    $movies = json_decode($databaseAdaptor->getMovieList());
    for ($i = 0; $i < count($movies); $i++)
    {
        echo '<ul>';
        echo '<li>'.$movies[$i]["movieTitle"].'</li>';
        echo '</ul>';
    }
    
}




?>

