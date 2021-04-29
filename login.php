<?php
 include_once("dbConnect.php");
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>My-Store</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='style.css'>
    
</head>

<body>
<img id="left" src="1.jpg" >
<img id="right"src="2.jpg" >
<?php
if(isset($_POST["Username"],$_POST["Psw"])){

    $sql = $connection->prepare("Select * from ppl where Username=?");
    if(!$sql){
        die("Error in your sql");
    }

    $sql->bind_param("s", $_POST["Username"]);
    if(!$sql->execute()){
    
        die("Error execute sql statement");
    }
    
    $result = $sql->get_result();
    
    if($result->num_rows==0){
    
        print "Your username is not in our database";
    
    } else {
    
        $row = $result->fetch_assoc();
    
        if(password_verify($_POST["Psw"],$row["Psw"])){
            print "You typed the correcy password. You are now logged in";
            $_SESSION["isUserLoggedIn"] = true;
            
        } else {
            print "Wrong password";
        }
    }
}
if(isset($_POST["logout"])){

    session_unset();
    session_destroy();
    $_SESSION["isUserLoggedIn"] = false;
}
include_once("Nav-bar.php");
?>
<div id="content">
<?php


if($_SESSION["isUserLoggedIn"]){
    ?>

    <h1>Logout Page</h1>
    <form method="POST">
    <input type="submit" value="logout" name="logout" style =" padding:11px">
    </form>

    <?php
} else {

?>
<h1>Welcome! Please Login</h1>
<form method="POST">
    <label for="UserName">Username:</label> <input style ="margin:2px; padding:5px;" name="Username"><br>
    <label for="UserName">Password:</label> <input style ="margin:2px; padding:5px;margin-left:3px" name="Psw" type="password"><br>
    <input type="submit" value="login" style ="padding:10px; margin-left:195px;">
</form>
<?php

}

?>



</div>
</body>
</html>