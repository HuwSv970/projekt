<?php
include_once("dbConnect.php");
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Checkout</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='style.css'>
</head>

<body>
    </br>
    <img id="left" src="1.jpg">
    <img id="right" src="2.jpg">


    <div id="content">
        <?php
        include_once("Nav-bar.php");
        if (!$_SESSION["isUserLoggedIn"]) {
            header("Location: login.php");
            die();
        }
        ?>
    </div>
    
    
</body>

</html>