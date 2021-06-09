<div id="NavB">


    <?php
    //!!!!!!!!!!!!!
    if ($_SESSION["isUserLoggedIn"] == true) {
    ?>
        </br>

        <a class="styleNavBLink" href="products.php">Products</a>
        <a class="styleNavBLink" href="ShoppingCart.php">Shoppingcart Added items: <?= sizeof($_SESSION["ShoppingCart"]) ?></a>
        <?php

    }
    $_SESSION["UserRole"] = "Normal";
    if ($_SESSION["isUserLoggedIn"] == true) {
        $sql = $connection->prepare("Select * from ppl where UserName =? AND UserRole ='Admin'");
        $sql->bind_param("s", $_SESSION["curentUser"]);
        $sql->execute();
        $UserNameRole = $sql->get_result();
        if ($UserNameRole->num_rows == 1) {
            //!!!!!!!!!!!!!
            $_SESSION["UserRole"] = "Admin";
        ?>

            <a class="styleNavBLink" href="newCountry.php">Country</a>
            <a class="styleNavBLink" href="newProduct.php">Add Product</a>
            <a class="styleNavBLink" href="order_list.php">Order List</a>
            </br>
        <?php
        }
    } else {
        ?>
        </br>
        <a class="styleNavBLink" href="login.php">Login</a>
        <a class="styleNavBLink" href="signup.php">Signup</a>
    <?php
    }
    ?>
    <?php
    if (isset($_POST["logout"])) {

        session_unset();
        session_destroy();
        $_SESSION["isUserLoggedIn"] = false;
        header("Location: login.php");
    }
    ?>

    <?php


    if ($_SESSION["isUserLoggedIn"]) {
    ?>
        <p>
        <form method="POST">
            <input type="submit" value="Logout" name="logout" style=" padding:11px">
        </form>
        </p>
    <?php

    }



    ?>
</div>