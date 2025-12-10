<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nome = $_POST["nome"];
    $password = $_POST["password"];

    // hashing della password
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    //presi dal docker-compose.yml
    $host = 'db'; 
    $dbname = 'root_db'; 
    $user = 'user';
    $password = 'user';
    $port = 3306;

   $conn = new mysqli($host, $user, $password, $dbname, $port);

    // connessione MySQLi

    if ($conn->connect_error) {
        die("Errore connessione: " . $conn->connect_error);
    }

    // query preparata
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $nome, $password);

    if ($stmt->execute()) {
        echo "Registrazione effettuata! <a href='login.html'>Vai al login</a>";
    } else {
        echo "Errore: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

