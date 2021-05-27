<?php

    session_start();
    require_once "connection_2.php";

    $emailErr = $passwordErr = "";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $email = $_POST['email'];
        $password = $_POST['password'];
        $log = true;
        if(empty($email)){
            $log = false;
            $emailErr = "Error logging you in";
        }

        if(empty($password)){
            $log = false;
            $usernameErr = "Error logging you in";
        }

        if($log){
            $q = "SELECT * FROM userstable WHERE email = '$email';";
            $result = $conn->query($q);
            if($result->num_rows == 0){ // Ispitujemo da li postoji korisnik sa takvim emailom
                $emailErr = "Error logging you in";
            }
            else{
                $row = $result->fetch_assoc();
                $datapass = $row['password'];
                if($datapass !== $password){ // Proveravamo da li se sifre poklapaju
                    $passwordErr = "Error logging you in";
                }
                else{
                    $_SESSION['id'] = $row['id']; // Ako je prosao sve uslove logujemo korisnika
                    $q2 = "SELECT * FROM userstable WHERE email = '$email';";
                    $result = $conn->query($q);
                    $row = $result->fetch_assoc();
                    $_SESSION['name'] = $row['name'];

                   
                   header('Location: home.php');
                
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
    <title>Login Screen</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>


    
    <form action="#" method="post">
        <p>
            <label>Email:</label>
            <input type="text" name="email">
            <span class='error'><?php echo $emailErr ?></span>
        </p>

        <p>
            <label>Password</label>
            <input type="password" name="password">
            <span class='error'><?php echo $passwordErr ?></span>

        </p>

        <input type="submit" value="Login In">
    </form>



</body>
</html>