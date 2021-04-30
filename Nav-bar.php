
<div id="NavB">
<a class="styleNavBLink" href="login.php">Login</a>
<a class="styleNavBLink" href="Signup.php">Signup</a>
<?php
//!!!!!!!!!!!!!
if($_SESSION["isUserLoggedIn"] == true){
    $sql=$connection->prepare("Select * from ppl where UserName =? AND UserRole ='Admin'");
    $sql->bind_param("s", $_SESSION["curentUser"]);
    $sql->execute();
    $UserNameRole= $sql->get_result();
    if($UserNameRole->num_rows==1){
//!!!!!!!!!!!!!
    
    ?>
    <a class="styleNavBLink" href="newCountry.php">New Country</a>
    <a class="styleNavBLink" href="newProduct.php">Add Product</a>
    <?php
    }
}
?>
</div>