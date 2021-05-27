<?php

    $servername = "localhost";
    $username = "admin";
    $password = "admin123";
    $db = "userDatabase";

    $conn = new mysqli($servername, $username, $password, $db);
        if($conn->connect_error){
            die("Error connecting to database: " . $conn->connect_error);
        }

    //echo "Successfully connected";
    // Pravio sam dva fajla konekcije jer prvo moram da je kreiram a tek posle mogu
    // da joj pristupim preko connection_2.php 

?>