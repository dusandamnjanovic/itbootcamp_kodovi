<?php
    session_start();
    require_once "connection_2.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Screen</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="header">
        <h1>Home Screen</h1>
    </div>

    <div>
        <p class="login_button"><a href="login.php">Login Screen</a></p>
        <p class="register_button"><a href="register.php">Register Screen</a></p>
        <p class="logout"><a href="logout.php">Log Out</a></p>
    </div>
    
    <?php

        if(!empty($_SESSION['id'])){ // Proveravamo da li je korisnik ulogovan, ako jeste ispisujemo zadatu poruku
            $id = $_SESSION['id'];
            $welocmemsg = $_SESSION['name'];
            echo "Welcome $welocmemsg"; 
        }


        $search = "";
        if($_SERVER["REQUEST_METHOD"] == "POST"){

            if(!empty($_SESSION['id'])){ // Ako je korisnik ulogovan moze da vrsi pretragu
                $search = $_POST['search'];
            

            $q = "SELECT * FROM userstable WHERE '$search' = name OR '$search' = email;";
            $result = $conn->query($q);
            if($result->num_rows == 0){
                $searchErr = "There is no match!";
            }
            else{
               foreach($result as $row){// Ovde ispisujemo sve rezultate pretrage, nisam uspeo da implementiram da se rezultati ispisuju na stranici zadatoj u zadatku
                   echo "<br>";
                   echo $row['name'];
                } 
            }

            }else{ // Ako nije ulogovan saljemo ga na stranicu result_screen.php gre moze da se uloguje
                header("Location: result_screen.php");
            }
               
        }

        
        
    ?>


   <div class="forma">
    <form action="#" method="post">

        <p>
            <label>Search:</label>
            <input type="search" name="search">
        </p>

        <p>
            <input type="submit" value="Search" class="search_button">
        </p>

    </form>
   </div>


</body>
</html>