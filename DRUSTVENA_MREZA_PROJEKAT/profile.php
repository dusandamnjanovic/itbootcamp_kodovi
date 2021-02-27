<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="stil.css">
</head>
<body>
    <p class="link_tabela">Kliknite <a href="followers.php">ovde</a> za odlazak na followers!</p>
</body>
</html>
<?php
        
    require_once "header.php";
    require_once "connection.php";
   
    $id = $_GET["user_id"];
    

    $imePrezime = $_SESSION['ime_prezime'];
    
    echo "<h3 class='pozdrav'> Hello, $imePrezime!</h3>";

    $q = "SELECT id FROM users
          WHERE id=$id";
    $result = $conn->query($q);
    if(!$result->num_rows){
        echo "<p class='poruka_profile'>Korisnik sa ovim id-jem ne postoji u bazi!</p>";
    }
    else{
        
        $q2 = "SELECT  users.username AS 'username', profiles.name AS 'name', profiles.surname AS 'surname', profiles.dob AS 'dob', profiles.gender AS 'gender', profiles.bio AS 'bio' 
              FROM users
              INNER JOIN profiles
              ON profiles.user_id=users.id
              WHERE users.id=$id;";
        $result2 = $conn->query($q2);
        if($result2->num_rows){
            foreach($result2 as $row){
                if($row['gender'] == 'm'){
                    $color= 'blue';
                }
                elseif($row['gender'] == 'f'){
                    $color= 'pink';
                }
                else{
                    $color= 'grey';
                }

                echo "<table style='color:$color' class='tabela'>";
                echo "<tr>";
                echo  "<th>First name:</th> <td>" . $row['name'] . "</td> </tr>";
                echo  "<tr> <th>Last name:</th> echo <td>" . $row['surname'] . "</td> </tr>";
                echo  "<tr> <th>Username:</th> echo <td>" . $row['username'] . "</td> </tr>";
                echo  "<tr> <th>Date of birth:</th> echo <td>" . $row['dob'] . "</td> </tr>";
                echo  "<tr> <th>Gender:</th> echo <td>" . $row['gender'] . "</td> </tr>";
                echo  "<tr> <th>About me:</th> echo <td>" . $row['bio'] . "</td></tr>";
                echo "<tr>"; 
                 
            }
            echo "</table>";
            
        }
    }

    
    


?>