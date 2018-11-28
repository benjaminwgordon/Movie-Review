<?php
require_once "DatabaseAdaptor.php";

if (isset($_POST["username"])){
    $username = $_POST["username"];
}
if (isset($_POST["password"])){
    $password = $_POST["password"];
}

$databaseAdaptor = new DatabaseAdaptor();


global $username, $password, $databaseAdaptor;
$arr = $databaseAdaptor->checkForUsername($username);
if (count($arr) > 0){
    echo "Userame taken, try a different username";
}
else{
    $databaseAdaptor->insertNewUser($username, $password);
    echo 'Registration succesful';
}


