<?php 
session_start();
if (!isset($_SESSION['email'])) 
{
    header("Location: login.php");
    exit;
}

require 'connessione.php';

$url_shortato = "";

// Accorcia un nuovo link
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['original_url'])) 
{
    $original_url = trim($_POST['original_url']);

    if (filter_var($original_url, FILTER_VALIDATE_URL)) 
    {
        // Genera codice univoco (controlla collisioni)
        do {
            $short_code = substr(md5(uniqid()), 0, 6);
            $check = $conn->prepare("SELECT ID FROM Links WHERE short_URL = ?");
            $check->bind_param("s", $short_code);
            $check->execute();
            $check->store_result();
        } while ($check->num_rows > 0);
        $check->close();

        $stmt = $conn->prepare(
            "INSERT INTO Links (ID_utente, original_URL, short_URL, n_visits) 
             VALUES ((SELECT ID FROM Users WHERE email = ?), ?, ?, 0)"
        );
        $stmt->bind_param("sss", $_SESSION['email'], $original_url, $short_code);

        if ($stmt->execute()) 
        {
            $url_shortato = "http://localhost/" . $short_code;
        }

        $stmt->close();
    }
}

// Carica lista link dell'utente
$links = [];
$stmt_list = $conn->prepare(
    "SELECT l.original_URL, l.short_URL, l.n_visits, l.created_at 
     FROM Links l
     JOIN Users u ON l.ID_utente = u.ID
     WHERE u.email = ?
     ORDER BY l.created_at DESC"
);
$stmt_list->bind_param("s", $_SESSION['email']);
$stmt_list->execute();
$result_list = $stmt_list->get_result();
while ($row = $result_list->fetch_assoc()) 
{
    $links[] = $row;
}
$stmt_list->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.4/css/bulma.min.css">
    <style>
        body { background-color: #f5f5f5; }
        .main-container { max-width: 800px; margin: 0 auto; padding: 2rem 1rem; }
        .url-input { font-family: monospace; }
    </style>
</head>
<body>

<div class="main-container">

    <!-- Header -->
    <div class="is-flex is-justify-content-space-between is-align-items-center mb-5">
        <h1 class="title mb-0">🔗 Link Shortener</h1>
        <div class="is-flex is-align-items-center gap-3">
            <span class="mr-3">👋 <?= htmlspecialchars($_SESSION['email']) ?></span>
            <a href="logout.php" class="button is-danger is-small">Logout</a>
        </div>
    </div>

    <!-- Form accorcia link -->
    <div class="box">
        <h2 class="subtitle">Accorcia un link</h2>
        <form method="POST">
            <div class="field has-addons">
                <div class="control is-expanded">
                    <input class="input url-input" type="url" name="original_url" 
                           placeholder="https://esempio.com/url-molto-lungo..." required>
                </div>
                <div class="control">
                    <button class="button is-primary">Accorcia</button>
                </div>
            </div>
        </form>

        <?php if ($url_shortato): ?>
            <div class="notification is-success is-light mt-3 mb-0">
                ✅ <strong>Link accorciato:</strong>
                <input class="input url-input mt-2" type="text" 
                       value="<?= htmlspecialchars($url_shortato) ?>" 
                       readonly onclick="this.select()">
            </div>
        <?php endif; ?>
    </div>

    <!-- Lista link -->
    <?php if (!empty($links)): ?>
    <div class="box">
        <h2 class="subtitle">I tuoi link</h2>
        <table class="table is-fullwidth is-striped is-hoverable">
            <thead>
                <tr>
                    <th>Link originale</th>
                    <th>Link corto</th>
                    <th>Visite</th>
                    <th>Data</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($links as $link): ?>
                <tr>
                    <td style="max-width:250px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;">
                        <a href="<?= htmlspecialchars($link['original_URL']) ?>" target="_blank">
                            <?= htmlspecialchars($link['original_URL']) ?>
                        </a>
                    </td>
                    <td>
                        <a href="http://localhost/<?= htmlspecialchars($link['short_URL']) ?>" target="_blank">
                            localhost/<?= htmlspecialchars($link['short_URL']) ?>
                        </a>
                    </td>
                    <td><?= (int)$link['n_visits'] ?></td>
                    <td><?= date('d/m/Y', strtotime($link['created_at'])) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php else: ?>
    <div class="notification is-info is-light">
        Non hai ancora accorciato nessun link.
    </div>
    <?php endif; ?>

</div>

</body>
</html>
    


