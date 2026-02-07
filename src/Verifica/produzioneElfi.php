<?php
session_start();
if(isset($_SESSION['auth']) && $_SESSION['auth']&& $_POST['nomeGiocattolo'] && $_POST['nomeElfo'])
{
    $host = 'db'; 
    $dbname = 'root_db'; 
    $user = 'user';
    $password = 'user';
    $port = 3306;
    
    $connection = new mysqli($host, $user, $password, $dbname, $port);
   
    if ($connection->connect_error) 
    {
        //in caso di errore di connessione gli dice di interrompere l'esecuzione
        die("Errore di connessione: " . $connection->connect_error);
    }
    // la query raggruppa per il nomegiocattolo e conta il numero di righe corrispondenti
    $query="SELECT nomeGiocattolo, COUNT(*) AS numeroUniita FROM 'giocattoli'GROUP BY nomeGiocattolo";
    $result=$connection->query($query);

    if($result->num_rows>0)
    {
        while($result->fetch_assoc())
        {
            echo $result['nomeGiocattolo'] . ' - ' . $result['numeroUniita'] . '<br>';
        }
    }
    echo'<br>'
    echo'<a href="produzioneGiocattoli.php">Inserisci un nuovo giocattolo</a>';
    echo'<a href="pannello.php">Ritorna alla dashboard </a>';
}
?>
