<?php
$host = "db";
$user = "user";
$pass = "user";
$db   = "LinkShortner";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) 
{
    die("Errore connessione: " . $conn->connect_error);
}
?>
