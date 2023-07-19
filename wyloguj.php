<?php
require 'config.php';
// zakończenie sesji
$_SESSION = [];
session_unset();
session_destroy();
header("Location: login.php");
?>