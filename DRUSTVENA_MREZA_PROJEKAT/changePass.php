<?php
    
    require_once "header.php";
    require_once "connection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="stylesheet" href="stil.css">
</head>
<body>
    <?php

    $oldpasswordErr = $newrepasswordErr = $newpasswordErr = "";
    $newpassword = $oldpassword = $newrepassword = "";
    $prikaz = true;

    $imePrezime = $_SESSION['ime_prezime'];
    echo "<h3 class='pozdrav'> Hello, $imePrezime, you can change your password here!</h3>";

    $id = $_SESSION['id'];

    $q = "SELECT * FROM users WHERE users.id=$id";
    $result = $conn->query($q);
    $row = $result->fetch_assoc();
    $password_db = $row['pass'];
    
    

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        
        $oldpassword = $_POST['oldpassword'];
        $newpassword = $_POST['newpassword'];
        $newrepassword = $_POST['newrepassword'];

        if(md5($oldpassword) != $password_db){
            $oldpasswordErr = "Passwords doesn't match!";
            $prikaz = false;
        }
        

        if(empty($newpassword)){
            $prikaz = false;
            $newpasswordErr = "Wrong password!";
        }
        elseif(strpos($newpassword, ' ') !== false){  
            $prikaz = false;
            $newpasswordErr = "Wrong password!"; 
        }
        elseif(strlen($newpassword) < 5 || strlen($newpassword) > 25){
            $prikaz = false;
            $newpasswordErr = "Wrong password!";
        }
        else{
            $newpassword = $_POST['newpassword'];
        }

     
        if($newpassword == $newrepassword){
            $newrepassword = $_POST['newrepassword'];
        }
        else{
            $newpasswordErr = "Passwords doesn't match!";
            $prikaz = false;
        }
            
        if($prikaz){

            $q = "UPDATE users
            SET pass=md5('$newpassword')
            WHERE id=$id";
            $result = $conn->query($q);
            
        }      
        
    }


    ?>

    <form action="#" method="POST" class="forma_change">
        <p>
            <label>Old password:</label>
            <input type="password" name="oldpassword">
            <span class="error">*<?php if($oldpasswordErr){echo $oldpasswordErr;} ?></span>
        </p>

        <p>
            <label>New password</label>
            <input type="password" name="newpassword">
            <span class="error">*<?php if($newpasswordErr){echo $newpasswordErr;} ?></span>
        </p>

        <p>
            <label>Re-type new password</label>
            <input type="password" name="newrepassword">
            <span class="error">*<?php if($newrepasswordErr){echo $newrepasswordErr;} ?></span>
        </p>

        <p>
            <input type="submit" name="submit" value="Submit">
        </p>
    </form>

</body>
</html>