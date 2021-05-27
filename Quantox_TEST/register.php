<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <?php

    $email = $name = $password2 = $repassword = ""; // $password2 promenljiva zbog toga sto mi iz connection fajla vuce $password promenljivu koja vec tamo postoji
    $emailErr = $nameErr = $passwordErr = $repasswordErr = "";
    $prikaz = false;

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $email = $_POST['email'];
        $name = $_POST['name'];
        $password2 = $_POST['password'];
        $repassword = $_POST['repassword'];

        $prikaz = true;

        if(empty($email)){
            $prikaz = false;
            $emailErr = "E-mail field is empty!";
        }

        if(empty($name)){
            $prikaz = false;
            $nameErr = "Name field is empty!";
        }

        if(empty($password2)){
            $prikaz = false;
            $passwordErr = "Password field is empty!";
        }

        if(empty($repassword)){
            $prikaz = false;
            $repasswordErr = "Repassword field is empty!";
        }
        elseif($repassword != $password2){
            $prikaz = false;
            $repasswordErr = "Passwords doesn't match!!";
        }
        

    }



    ?>
   <form action="#" method="post">
        <p>
            <label>E-mail:</label>
            <input type="text" name="email" value="">
            <span class="error">*<?php echo $emailErr; ?></span>
        </p>

        <p>
            <label>Name:</label>
            <input type="text" name="name" value="">
            <span class="error">*<?php echo $nameErr; ?></span>
        </p>

        <p>
            <label>Password:</label>
            <input type="password" name="password">
            <span class="error">*<?php echo $passwordErr; ?></span>
        </p>

        <p>
            <label>Re-password</label>
            <input type="password" name="repassword">
            <span class="error">*<?php echo $repasswordErr; ?></span>
        </p>

        <p>
            <input type="submit" name="submit" value="Submit">
        </p>
   </form> 

   <?php

    if($prikaz){ // Ako je korisnik uneo validne podatke vrsi se upis u bazu podataka

        require_once "connection_2.php";

        $q = "INSERT INTO userstable(email, name, password)
              VALUES('$email', '$name', '$password2');";
        $conn->query($q);
    }



    ?>
</body>
</html>