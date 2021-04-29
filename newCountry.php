
<?php
 include_once("dbConnect.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Page Title</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='style.css'>
</head>

<body>
<?php
include_once("Nav-bar.php");
?>

<div id="content"> 
    <h1>Current Existing countries in our database</h1>
     <form method="POST">
        Type the name of the new country:<input name="NewCountry">
        <input type="submit" value="Add">
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
    <table>
        <tr>
            <th>Country Name</th>
        </tr></br>

        <?php
        $sqlSelect = $connection->prepare("SELECT CountryName from Countries");
        $selectionWentOK = $sqlSelect->execute();

        if($selectionWentOK){

            $result = $sqlSelect->get_result();
            while($row=$result->fetch_assoc()){
                ?>
                <tr><td><?=$row["CountryName"]?></td></tr>
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