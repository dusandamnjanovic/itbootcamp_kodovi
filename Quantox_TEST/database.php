<?php

    require_once "connection.php";

    $q = "CREATE DATABASE IF NOT EXISTS userDatabase CHARACTER SET utf16 COLLATE utf16_slovenian_ci;";

    $q .= "USE userDatabase;";

    $q .= "CREATE TABLE IF NOT EXISTS usersTable(
          id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
          email VARCHAR(50) UNIQUE NOT NULL,
          name VARCHAR(50) NOT NULL,
          password VARCHAR(100) NOT NULL
    )ENGINE=InnoDB;";

    if($conn->multi_query($q)){
        echo "<p>Successfully!</p>";
    }
    else{
        echo "<p>Error: " . $conn->error . "</p>";
    }



?>