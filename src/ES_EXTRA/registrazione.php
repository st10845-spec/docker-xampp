//Ogni nuovo utente deve poter creare un account inserendo un indirizzo email e una password. 
La password deve essere conservata in modo sicuro, così che non sia possibile leggerla direttamente dall’archivio degli utenti.
L’applicazione deve verificare che l’email non sia già stata registrata e fornire un messaggio chiaro in caso di errore.<

<?php 

?>

<!DOCTYPE html>
<html lang="it">
<head>
    <title>Registrazione</title>
</head>
<body>
    <label class="label">Email</label>
    <div class="control">
        <input class="email" name="email" required>
    </div>
    </div>

    <div class="field">
        <label class="label">Password</label>
        <div class="control">
            <input class="input" type="password" name="password" required>
        </div>
    </div>
</body>
<html>


