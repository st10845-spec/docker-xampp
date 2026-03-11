<?php
$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["email"], $_POST["password"])) 
{
    require 'connessione.php';

    $email    = $_POST['email'];
    $password = $_POST['password'];
    $hash     = password_hash($password, PASSWORD_DEFAULT);

    $check = $conn->prepare("SELECT email FROM Users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) 
    {
        $error = "Email già esistente";
    } 
    else 
    {
        $stmt = $conn->prepare("INSERT INTO Users (email, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $email, $hash);

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
    $conn->close();
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
            background-color: #f5f5f5;
        }

        .login-box 
        {
            width: 100%;
            max-width: 420px;
            padding: 1.5rem;
        }
    </style>
</head>
<body>
    <div class="box login-box">

        <?php if ($success): ?>
            <div class="notification is-success">
                <?= htmlspecialchars($success) ?>
            </div>
        <?php endif; ?>

        <?php if ($error): ?>
            <div class="notification is-danger">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <h1 class="title has-text-centered">Registrazione</h1>

            <div class="field">
                <label class="label">Email</label>
                <div class="control">
                    <input class="input" type="email" name="email" required>
                </div>
            </div>

            <div class="field">
                <label class="label">Password</label>
                <div class="control">
                    <input class="input" type="password" name="password" required>
                </div>
            </div>

            <div class="field">
                <button class="button is-primary is-fullwidth">Registrati</button>
            </div>
        </form>

        <div class="has-text-centered mt-3">
            Hai già un account? <a href="login.php">Accedi</a>
        </div>

    </div>

    <?php if ($success): ?>
    <script>
        setTimeout(() => { window.location.href = "login.php"; }, 2500);
    </script>
    <?php endif; ?>
</body>
</html>