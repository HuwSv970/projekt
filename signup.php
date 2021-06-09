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
    <img id="left" src="1.jpg">
    <img id="right" src="2.jpg">

    <div id="content">
        <?php
        include_once("Nav-bar.php");

        ?>
        <?php

        if (
            isset(
                $_POST["FirstName"],
                $_POST["LastName"],
                $_POST["UserName"],
                $_POST["Psw"],
                $_POST["Psw2"],
                $_POST["Country"]
            )
        ) {
        ?>
            </br>
        <?php
            print "We are trying to sign you up!";
            if ($_POST["Psw"] == $_POST["Psw2"]) {
                //we are ok -we will start instert this into db

                $sql = $connection->prepare("INSERT INTO PPL(FirstName, LastName, UserName, Psw, ID_COUNTRY,UserRole) VALUES(?,?,?,?,?,?)");

                if (!$sql) {
                    print "Error in your sql";
                }

                $hashedPassword = password_hash($_POST["Psw"], PASSWORD_BCRYPT);


                $normalUser = "NormalUser";
                $sql->bind_param(
                    "ssssis",
                    $_POST["FirstName"],
                    $_POST["LastName"],
                    $_POST["UserName"],
                    $hashedPassword,
                    $_POST["Country"],
                    $normalUser
                );

                $resultOfExecute = $sql->execute();
                if ($resultOfExecute) {
                    print "We are done. Please check the database...";
                } else {
                    print 'Problem running execute.';
                }
            } else {
                print "Passwords not matching.";
            }
        }
        ?>


        <h1>Welcome to My-Store. You will signup here</h1>
        <div class="container">
            <form class="myRegistration" method="POST">
                <div>
                    <label for="FirstName">First Name:</label> <input name="FirstName">
                </div>

                <div><label for="LastName">Last Name:</label><input name="LastName"></div>
                <div><label for="UserName">Username:</label> <input name="UserName"></div>
                <div><label for="Psw">Password:</label> <input name="Psw" type="password"></div>
                <div><label for="Psw2">Re-type Password:</label> <input name="Psw2" type="password"></div>
                <div><label for="Country">Choose your country:</label>
                    <select name="Country">

                        <option value="1">Luxembourg</option>
                        <?php
                        $sqlSelect = $connection->prepare("SELECT * from Countries");
                        $selectionWentOK = $sqlSelect->execute();

                        if ($selectionWentOK) {

                            $result = $sqlSelect->get_result();
                            while ($row = $result->fetch_assoc()) {
                        ?>
                                <option value="<?= $row["ID_COUNTRY"] ?>"><?= $row["CountryName"] ?></option>
                        <?php
                            }
                        } else {
                            print "Something went wrong when selecting data";
                        }
                        ?>

                    </select>
                </div>

                <input type="submit" name="submit" value="Register" style="padding:11px">
            </form>


        </div>
</body>

</html>