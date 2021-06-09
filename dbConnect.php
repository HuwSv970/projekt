<?php
session_start();
if(!isset($_SESSION["isUserLoggedIn"])){
    $_SESSION["isUserLoggedIn"] = false;
}

if(!isset($_SESSION["ShoppingCart"])){
    $_SESSION["ShoppingCart"] = [];
}

$servername = "localhost";
$username = "root";
$password = "";
$dbName = "wsers2";

//Create connection
$connection = mysqli_connect($servername, $username, $password, $dbName);

//FALSE

//ANYTHING THAT IS NOT 0 in php = to TRUEs

//Check connection
if (!$connection){
    die("Connection failed: " . mysqli_connect_error());
    //here all my PHP code running is STOPPED!
}
//echo "Connected successfully <BR>";
