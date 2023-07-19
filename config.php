<?php
//rozpoczęcie sesji
session_start();
// Dołączenie bazy danych i sprawdzenie połączenia z nią
$conn = new mysqli("localhost",'root', '',"uzytkownicy");
if ($conn->connect_error) {
    die("Błąd połączenia z bazą danych. Komunikat błędu: " . mysqli_connect_error()); 
}
?>