<?php
require 'config.php';
if (isset($_GET)) {
    $id=$_GET['deleteid'];

    $sql = "DELETE FROM uzytkownik WHERE ID = $id";
    $result = mysqli_query($conn, $sql);
    if ($result) {
       // echo "<script> alert('Pomyślnie usunięto użytkownika z bazy danych') </script>";
        header("Location: listaPracownikow.php");
    }
    else {
        die(mysqli_error($conn));
    }
}
?>