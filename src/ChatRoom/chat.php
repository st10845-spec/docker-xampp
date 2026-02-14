<?php
session_start();
if (!isset($_SESSION['username']))
{
    header("Location: login.php");
    exit;
}


$chatroom_id = $_GET['id'];
$username = $_SESSION['username'];

$connection = new mysqli("db", "user", "user", "ChatRoom", 3306);

// invio messaggio
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $testo = $_POST['testo'];
    $stmt = $connection->prepare("INSERT INTO messaggio (testo, data, username, id_chatroom) VALUES (?, NOW(), ?, ?)");
    $stmt->bind_param("ssi", $testo, $username, $chatroom_id);
    $stmt->execute();
}

// recupero messaggi
$stmt = $connection->prepare("SELECT username, testo, data FROM messaggio WHERE id_chatroom = ? ORDER BY data ASC");
$stmt->bind_param("i", $chatroom_id);
$stmt->execute();
$result = $stmt->get_result();
?>


<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Chatroom</title>

    <!-- Bulma -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">

    <!-- CSS chat -->
    <link rel="stylesheet" href="css/chat.css">
</head>
<body class="has-background-light">

<section class="section">
    <div class="container">
        <h2 class="title is-4">Chatroom</h2>
        <div style="border:1px solid black; padding:10px; height:300px; overflow-y:scroll;">

        <!-- CHAT BOX -->
        <div class="chat-box" id="chatBox">
            <?php
            $ultima_data = null;
            while($row = $result->fetch_assoc()):
                $isMe = ($row['username'] === $_SESSION['username']);
                $data_corrente = date("d/m/Y", strtotime($row['data']));

                // Stampa la data solo se cambia
                if ($data_corrente !== $ultima_data) 
                {
                    echo '<div class="chat-date">' . $data_corrente . '</div>';
                    $ultima_data = $data_corrente;
                }
            ?>
                <div class="chat-row <?= $isMe ? 'me' : 'other' ?>">
                    <div class="chat-bubble">
                        <span class="chat-user"><?= htmlspecialchars($row['username']) ?>:</span>
                        <span class="chat-text"><?= nl2br(htmlspecialchars($row['testo'])) ?></span>
                        <span class="chat-time"><?= date("H:i", strtotime($row['data'])) ?></span>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>

    </div>
    <!-- FORM -->
    <form method="POST" class="chat-form">
        <div class="field has-addons">
            <div class="control is-expanded">
                <input class="input" type="text" name="testo" placeholder="Scrivi un messaggio..." required>
            </div>
            <div class="control">
                <button class="button is-success">Invia</button>
            </div>
        </div>
    </form>
    <a href="dashboard.php">⬅ Torna alle chatroom</a>
</section>


<script>
    // scroll automatico all'ultimo messaggio
    const chatBox = document.getElementById("chatBox");
    chatBox.scrollTop = chatBox.scrollHeight;
</script>

</body>
</html>
