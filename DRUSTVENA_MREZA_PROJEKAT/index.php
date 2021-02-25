<?php
session_start();  
require_once "connection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <link rel="stylesheet" href="stil.css">
</head>
<body class="pozadina"> 
    

    <?php

    if(!empty($_SESSION['id'])){
        header("Location: followers.php");
    }
    ?>

    <div id="sidenav">
    </div>

    <div id="sidebar">
    </div>

    <div id="header_login">
        <h2 class="poruka_login">Welcome to OUR network!</h2>
    </div>

    <p class="index_login"><a class="decoration" href="login.php">Login</a></p>
    <p class="index_register" ><a class="decoration" href="register.php">Register</a></p>
    
    

        


</body> 
</html>