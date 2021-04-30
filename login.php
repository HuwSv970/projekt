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
</br>
<img id="left" src="1.jpg" >
<img id="right"src="2.jpg" >

<div id="content">
<?php
include_once("Nav-bar.php");
?>
</br>
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
            print "You typed the correct password. You are now logged in!";
            $_SESSION["isUserLoggedIn"] = true;
            $_SESSION["curentUser"]=$_POST["Username"];
            header("Location: login.php");
            
        } else {
            print "Wrong password!";
        }
    }
}
if(isset($_POST["logout"])){

    session_unset();
    session_destroy();
    $_SESSION["isUserLoggedIn"] = false;
}
?>
<?php


if($_SESSION["isUserLoggedIn"]){
    ?>

    <h1>Logout Page</h1>
    <form method="POST">
    <input type="submit" value="Logout" name="logout" style =" padding:11px">
    </form>
    
<?php
    $sqlSelect = $connection->prepare("SELECT * from Product");
        $selectionWentOK = $sqlSelect->execute();

        if($selectionWentOK){

            $result = $sqlSelect->get_result();
            while($row=$result->fetch_assoc()){
?>

            <table id="tablelogin">
    <tr>
        <th id="itemTable">Name of the Product</th>
        <th id="itemTable">Price</th> 
        <th id="itemTable">In stock</th>
    </tr> 
                <td id="itemTable"><?=$row["PName"]?></td>
                <td id="itemTable"><?=$row["Price"]?>€</td>
                <td id="itemTable"><?=$row["ItemsNumber"]?></td>
            </tr>
                <?php
            }

        } else {
            print "Something went wrong when selecting data";
        }
        ?>
        </table>
    

    <?php
} else {

?>
<h1>Welcome! Please Login</h1>
<h2>
<form method="POST">
    <label for="UserName">Username:</label> <input style ="margin:2px; padding:5px;" name="Username"><br>
    <label for="UserName">Password:</label> <input style ="margin:2px; padding:5px;margin-left:9px" name="Psw" type="password"><br>
    <input type="submit" value="login" style ="padding:10px; margin-left:250px;">
</form>

<?php

}

?>



</div>
</body>
</html>