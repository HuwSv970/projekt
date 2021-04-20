<?php

/*
we need to run an sql statement 
that will give us data from ppl table:
SELECT coloumn_name FROM table_name
SELECT LastName FROM ppl;
*/

$mySelect = "SELECT * from ppl";
$myResult = mysqli_query($connection, $mySelect);


while($row = mysqli_fetch_assoc($myResult)){
    echo $row["LastName"]." ".$row["FirstName"]." is ".$row["Age"]." years old<br>";
}

?> 