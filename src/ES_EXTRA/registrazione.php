<?php
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["nome"], $_POST["colore"])) 
{
    $nome = $_POST["nome"];
    $colore = $_POST["colore"];

    if (empty($nome) || empty($colore)) 
    {
        echo "Compila tutti i campi";
    } else 
    {
        // Cookie valido per 1 ora
        setcookie("nome", $nome, time() + 3600);
        setcookie("colore", $colore, time() + 3600);
        echo "Cookie creati con successo!<br>";

        // Array utente
        $utente = [
            "nome" => $nome,
            "colore" => $colore
        ];

        // Trasformo in una stringa JSON e salvo in un cookie
        $cookie_valore = json_encode($utente);
        setcookie("utente", $cookie_valore, time() + 3600);

        // Decodifico subito la variabile JSON
        $array_nuovo = json_decode($cookie_valore, true);
        var_dump($array_nuovo);
    }
}
?>

?>

<!DOCTYPE html>
<head>
    <title>Ecco i Cookie</title>
</head>
<body>
    <form method="POST" action="">
        <label>Nome</label>
        <input type="text" name="nome" required ><br>
        <label>Colore</label>
        <input type= "text" name= "colore" required ><br>
        <button type="submit">Invia</button>
    </form>
</body>
</html>




