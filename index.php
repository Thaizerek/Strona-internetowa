
<?php
require 'config.php';
        if (!empty($_SESSION["id"])) 
            {
            $id = $_SESSION["id"];
            $result = mysqli_query($conn, "SELECT * FROM uzytkownik WHERE id = $id");
            $sessionRow = mysqli_fetch_assoc($result);
            }
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Mariusz Sypniewski">
    <meta name="description" content="Firma XYZ"> 
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
    <!--"Mięso" strony głównej-->
    <article>
    <h1>Witamy w rejestrze pracowników firmy XYZ!</h1> <hr> <br>
        
        <?php
        if (!empty($_SESSION["id"])) 
            {
            echo('<a style="float: center;" href="listaPracownikow.php">Lista pracowników</a>');            
            }
        ?>
    </article>
    </body>
</html>
