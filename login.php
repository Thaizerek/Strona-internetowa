<?php

require 'config.php';
// Jeżeli występuje sesja, to przekieruj na stronę główną
if (!empty($_SESSION["id"])) 
            {
            header("Location: index.php");
            }
if (isset($_POST["submit"])) {
    $email = $_POST["email"];
    $haslo = $_POST["haslo"];
    $result = mysqli_query($conn, "SELECT * FROM uzytkownik WHERE email = '$email'" );
    $row = mysqli_fetch_assoc($result);
    if (mysqli_num_rows($result) > 0) {
        //$haslo = password_hash($haslo, PASSWORD_DEFAULT);
        //if ($haslo == $row["haslo"]) {
            //password_verify() służy do porównania funkcji hash (crypt) z bazy danych do wprowadzonego hasła w procesie logowania
            if (password_verify($haslo, $row["haslo"])) 
            {
            $_SESSION["login"] = true;
            $_SESSION["id"] = $row["ID"];
            header("Location: index.php");
            }
        else 
        {
            echo
        "<script> alert('Błędne hasło') </script>";
        }
    }
    else {
        echo
        "<script> alert('Użytkownik o podanym adresie E-mail nie został zarejestrowany') </script>";
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
    <form method="post" action="Login.php" > 
        <fieldset>
            <h1><strong>Zaloguj się</strong></h1> 

            <label for="e-mail">E-mail </label>
            <input type="email" name="email" id="email"required><br>

            <label for="Haslo">Hasło: </label>
            <input type="password" name="haslo" id="haslo" required><br><br>

            <input type="submit" name="submit" id="submit">
            
            <input type="reset" name="reset" id="reset">

        </fieldset>
    </form>

</body>
</html>