<?php
// Ricezione dati tramite GET
$nome = $_GET['nome'];
$password = $_GET['password'];
$email = $_GET['email'];

echo "<h1>Dati ricevuti con GET</h1>";
echo "Nome: " . htmlspecialchars($nome) . "<br>";
echo "Password: " . htmlspecialchars($password) . "<br>";
echo "Email: " . htmlspecialchars($email) . "<br>";
?>
