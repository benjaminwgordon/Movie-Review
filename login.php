<?php
require_once "DatabaseAdaptor.php";
if (isset($_POST["username"])){
    $username = $_POST["username"];
}
if (isset($_POST["password"])){
    $password = $_POST["password"];
}
$databaseAdaptor = new DatabaseAdaptor();
if (isset($_POST["username"]) && isset($_POST["password"])){
    if ($databaseAdaptor->checkUserCredentials($username, $password) == TRUE){
        header('Location:landing.php');
        exit();
    }
    else{
        echo "username and password do not match";
    }
}
?>