<?php 
session_start();

if (!isset($_SESSION['username'])) 
{
    header("Location: login.php");
    exit;
}

$connection = new mysqli("db", "user", "user", "LinkShortner", 3306);

if ($connection->connect_error) {
    die("Errore connessione DB");
}

$url_shortato = "";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['original_url'])) 
{
    $original_url = trim($_POST['original_url']);

    // Genera codice casuale di 6 caratteri
    $short_code = substr(md5(uniqid()), 0, 6);

    $stmt = $connection->prepare(
        "INSERT INTO Links (ID_utente, original_URL, short_URL, n_visits) VALUES ((SELECT ID FROM Users WHERE username = ?), ?, ?, 0)"
    );

    /*$stmt->bind_param("sss", $_SESSION['username'], $original_url, $short_code);
    
    if ($stmt->execute()) {
        // Costruisci URL completo
        $url_shortato = "http://localhost/index.php?code=" . $short_code;
    }

    $stmt->close();*/
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>

<div class="container">
    <h3>Ciao <?php echo htmlspecialchars($_SESSION['username']); ?> 👋</h3>
</div>

<form method="POST">
    <div class="field">
        <label>Link Originale</label>
        <input type="url" name="original_url" required>
    </div>

    <button type="submit">Accorcia</button>
</form>
<?php if ($url_shortato): ?>
    <div style="margin-top:20px;">
        <p><strong>Il tuo link accorciato:</strong></p>
        <input type="text" value="<?php echo htmlspecialchars($url_shortato); ?>" readonly style="width:300px;">
    </div>
<?php endif; ?>

</body>
</html>
    


