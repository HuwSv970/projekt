
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
    <h1>Current Existing countries in our database</h1>
     <form method="POST">
        <h2>Type the name of the new country:</h2><input name="NewCountry" style ="padding:10px;">
        <input type="submit" value="Add"style ="padding:10px;">
    </form>
    <?php
    if($_SESSION["isUserLoggedIn"])
    {

        if(isset($_POST["NewCountry"])){
            $sqlInsert = $connection->prepare("INSERT INTO countries (CountryName) values(?)");
            $sqlInsert->bind_param("s", $_POST["NewCountry"]);
            $resultOfExecute = $sqlInsert->execute();
            if(!$resultOfExecute){
                print "Creation of country, failed.";
            }
        }
        
    } else {
        die("Access denied. Please login first");
    }
    ?>

    <div id="countryDiv">
    <table id="tablelogin">
        <tr>
            <th id="itemTable">Country Name</th>
        </tr></br>

        <?php
        $sqlSelect = $connection->prepare("SELECT CountryName from Countries");
        $selectionWentOK = $sqlSelect->execute();

        if($selectionWentOK){

            $result = $sqlSelect->get_result();
            while($row=$result->fetch_assoc()){
                ?>
                <tr><td id="itemTable"><?=$row["CountryName"]?></td></tr>
                <?php
            }

        } else {
            print "Something went wrong when selecting data";
        }
        ?>
    </table>

  </div>     
</div>
</body>
</html>