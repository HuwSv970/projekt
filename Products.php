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
        if (isset($_POST["ProductToBuy"])) {
            if ($_POST["HowManyItems"] > 0) {
                if (isset($_SESSION["ShoppingCart"][$_POST["ProductToBuy"]])) {
                    $_SESSION["ShoppingCart"][$_POST["ProductToBuy"]] += $_POST["HowManyItems"];
                } else {
                    $_SESSION["ShoppingCart"][$_POST["ProductToBuy"]] = $_POST["HowManyItems"];
                }
            }
        }

        if (isset($_POST["ProductToDelete"])) {
            $sqlDelete = $connection->prepare("Delete from Products where ID_Product =?");
            if (!$sqlDelete)
                die("Error in sql delete statement");
            $sqlDelete->bind_param("i", $_POST["ProductToDelete"]);
            $sqlDelete->execute();
        }
        ?>

        <table id="tablelogin">
            <tr>
                <th id="itemTable">Name of the Product</th>
                <th id="itemTable">Price</th>
                <th id="itemTable">In stock</th>
            </tr>

            <?php
            $sqlSelect = $connection->prepare("SELECT * from Products");
            $selectionWentOK = $sqlSelect->execute();

            if ($selectionWentOK) {

                $result = $sqlSelect->get_result();
                while ($row = $result->fetch_assoc()) {
            ?>


                    <tr>
                        <td id="itemTable"><?= $row["PName"] ?></td>
                        <td id="itemTable"><?= $row["Price"] ?>€</td>
                        <td id="itemTable"><?= $row["ItemsNumber"] ?></td>
                        <?php if (isset($_SESSION["UserRole"]) && $_SESSION["UserRole"] == 'Admin') {
                        ?>
                            <td>
                                <form method="POST">
                                    <input type="hidden" name="ProductToDelete" value="<?= $row['ID_Product'] ?>">
                                    <input type="submit" value="Delete">
                                </form>
                            </td>

                        <?php } else {
                        ?>
                            <td>
                                <form method="POST">
                                    <input type="hidden" name="ProductToBuy" value="<?= $row["ID_Product"] ?>">
                                    <input type="number" name="HowManyItems" value="0">
                                    <input type="submit" value="Add to cart">
                                </form>
                            </td>
                        <?php
                        }
                        ?>
                    </tr>

            <?php

                }
            } else {
                print "Something went wrong when selecting data";
            }

            ?>
        </table>

    </div>
</body>

</html>