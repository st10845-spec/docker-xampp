<?php
session_start();

$login_error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["username"], $_POST["password"])) 
{

    $username = $_POST['username'];
    $user_password = $_POST['password'];

    $connection = new mysqli("db", "user", "user", "ChatRoom", 3306);

    if ($connection->connect_error) 
    {
        die("Errore DB");
    }

    $stmt = $connection->prepare("SELECT username, password_hash FROM utenti WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) 
    {
        $row = $result->fetch_assoc();

        if (password_verify($user_password, $row['password_hash'])) 
        {
            $_SESSION['username'] = $username;
            header("Location: dashboard.php");
            exit;
        } 
        else 
        {
            $login_error = "Password errata";
        }
    } 
    else 
    {
        $login_error = "Utente non trovato. Registrati prima.";
    }
    
    $stmt->close();
    $connection->close();
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <form method="POST">
        <h1 class="title has-text-centered">Link Shorter</h1>
        <h2 class="subtitle has-text-centered">Login</h2>

        <div class="field">
            <label class="label">Username</label>
            <div class="control">
                <input class="input" name="username" required>
            </div>
        </div>

        <div class="field">
            <label class="label">Password</label>
            <div class="control">
                <input class="input" type="password" name="password" required>
            </div>
        </div>

        <div class="field">
            <label class="label">Email</label>
            <div class="control">
                <input class="input" type="email" name="email" required>    
            </div>
        </div>

        <div class="field">
            <button class="button is-primary is-fullwidth">
                Accedi
            </button>
        </div>
    </form>
    <div class="has-text-centered mt-3">
        Sei qui per la prima volta?
        <a href="registrazione.php">Registrati</a>
    </div>

    <?php if ($login_error): ?>
        <div class="notification is-danger mt-3">
            <?= htmlspecialchars($login_error) ?>
        </div>
    <?php endif; ?>

</div>

</body>
</html>
