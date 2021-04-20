<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Page Title</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
</head>
<body>
    

<?php
    if(isset($_GET["wanted"]))
    {
        print "Doing a search for the person ".$_GET["wanted"]."....please wait<BR>";
        include_once("dbConnect.php");

        $mySelect = "SELECT * from ppl where LastName='".$_GET["wanted"]."'"; 
        //print $mySelect;
        //SELECT  * from ppl where LastName='John';
        //$myResult = mysqli_query($connection, $mySelect);

        $stmt = $connection->prepare("SELECT * from ppl where LastName=?");

        if(!$stmt)
        {
            die("Error in your sql statement...");
        }

        $stmt->bind_param("s", $_GET["wanted"]); //bind means link, s=string, i=intreger, it binds to the ?
        $stmt->execute();
        $myResult = $stmt->get_result();


      /*  if (!$myResult)
        {
            die("Error");
        } */

        while($row = mysqli_fetch_assoc($myResult))
        {
            echo $row["LastName"]." ".$row["FirstName"]." is ".$row["Age"]." years old<br>";
        }
    }
?>

<form method="get">
    <input type="text" name="wanted">
    <input type="submit" value="Search for people">
</form


</body>
</html>



