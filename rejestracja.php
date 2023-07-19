<?php

require 'config.php';
// Jeżeli występuje sesja, to przekieruj na stronę główną
        if (!empty($_SESSION["id"])) 
            {
            header("Location: index.php");
            }
if (isset($_POST["submit"])) 
{
    $imie = $_POST["imie"];
    $nazwisko = $_POST["nazwisko"];
    $email = $_POST["email"];
    $telefon = $_POST["telefon"];
    $haslo = $_POST["haslo"];
    $powtorzHaslo = $_POST["powtorzHaslo"];
    $duplikat = mysqli_query($conn, "SELECT * FROM uzytkownik WHERE telefon = '$telefon' OR email = '$email' ");
    
    // Sprawdzenie, czy nie występuje dany telefon, lub email w bazie danych
    if (mysqli_num_rows($duplikat) > 0) {
        echo
        "<script> alert('Istnieje już uzytkownik z podanym numerem telefonu lub adresem E-mail') </script>";
    }
    else {

        /*
        Ściąga: 
        https://miroslawmamczur.pl/wyrazenia-regularne-czym-sa-i-jak-pisac-wlasne-regexy/

        https://www.w3schools.com/php/php_regex.asp

        \d – dowolna liczba
        \D – nie liczba
        \w – dowolna litera
        \W – nie litera
        \s – biały znak
        \S – nie biały znak
        . – dowolny znak
        \ – wyjściowy znak
        \b – granica słowa
        \B – nie granica słowa
        ^ – początek ciągu
        $ – koniec ciągu

        * – 0 lub więcej
        + – 1 lub więcej
        ? – 0 lub 1
        {} – dokładna liczba znaków
        {min, max} – zakres liczby znaków

        [ ] – dopasowuje wszystkie znaki w nawiasach
        [^ ] – dopasowuje wszystkie znaki spoza nawiasów
        () – grupowanie
        | – albo

        preg_match() - zwraca 0, lub 1 jeżeli znajdzie dopasowanie.

         */

        //Wprowadzenie wyrażenia regularnego dla numeru telefonu
        $telpattern = "/\d{9}/";
        //Wprowadzenie wyrażenia regularnego dla hasła
        $haslopattern = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/";
        if (!(preg_match($telpattern, $telefon))) {
            echo
        "<script> alert('Podano nieprawidłowy format numeru telefonu') </script>";
        }


         
        else if (!(preg_match($haslopattern, $haslo))) {
            echo
        "<script> alert('Podano nieprawidłowy format hasła') </script>";
        }

        // Sprawdzenie pól hasło i powtórz hasło
        else if ($haslo == $powtorzHaslo) 
        {
            $haslo = password_hash($haslo, PASSWORD_DEFAULT);
            

            $result = mysqli_query($conn, "SELECT * FROM uzytkownik" );
           // if (mysqli_num_rows($result) == 0)

            
            if (mysqli_num_rows($result) > 0) 
            {
                $query = "INSERT INTO uzytkownik VALUES('','$imie','$nazwisko','$email','$telefon','$haslo','Pracownik')";
            }
            
            else
            {
                $query = "INSERT INTO uzytkownik VALUES('','$imie','$nazwisko','$email','$telefon','$haslo','Admin')";
                
            }
            mysqli_query($conn, $query);
            echo
        "<script> alert('Pomyślna rejestracja konta') </script>";
        }
        else {
            echo
        "<script> alert('Pole Hasło i Powtórz Hasło się nie zgadzają!') </script>";
        }
    }
}

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
     <!--   <a href="#news">Zalogowany jako: </a> -->
        <a style="float: right;" href="login.php">Zaloguj się</a>
        <a style="float: right;" href="Rejestracja.php">Rejestracja</a>
    </div>
    <!--Formularz-->
    <form method="post" action="rejestracja.php" > 
        <fieldset>
            <h1><strong>Zarejestruj się</strong></h1> 

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
            
            <label for="powtorzHaslo">Powtórz Hasło: </label>
            <input type="password" name="powtorzHaslo" id="powtorzHaslo" required><br><br>

            <input type="submit" name="submit" id="submit">
            
            <input type="reset" name="reset" id="reset">

            

        </fieldset>
    </form>
</body>
</html>