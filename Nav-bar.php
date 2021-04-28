<div id="NavB">
<a class="styleNavBLink" href="login.php">Login</a>
<a class="styleNavBLink" href="Signup.php">Signup</a>
<?php
if($_SESSION["isUserLoggedIn"] == true){
    ?>
    <a class="styleNavBLink" href="newCountry.php">New Coutry</a>
    <?php
}
?>
</div>