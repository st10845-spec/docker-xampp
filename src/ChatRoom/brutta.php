<?php
session_start();

// Controllo login
if (!isset($_SESSION['username'])) 
{
    header("Location: login.php");
    exit;
}

// Controllo input
if (!isset($_POST['nome']) || trim($_POST['nome']) === '') 
{
    die("Nome della chatroom non valido");
}

$nome = trim($_POST['nome']);
$username = $_SESSION['username'];

// Connessione al database
$connection = new mysqli('db', 'user', 'user', 'ChatRoom', 3306);
if ($connection->connect_error) 
{
    die("Errore connessione: " . $connection->connect_error);
}

// (Opzionale ma consigliato) controlla se la chatroom esiste già
$stmt = $connection->prepare("SELECT id FROM chatrooms WHERE name = ?" );
$stmt->bind_param("s", $nome);
$stmt->execute();



$stmt->store_result();

if ($stmt->num_rows > 0) 
{
    die("Esiste già una chatroom con questo nome");
}
$stmt->close();

// Inserimento chatroom
$stmt = $connection->prepare( "INSERT INTO chatrooms (name, creator) VALUES (?, ?)");
$stmt->bind_param("ss", $nome, $username);

if (!$stmt->execute()) 
{
    die("Errore creazione chatroom: " . $stmt->error);
}

$stmt->close();
$connection->close();

// Redirect
header("Location: dashboard.php");
exit;
?>

