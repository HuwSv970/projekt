<form method='POST'>
<input name='LName'>
<input name='FName'>
<input name='Age'>
<input name='UName'>
<input name='Psw' type="password">
<input name='Psw2' type="password">
<input type='submit' value='Register'>
</form>


<?php
if(isset($_POST['LName'],
        $_POST['FName'],
        $_POST['Age'],
        $_POST['UName'],
        $_POST['Psw'],
        $_POST['Psw2'])){
            if($_POST['Psw']==$_POST['Psw2']){

                include_once('dbConnect.php');
                $sql = $connection->prepare("INSERT INTO PPL(LastName, FirstName, Age, UserName, Psw) values(?,?,?,?,?)");
                $sql->bind_param("ssiss", 
                        $_POST['LName'], 
                        $_POST['FName'], 
                        $_POST['Age'], 
                        $_POST['UName'], 
                        $_POST['Psw']);
                $executeResult = $sql->execute();
                if($executeResult){
                    print "user created sucessfully";
                } else {
                    print $sql->error;
                }
            } else {
                print "Does not match";
            }
        }
?>