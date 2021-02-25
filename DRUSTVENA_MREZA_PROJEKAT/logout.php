<?php

    session_start();

    if(isset($_SESSION['id'])){
        // Ako postoji sesija, brisemo je
        $_SESSION = array();
        session_destroy();

    }

    header("Location: index.php");
?>