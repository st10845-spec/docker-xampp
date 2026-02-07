<?php
session_start();
if (!isset($_SESSION['username'])) 
{
    header("Location: login.php");
    exit;
}

date_default_timezone_set("Europe/Rome");

$chatroom_id = $_GET['id'];
$username = $_SESSION['username'];

$connection = new mysqli("db", "user", "user", "ChatRoom", 3306);

// invio messaggio
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $testo = $_POST['testo'];

    $stmt = $connection->prepare("INSERT INTO messaggio (testo, data, username, id_chatroom)VALUES (?, NOW(), ?, ?)");
    $stmt->bind_param("ssi", $testo, $username, $chatroom_id);
    $stmt->execute();
}

// recupero messaggi
$stmt = $connection->prepare("SELECT username, testo, data FROM messaggio WHERE id_chatroom = ? ORDER BY data ASC");
$stmt->bind_param("i", $chatroom_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<?php
    $ultima_data = null;
    while($row = $result->fetch_assoc()):
    $isMe = ($row['username'] === $_SESSION['username']);
    $data_corrente = date("d/m/Y", strtotime($row['data']));

    // Se la data è cambiata rispetto all'ultimo messaggio stampato
    if ($data_corrente !== $ultima_data) 
    {
        echo '<div class="chat-date">' . $data_corrente . '</div>';
        $ultima_data = $data_corrente;
    }
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


        <!-- CHAT -->
        
        <div class="chat-box" id="chatBox">
            <?php while($row = $result->fetch_assoc()):
                $isMe = ($row['username'] === $_SESSION['username']);
            ?>
                <div class="chat-row <?= $isMe ? 'me' : 'other' ?>">
                    <div class="chat-bubble">
                        <span class="chat-user"><?= htmlspecialchars($row['username']) ?>:</span>
                        <span class="chat-text"><?= nl2br(htmlspecialchars($row['testo'])) ?></span>
                        <span class="chat-time"><?= date("H:i", strtotime($row['data'])) ?>

                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
    <!-- FORM -->
    <form method="POST">
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







.chat-box {
    background: #e5ddd5; /* sfondo chiaro tipo WhatsApp */
    padding: 15px;
    height: 400px; /* altezza fissa */
    overflow-y: auto; /* scroll verticale */
    border-radius: 10px;
    box-shadow: inset 0 0 5px rgba(0,0,0,0.1);
    margin-bottom: 1rem;
}

.chat-row {
    display: flex;
    margin-bottom: 10px;
    max-width: 70%;
}

.chat-row.me {
    justify-content: flex-end;
}

.chat-row.other {
    justify-content: flex-start;
}

.chat-bubble {
    padding: 10px 14px;
    border-radius: 10px;
    position: relative;
    box-shadow: 0 1px 0.5px rgba(0,0,0,0.13);
    word-wrap: break-word;
}

.chat-row.me .chat-bubble {
    background-color: #dcf8c6; /* verde chiaro */
    text-align: right;
}

.chat-row.other .chat-bubble {
    background-color: white;
}

.chat-user {
    font-weight: bold;
    margin-bottom: 5px;
}

.chat-time {
    font-size: 0.7rem;
    color: #777;
    margin-top: 5px;
}