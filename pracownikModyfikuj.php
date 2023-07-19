<?php

require 'config.php';
$id = $_GET['modifyid'];
// Jeżeli nie występuje sesja, to przekieruj na stronę główną
        if (empty($_SESSION["id"])) 
            {
            header("Location: index.php");
            }
            $sessionID = $_SESSION["id"];
            $sessionResult = mysqli_query($conn, "SELECT * FROM uzytkownik WHERE id = $sessionID");
            $sessionRow = mysqli_fetch_assoc($sessionResult);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Arkusz.css">
    <title>Firma XYZ</title>
</head>
<body>
    <!-- Panel nawigacyjny-->
    <div class="topnav">
        <a class="active" href="index.php">Strona Główna</a>

        <?php
        if (!empty($_SESSION["id"])) 
            {
            echo('<a style="float: right;" href="wyloguj.php">Wyloguj się</a>');
            echo'<div style="float: right;">
            Zalogowany jako: <b>',$sessionRow['rola'] ,' ',$sessionRow["email"],'</b>
            </div>';
            }
        else 
            {
            echo('<a style="float: right;" href="login.php">Zaloguj się</a>');
            echo('<a style="float: right;" href="Rejestracja.php">Rejestracja</a>');
            }   
        ?>
    </div>
    <!--Formularz-->
    <form method="post" action="pracownikModyfikuj.php" > 
        <fieldset>
            <h1><strong>Zaktualizuj użytkownika</strong></h1> 

            <label for="imie">Imię: </label>
            <input type="text" name="imie" id="imie" required ><br>

            <label for="nazwisko">Nazwisko: </label>
            <input type="text" name="nazwisko" id="nazwisko" required ><br>

            <label for="e-mail">E-mail </label>
            <input type="email" name="email" id="email" required placeholder="np. abc@gmail.com"><br>

            <label for="telefon">Telefon: </label>
            <input type="tel" name="telefon" id="telefon" required placeholder="np. 123456789"><br><hr>

            <div>
                Hasło musi zawierać przynajmniej 8 znaków w tym: 1 dużą literę, 1 małą literę, 1 cyfrę, 1 znak specjalny. <br>
            </div>
            <label for="haslo">Hasło: </label>
            <input type="password" name="haslo" id="haslo" required><br>
        
            <?php
            if ($sessionRow['rola']=='Admin') {         
            ?>
            <input type="radio" id="Admin" name="rola" value="Admin">
            <label for="Admin">Admin</label><br>
            <input type="radio" id="Moderator" name="rola" value="Moderator">
            <label for="Moderator">Moderator</label><br>
            <?php
            }
            ?>

            <input type="radio" id="Pracownik" name="rola" value="Pracownik" checked>
            <label for="Pracownik">Pracownik</label><br><br>
        
            <input type="submit" name="submit" id="submit">
            
            <input type="reset" name="reset" id="reset">

            

        </fieldset>
    </form>
</body>
</html>

<?php
if (isset($_POST["submit"])) 
{
    $imie = $_POST["imie"];
    $nazwisko = $_POST["nazwisko"];
    $email = $_POST["email"];
    $telefon = $_POST["telefon"];
    $haslo = $_POST["haslo"];
    $rola = $_POST["rola"];
    $duplikat = mysqli_query($conn, "SELECT * FROM uzytkownik WHERE telefon = '$telefon' OR email = '$email' ");
    
// Sprawdzenie, czy nie występuje dany telefon, lub email w bazie danych
if (mysqli_num_rows($duplikat) > 0) 
{
    echo
    "<script> alert('Istnieje już uzytkownik z podanym numerem telefonu lub adresem E-mail') </script>";
}
else 
{

    //Wprowadzenie wyrażenia regularnego dla numeru telefonu
    $telpattern = "/\d{9}/";

    //Wprowadzenie wyrażenia regularnego dla hasła
    $haslopattern = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/";

    if (!(preg_match($telpattern, $telefon))) 
    {
        echo
    "<script> alert('Podano nieprawidłowy format numeru telefonu') </script>";
    } 
    else if (!(preg_match($haslopattern, $haslo))) {
        echo
    "<script> alert('Podano nieprawidłowy format hasła') </script>";
    }

    else 
    {
        $haslo = password_hash($haslo, PASSWORD_DEFAULT);
        $query = "UPDATE `uzytkownik` SET `imie` = '$imie', `nazwisko` = '$nazwisko', `email` = '$email', `telefon` = '$telefon', `rola` = '$rola' WHERE `uzytkownik`.`ID` = $id";
        
        $result = mysqli_query($conn, $query);
        header("Location: listaPracownikow.php");
    }
    
    
}
}
?>