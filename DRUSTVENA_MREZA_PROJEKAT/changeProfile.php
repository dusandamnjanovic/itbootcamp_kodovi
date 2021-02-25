<?php
    require_once "header.php";
    require_once "connection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Profile</title>
    <link rel="stylesheet" href="stil.css">
</head>
<body>  

<?php
        $name = $surname = $date = $korisnicko_ime = "";
        $nameErr = $surnameErr = $dateErr = "";
        $prikaz = false;

        $imePrezime = $_SESSION['ime_prezime'];
        echo "<h3 class='pozdrav'> Hello, $imePrezime, edit your data here!</h3>";
       
        $id = $_SESSION['id'];
        $q = "SELECT * FROM users
            INNER JOIN profiles
            ON users.id=profiles.user_id
            WHERE users.id=$id";
        $result = $conn->query($q);
        if(!$result->num_rows){
            echo "Error";
        }
        else{
            foreach($result as $row){
                $_SESSION['name'] = $row['name'];
                $_SESSION['surname'] = $row['surname'];
                $_SESSION['date'] = $row['dob'];
                $_SESSION['gender'] = $row['gender'];
                $_SESSION['username'] = $row['username'];
            }
        }

        $name = $_SESSION['name'];
        $surname = $_SESSION['surname'];
        $date = $_SESSION['date'];
        $gender = $_SESSION['gender'];
        $korisnicko_ime = $_SESSION['username'];
      

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $name = $_POST['name'];
            $surname = $_POST['surname'];
            $date = $_POST['date'];
            $korisnicko_ime = $_POST['username'];
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
            

            if(empty($_POST["gender"])){
                $prikazi = false;
            }
            
        }

        if($prikaz){
            
            $id = $_SESSION['id'];
            $name = $conn->real_escape_string($name);
            $surname = $conn->real_escape_string($surname);

            $q = "UPDATE profiles
                  SET 
                  name='$name', surname='$surname', dob='$date', gender='$gender'
                  WHERE user_id=$id";
            $result = $conn->query($q);
        }
       
?>  

    <div class="forma_change">
        
        <form action="#" method="post">
            
            <p>
                <label>Name:</label>
                <input type="text" name="name" value="<?php echo $name ?>">
                <span class="error">*<?php if($nameErr){echo $nameErr;} ?></span>
            </p>

            <p>
                <label>Surname:</label>
                <input type="text" name="surname" value="<?php echo $surname ?>">
                <span class="error">*<?php if($surnameErr){echo$surnameErr;} ?></span>
            </p>
            

            <p>
                <label>Date of birth:</label><br>
                <input type="date" name="date" min="1900-01-01" value="<?php echo $date ?>">
                <span class="error">*<?php if($dateErr){echo $dateErr;} ?></span>
            </p>

            <p>
                <label>Username</label>
                <input type="text" name="username" value="<?php echo $korisnicko_ime ?>"  readonly="readonly">
            </p>

            <p>
                <label>Password:</label>
                <input type="password" name="password"  readonly="readonly">
                
            </p>

            <p>
                <label>Re-type password</label>
                <input type="password" name="repassword"  readonly="readonly">
                
            </p>

            <p>
                <span>Gender:</span><br> 
                <?php
                if($gender == 'm'){
                    echo  "<input type='radio' name='gender' value='m' checked>Male";
                    echo  "<input type='radio' name='gender' value='f'>Female";
                    echo  "<input type='radio' name='gender' value='o'>Other";            
                }
                elseif($gender == 'f'){
                    echo  "<input type='radio' name='gender' value='m'>Male";
                    echo  "<input type='radio' name='gender' value='f' checked>Female";
                    echo  "<input type='radio' name='gender' value='o'>Other"; 
                }
                else{
                    echo  "<input type='radio' name='gender' value='m'>Male";
                    echo  "<input type='radio' name='gender' value='f'>Female";
                    echo  "<input type='radio' name='gender' value='o' checked>Other"; 
                }
                ?> 
            </p>

            <p>
                <input type="submit" name="submit" value="Submit">
            </p>

        </form>
        
    </div>

    

    

</body>
</html>