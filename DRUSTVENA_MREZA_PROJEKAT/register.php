<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="stil.css">
    
</head>

<body class="pozadina">

    <?php
        $name = $surname = $date = $korisnicko_ime = $lozinka = $repassword = "";
        $nameErr = $surnameErr = $dateErr = $usernameErr =$passwordErr = $repasswordErr = "";
        $prikaz = false;

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $name = $_POST['name'];
            $surname = $_POST['surname'];
            $date = $_POST['date'];
            $korisnicko_ime = $_POST['username'];
            $lozinka = $_POST['password'];
            $repassword = $_POST['repassword'];
            $gender = $_POST['gender'];

            $prikaz = true;

            if(ctype_alpha(str_replace(' ', '', $name)) === false || (empty($name)) ){
                $nameErr = "Ime mora da sadrzi samo slova i razmake!";
                $prikaz = false;
            }
            elseif(strlen($name) > 50){
                $nameErr = "Ime mora da bude krace od 50 karaktera!";
                $prikaz = false;
            }
            else{
                $name = trim($name);
                $name = preg_replace('/\s\s+/', ' ', $name);
            }
            
            
        
            if(ctype_alpha(str_replace(' ', '', $surname)) === false || (empty($surname)) ){
                $surnameErr = "Prezime mora da sadrzi samo slova i razmake!";
                $prikaz = false;
            }
            elseif(strlen($surname) > 50){
                $surnameErr = "Prezime mora da bude krace od 50 karaktera!";
                $prikaz = false;
            }
            else{
                $surname = trim($surname);
                $surname = preg_replace('/\s\s+/', ' ', $surname);
            }
            

            if($date < "1900-01-01"){
                $prikaz = false;
                $dateErr = "Unesite validan datum!";
            }
            

            if(empty($korisnicko_ime)){
                $prikaz = false;
                $usernameErr = "Username is not valid!";
            }
            elseif(strpos($korisnicko_ime, ' ') !== false){  
                $prikaz = false;
                $usernameErr = "Username is not valid!"; 
            }
            elseif(strlen($korisnicko_ime) < 5 || strlen($korisnicko_ime) > 50){
                $prikaz = false;
                $usernameErr = "Username is not valid!";
            }
            


            if(empty($lozinka)){
                $prikaz = false;
                $passwordErr = "Wrong password!";
            }
            elseif(strpos($lozinka, ' ') !== false){  
                $prikaz = false;
                $passwordErr = "Wrong password!"; 
            }
            elseif(strlen($lozinka) < 5 || strlen($lozinka) > 25){
                $prikaz = false;
                $passwordErr = "Wrong password!";
            }
            elseif($lozinka!=$repassword){
                $prikaz = false;
                $passwordErr = "Passwords doesn't match!"; 
            }
            


            if(empty($repassword)){
                $prikaz = false;
                $repasswordErr = "Passwords doesn't match!";
            }
            elseif(strpos($repassword, ' ') !== false){  
                $prikaz = false;
                $repasswordErr = "Passwords doesn't match!"; 
            }
            elseif(strlen($repassword) < 5 || strlen($repassword) > 25){
                $prikaz = false;
                $repasswordErr = "Wrong password!";
            }
           

            
            if(empty($_POST["gender"])){
                $prikazi = false;
            }
            
        }

    ?>  
    
    <div class="forma">
        
            <form action="#" method="post">
                
                <p>
                    <label>Name:</label>
                    <input type="text" name="name" value="<?php echo $name ?>">
                    <span class="error">*<?php echo $nameErr; ?></span>
                </p>

                <p>
                    <label>Surname:</label>
                    <input type="text" name="surname" value="<?php echo $surname ?>">
                    <span class="error">*<?php echo $surnameErr; ?></span>
                </p>
                

                <p>
                    <label>Date of birth:</label><br>
                    <input type="date" name="date" min="1900-01-01" value="<?php echo date('Y-m-d') ?>"><br>
                    <span class="error">*<?php echo $dateErr; ?></span>
                </p>

                <p>
                    <label>Username</label>
                    <input type="text" name="username" value="<?php echo $korisnicko_ime ?>">
                    <span class="error">*<?php echo $usernameErr; ?></span>
                </p>

                <p>
                    <label>Password:</label>
                    <input type="password" name="password">
                    <span class="error">*<?php echo $passwordErr; ?></span>
                </p>

                <p>
                    <label>Re-type password</label>
                    <input type="password" name="repassword">
                    <span class="error">*<?php echo $repasswordErr; ?></span>
                </p>

                <p>
                    <span>Gender:</span><br> 
                    <input type="radio" name="gender" value="m">Male
                    <input type="radio" name="gender" value="f">Female
                    <input type="radio" name="gender" value="o" checked>Other
                    
                </p>

                <p>
                    <input type="submit" name="submit" value="Submit">
                </p>   
        
            </form>
       
    </div>

            <div id="sidenav">
            </div>

            <div id="sidebar">
            </div>

            <div id="header_register">
                <h2 class="poruka_register">Please register!</h2>
            </div>

            
        
    <?php
        if($prikaz){

            require_once "connection.php";

            $korisnicko_ime = $conn->real_escape_string($korisnicko_ime);
            $lozinka = $conn->real_escape_string($lozinka);
            $name = $conn->real_escape_string($name);
            $surname = $conn->real_escape_string($surname);


            
            $sql = "SELECT * FROM users WHERE username LIKE '$korisnicko_ime'";
            $result = $conn->query($sql);
            if(mysqli_num_rows($result) > 0){
                $usernameErr =  "Korisnicko ime je zauzeto!";
            }
            else{

            $q = "INSERT INTO users (username, pass)
            VALUES('$korisnicko_ime', md5($lozinka));";
            $conn->query($q);

            $q = "SELECT id FROM users WHERE username='$korisnicko_ime';";
            $result = $conn->query($q);
            $red = $result->fetch_assoc();
            $id = $red['id'];

            $q = "INSERT INTO profiles (`name`, `surname`, `gender`, `dob`, `user_id`)
            VALUES('$name', '$surname', '$gender', '$date', '$id');";   
            $conn->query($q);
            }
            
            
        }

    ?>

</body>
</html>