<?php
 include_once("dbConnect.php");


 $sql=$connection->prepare("Select * from ppl where UserName =? AND UserRole ='Admin'");
 $sql->bind_param("s", $_SESSION["curentUser"]);
 $sql->execute();
 $UserNameRole= $sql->get_result();
 if($UserNameRole->num_rows == 0){
     exit("ur not an admin");
 }
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
</br>
<body>
<img id="left" src="1.jpg" >
<img id="right"src="2.jpg" >

</br>
<div id="content">
<?php
include_once("Nav-bar.php");
?>
<?php
if(isset($_POST["Name"],$_POST["Price"],$_POST["Count"])){
    $sql = $connection->prepare("INSERT INTO Product  (PName, Price, ItemsNumber) VALUES (?,?,?)");
    if(!$sql){
        die("Error in your sql");
    }

    $sql->bind_param("sii", $_POST["Name"],$_POST["Price"],$_POST["Count"]);
    if(!$sql->execute()){

        die("Error execute sql statement");
    }
    else{
        echo "Product Added";
    }
}
?>
</br>
<br>
    <form method="POST">
        <label for="UserName">Name:</label> <input style ="margin:2px; padding:5px;margin-left:5px" name="Name"><br>
        <label for="UserName">Price:</label> <input style ="margin:2px; padding:5px;margin-left:10px" name="Price"><br>
        <label for="UserName">Count:</label> <input style ="margin:2px; padding:5px;margin-left:3px" name="Count"><br>
        <input type="submit" value="Add" style ="padding:10px; margin-left:180px;">
    </form>
</div>

</body>
</html>