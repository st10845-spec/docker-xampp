<?php
session_start();
if(isset($_SESSION['auth']) && $_SESSION['auth'])
{

    //inserimento nome giocattolo e nome elfo
    echo '<section>';
    echo '<form name="Giocattoli_POST action="produzioneGiocattoli.php" method="POST">';

    echo'<label for="nomeGiocattolo">Nome Giocattolo </label>';
    echo'<input type="text"id="nomeGiocattolo" name="nomeGiocattolo">';
    echo '<br>';

    echo'<label for="nomeElfo">Nome Elfo</label>';
    echo'<input type="text"id="nomeElfo" name="nomeElfo">';
    echo '<br>';

    echo'<button type="submit">Inserisci</button>';

    echo'</form>';
    echo'</section>';

    //visualizzazione tabella giocattolo
    echo '<section>';
    echo '<a href="produzioneElfi.php">Visualizza i giocattoli in produzione</a>';
    echo '<br>';
    echo'</section>';
}
?>