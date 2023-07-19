<?php
require 'config.php';
        if (!empty($_SESSION["id"])) 
            {
            $id = $_SESSION["id"];
            $result = mysqli_query($conn, "SELECT * FROM uzytkownik WHERE id = $id");
            $sessionRow = mysqli_fetch_assoc($result);            
            }
            else {
                //Jeżeli nie wystepuje sesja, przekieruj do strony głównej
                header("Location: index.php");
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
    <!--"Mięso" strony-->
    <article>
        <h1>Lista pracowników firmy XYZ:</h1> <hr> <br>
        <table>
            <tr>
                <th>ID</th>
                <th>Imię</th>
                <th>Nazwisko</th>
                <th>E-mail</th>
                <th>Telefon</th>
                <!-- <th>Hasło</th> -->
                <th>Rola</th>
                <th>Operacje</th>
            </tr>
<?php
    $result = mysqli_query($conn, "SELECT * FROM uzytkownik");

    if ($result) 
    {
        while ($row = mysqli_fetch_assoc($result)) 
        {
            //<td> '.$row['haslo'].' </td>
            $rowID = $row['ID'];
            echo'
            <tr>
                <td> '.$row['ID'].' </td>
                <td> '.$row['imie'].' </td>
                <td> '.$row['nazwisko'].' </td>
                <td> '.$row['email'].' </td>
                <td> '.$row['telefon'].' </td>
                <td> '.$row['rola'].' </td>
                <td> <button type="button"><a  href="pracownikInfo.php?infoid=';
                echo $rowID;
                echo '">Szczegóły, </a></button>';
                if ($sessionRow['rola'] == 'Admin') {
                    //operacje
                    echo'<button type="button"><a  href="pracownikModyfikuj.php?modifyid=';
                    echo $rowID;
                    echo '">Modyfikuj </a></button>';

                    echo'<button type="button"><a  href="pracownikUsun.php?deleteid=';
                    echo $rowID;
                    echo'">Usuń </a></button>';
                }
                else if ($sessionRow['rola'] == 'Moderator' && $row['rola'] == 'Pracownik' ) {
                    //operacje
                    echo'<button type="button"><a  href="pracownikModyfikuj.php?modifyid=';
                    echo $rowID;
                    echo '">Modyfikuj </a></button>';
                    
                    echo'<button type="button"><a  href="pracownikUsun.php?deleteid=';
                    echo $rowID;
                    echo'">Usuń </a></button>';
                }
                
                echo '</td>
            </tr>';
             /*   
            if ($sessionRow['rola'] == 'Moderator' && $row['rola'] == 'Pracownik' ) {
                //operacje
            }
            if ($sessionRow['rola'] == 'Admin') {
                //operacje
            }*/
        }
    }

?>
        </table>


    </article>
    </body>
</html>
