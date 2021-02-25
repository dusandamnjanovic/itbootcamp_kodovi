<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Followers</title>
    <link rel="stylesheet" href="stil.css">
</head>
<body>
    
</body>
</html>
<?php
    
    require_once "connection.php";
    
    require_once "header.php";
  

    if(empty($_SESSION['id'])){
        header("Location: login.php");
    }

    $id = $_SESSION['id']; // ID logovanog korisnika
        
    $imePrezime = $_SESSION['ime_prezime'];
    
    echo "<h3 class='pozdrav'> Hello, $imePrezime!</h3>";


    if(!empty($_GET['follow_id'])){ 
        $friendId = $conn->real_escape_string($_GET['follow_id']); // Specijalne karatkere sredjuje za upit

        $sql = "SELECT * FROM followers 
                WHERE sender_id = $id
                AND receiver_id = $friendId";

        $result = $conn->query($sql);
        if($result->num_rows == 0){ // Ako ne postoji dodajemo prijateljstvo
            $sql = "INSERT INTO followers(sender_id, receiver_id)
                    VALUES($id, $friendId)";
            $result1 = $conn->query($sql);
            if(!$result1){
               echo "<div class='error'>Greska: " . $conn->error . "</div>";
            }  
            
        }
    }

    if(!empty($_GET['unfollow_id'])){    
        $friendId = $conn->real_escape_string($_GET['unfollow_id']);

        $sql = "DELETE FROM followers
                WHERE sender_id = $id
                AND receiver_id = $friendId";
        
        $result = $conn->query($sql);

        if(!$result){
            echo "<div class='error'>Greska: " . $conn->error . "</div>";
        }   
    }



    $q = "SELECT profiles.name, profiles.surname, users.username, users.id
          FROM profiles
          INNER JOIN users
          ON users.id=profiles.user_id
          WHERE users.id != '$id';";

    $result = $conn->query($q);
    if(!$result->num_rows){
        echo "<p class='error'>Trenutno nema korisnika u bazi!</p>";
    }
    else{
        echo "<table class='followers'>";
        echo "<tr>
                <th>Ime:</th>
                <th>Korisnicko ime:</th>
                <th>Akcije:</th>
        </tr>";
        foreach($result as $row){
            echo "<tr>";
            echo "<td>" . $row['name'] . " " . $row['surname'] . "</td>";
            echo "<td>" . $row['username'] . "</td>";
            $friendId = $row['id'];

            // Ispitujemo da li pratimo korisnika
            $sql1 = "SELECT * FROM followers 
                    WHERE sender_id = $id
                    AND receiver_id = $friendId";
            $result1 = $conn->query($sql1);
            $f1 = $result1->num_rows; // Moze da bude 0(ako ga ne pratim) ili 1(ako ga pratim)


            // Da li korisnik prati mene
            $sql2 = "SELECT * FROM followers
                    WHERE sender_id = $friendId
                    AND receiver_id = $id";
            $result2 = $conn->query($sql2);
            $f2 = $result2->num_rows; // 0 ili 1

            echo "<td>"; 
            if($f1 == 0){ // Ako ga ne pratimo
                if($f2 == 0){
                    $text = "<span class='button_follow'>Follow</span>";
                }
                else{
                    $text = "<span class='button_follow'>Follow back</span>";
                }
                echo "<a href='followers.php?follow_id=$friendId'>$text</a>";
            }
            else{ // Ako ga pratimo
                echo "<a href='followers.php?unfollow_id=$friendId'><span class='button_follow'>Unfollow</span></a>";
            }
            echo "</td>";
            echo "</tr>";
        }
        echo "</table>";
        
        
    }


?>

</body>
</html>