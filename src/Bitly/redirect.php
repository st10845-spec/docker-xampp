<?php
require 'connessione.php';

if (isset($_GET['code'])) 
{
    $code = $_GET['code'];

    $stmt = $conn->prepare("SELECT original_URL FROM Links WHERE short_URL = ?");
    $stmt->bind_param("s", $code);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) 
    {
        $row = $result->fetch_assoc();

        // Incrementa contatore visite
        $update = $conn->prepare("UPDATE Links SET n_visits = n_visits + 1 WHERE short_URL = ?");
        $update->bind_param("s", $code);
        $update->execute();
        $update->close();

        header("Location: " . $row['original_URL']);
        exit;
    } 
    else 
    {
        echo "Link non trovato.";
    }

    $stmt->close();
}

$conn->close();
?>