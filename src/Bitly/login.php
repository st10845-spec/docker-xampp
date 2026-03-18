<?php
session_start();
require 'connessione.php';
$login_error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["email"], $_POST["password"])) 
{
    $email = $_POST['email'];
    $user_password = $_POST['password'];

    $stmt = $conn->prepare("SELECT email, password FROM Users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) 
    {
        $row = $result->fetch_assoc();

        if (password_verify($user_password, $row['password'])) 
        {
            $_SESSION['email'] = $email;
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
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
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
        <form method="POST">
            <h1 class="title has-text-centered">Link Shortener</h1>
            <h2 class="subtitle has-text-centered">Login</h2>

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
                <button class="button is-primary is-fullwidth">Accedi</button>
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