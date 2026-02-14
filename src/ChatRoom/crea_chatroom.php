<?php
session_start();

// Controllo login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Controllo input
if (!isset($_POST['nome']) || trim($_POST['nome']) === '') {
    die("Nome della chatroom non valido");
}

$nome = trim($_POST['nome']);
$username = $_SESSION['username'];

// Connessione
$connection = new mysqli('db', 'user', 'user', 'ChatRoom', 3306);
if ($connection->connect_error) {
    die("Errore connessione: " . $connection->connect_error);
}

// Controllo se esiste già
$stmt = $connection->prepare("SELECT id FROM chatrooms WHERE name = ?");
$stmt->bind_param("s", $nome);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    die("Esiste già una chatroom con questo nome");
}
$stmt->close();

// Inserimento chatroom
$stmt = $connection->prepare("INSERT INTO chatrooms (name, creator) VALUES (?, ?)");
$stmt->bind_param("ss", $nome, $username);

if (!$stmt->execute()) {
    die("Errore creazione chatroom: " . $stmt->error);
}

// Recupero ID della chatroom appena creata
$chatroom_id = $stmt->insert_id;
$stmt->close();

// 🔐 Inserisco il creatore come membro
$stmt = $connection->prepare("INSERT INTO chatroom_users (chatroom_id, username) VALUES (?, ?)");
$stmt->bind_param("is", $chatroom_id, $username);
$stmt->execute();
$stmt->close();

$connection->close();

header("Location: dashboard.php");
exit;
?>
