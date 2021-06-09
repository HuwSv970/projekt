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
        include_once("dbConnect.php");

        if (isset($_POST["itemToDelete"])) {
            unset($_SESSION["ShoppingCart"][$_POST["itemToDelete"]]);
        }

        if (isset($_POST["buy"]) && sizeof($_SESSION["ShoppingCart"]) != 0) {
            $orderStatus = "Order to process";
            $sqlInsert = $connection->prepare("INSERT INTO OrderTable(person_Order,order_Status) values ((Select ID_PERSON from PPL where UserName =?),?);");
            $sqlInsert->bind_param("ss", $_SESSION["curentUser"], $orderStatus);
            $insertWentOK = $sqlInsert->execute();
            $newOrderId = mysqli_insert_id($connection);

            foreach ($_SESSION["ShoppingCart"] as $key => $value) {

                $sqlInsert2 = $connection->prepare("INSERT INTO OrderContent(orderNumber,orderItem,HowMany)values(?,?,?);");
                $sqlInsert2->bind_param("iii", $newOrderId, $key, $value);
                $insertnWentOK = $sqlInsert2->execute();
            }
            $_SESSION["ShoppingCart"] = [];
        }
        include_once("Nav-bar.php");
        if (!$_SESSION["isUserLoggedIn"]) {
            header("Location: login.php");
            die();
        }

        ?>

        <h1>Shopping cart content:</h1>
        <table>
            <tr>
                <th>Product Name</th>
                <th>Number Ordered:</th>
                <th>Price</th>

            </tr>
            <?php
            $totalPrice = 0;
            foreach ($_SESSION["ShoppingCart"] as $key => $value) {


                $sqlSelect = $connection->prepare("SELECT * from Products where ID_Product=?");
                $sqlSelect->bind_param("i", $key);
                $selectionWentOK = $sqlSelect->execute();

                if ($selectionWentOK) {

                    $result = $sqlSelect->get_result();
                    $row = $result->fetch_assoc();
                    $totalPrice += $row["Price"] * $value;
            ?>
                    <tr>
                        <td><?= $row["PName"] ?></td>
                        <td><?= $value ?></td>
                        <td><?= $row["Price"] * $value ?></td>
                        <td>
                            <form method="POST">
                                <input type="hidden" name="itemToDelete" value="<?= $key ?>">
                                <input type="submit" value="Remove">
                            </form>
                        </td>
                    </tr>
            <?php
                }
            }

            ?>
    </div>
    </table>
    <h3>
        </br>
        <?php
        print "The Total Price is:" . $totalPrice . "€"
        ?>
    </h3>
    <form method="POST">
        <input type="submit" name="buy" value="Buy">
    </form>
</body>

</html>