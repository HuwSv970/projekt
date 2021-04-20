<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Page Title</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script>
</head>

<body>

<?php
include_once "dbConnect.php";

if(isset($_POST["logout"])){

    session_unset();
    session_destroy();
    $_SESSION["isUserLoggedIn"] = false;
}

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

if($_SESSION["isUserLoggedIn"]){
    ?>

    <h1>Logout Page</h1>
    <form method="POST">
    <input type="submit" value="logout" name="logout">
    </form>

    <?php
} else {

?>
<h1>Welcome to this login page of this website</h1>
<form method="POST">
    <label for="UserName">Please type your Username</label> <input name="Username">
    <label for="UserName">Password</label> <input name="Psw" type="password">
    <input type="submit" value="login">
</form>
<?php

}

?>


<p><a href="newCountry.php">Click here to Create a new Country</p>

</body>
</html>