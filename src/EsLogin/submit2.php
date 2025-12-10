
<?php
// Ricezione dati tramite POST
$nome = $_POST['nome'];
$password = $_POST['password'];
$email = $_POST['email'];

echo "<h1>Dati ricevuti con POST</h1>";
echo "Nome: " . htmlspecialchars($nome) . "<br>";
echo "Password: " . htmlspecialchars($password) . "<br>";
echo "Email: " . htmlspecialchars($email) . "<br>";
?>