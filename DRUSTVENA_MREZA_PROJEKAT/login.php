<?php

    // Otvaranje sesije na pocetku stranice 
    session_start();
    
    require_once "connection.php";

    $usernameErr = $passErr = "*";

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        // Korisnik je poslao username i password i pokusava logovanje
        $username = $conn->real_escape_string($_POST['username']);
        $pass = $conn->real_escape_string($_POST['pass']);
        $val = true;
        if(empty($username)){
            $val = false;
            $usernameErr = "Username cannot be left blank!";
        }
        if(empty($pass)){
            $val = false;
            $passErr = "Password cannot be left blank!";
        }
        if($val){
            // Pokusamo da ulogujemo korisnika samo ako su sva polja forme neprazna
            $sql = "SELECT * FROM users WHERE username = '$username'";
            $result = $conn->query($sql);
            if($result->num_rows == 0){
                $usernameErr = "This username doesn't exist!";
            }
            else{
                // Postoji korisnicko ime, treba proveriti sifre
                $row = $result->fetch_assoc(); // ne koristimo foreach jer moze da postoji samo jedan red
                $dbPass = $row['pass'];
                if($dbPass != md5($pass)){ // Jer je u bazi sifrovano zato md5
                    $passErr = "Incorrect password!";
                }
                else{
                    // Ovde vrsimo logovanje
                    $_SESSION['id'] = $row['id'];
                    // $_SESSION['full_name'] = ;
                    header('Location: followers.php');
                }
            }
            
        }
    
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login to the site!</title>
    <link rel="stylesheet" href="stil.css">
</head>
<body>
    <div class="forma">
        <fieldset class="fieldset">
            <form action="#" method="POST">
                <label for="username">Username</label>
                <input type="text" name="username" id="username">
                <span class='error'><?php echo $usernameErr ?></span>
                <br>
                <label for="pass">Password</label>
                <input type="password" name="pass" id="pass">
                <span class='error'><?php echo $passErr ?></span>
                <br>

                <input type="submit" value="Log In!">
            </form>
        </fieldset>
    </div>
</body>
</html>