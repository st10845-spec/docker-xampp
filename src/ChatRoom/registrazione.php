
<?php
$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["username"], $_POST["password"])) 
{

    $connection = new mysqli("db", "user", "user", "ChatRoom", 3306);
    if ($connection->connect_error) 
    {
        die("Errore DB");
    }

    $username = $_POST['username'];
    $password = $_POST['password'];
    $hash = password_hash($password, PASSWORD_DEFAULT);

    $check = $connection->prepare("SELECT username FROM utenti WHERE username = ?");
    $check->bind_param("s", $username);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) 
    {
        $error = "Username già esistente";
    } 
    else 
    {
        $stmt = $connection->prepare("INSERT INTO utenti (username, password_hash) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $hash);

        if ($stmt->execute()) 
        {
            $success = "Registrazione completata! Ora puoi effettuare il login.";
        } 
        else 
        {
            $error = "Errore nella registrazione";
        }
        $stmt->close();
    }

    $check->close();
    $connection->close();
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Registrazione</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.4/css/bulma.min.css">

    <style>
        body 
        {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #1f2933;
        }

        .page-wrapper 
        {
            width: 100%;
            max-width: 420px;
            padding: 1.5rem;

        }

        .top-message 
        {
            margin-bottom: 15px;
            border-radius: 10px;
            text-align: center;
            font-weight: 500;
        }
    </style>
</head>

<body>

<div class="page-wrapper">

    <!-- Se esiste un messaggio di successo, esegui le righe sotto -->   
    <?php if ($success): ?>
        <div class="notification is-success top-message">
            <?= htmlspecialchars($success) ?>
        </div>
    <?php endif; ?>

    <?php if ($error): ?>
        <div class="notification is-danger top-message">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <div class="box register-box">

        <form method="POST">
            <h1 class="title has-text-centered">Registrazione</h1>

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
                <button class="button is-primary is-fullwidth">
                    Registrati
                </button>
            </div>
        </form>

        <div class="has-text-centered mt-3">
            Hai già un account? <a href="login.php">Accedi</a>
        </div>

    </div>

</div>

<?php if ($success): ?>
<script>
    setTimeout(() => { window.location.href = "login.php";}, 2500);
</script>
<?php endif; ?>

</body>
</html>
