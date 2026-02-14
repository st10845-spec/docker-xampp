<?php
session_start();

// Controllo login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Controllo ID
if (!isset($_POST['id'])) {
    die("ID non valido");
}

$id = (int) $_POST['id'];

// Connessione DB
$connection = new mysqli("db", "user", "user", "ChatRoom", 3306);
if ($connection->connect_error) {
    die("Errore connessione");
}

// Elimina chatroom
$stmt = $connection->prepare("DELETE FROM chatrooms WHERE id = ?");
$stmt->bind_param("i", $id);

if (!$stmt->execute()) {
    die("Errore eliminazione");
}

$stmt->close();
$connection->close();

// Redirect
header("Location: dashboard.php");
exit;
