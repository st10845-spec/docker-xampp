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
    $nomeGiocattolo=$_POST['nomeGiocattolo'];
    $nomeElfo=$_POST['nomeElfo'];

    $query="INSERT INTO 'giocattoli'('nomeGiocattolo','nomeElfo') VALUES('$nomeGiocattolo','$nomeElfo')";

    $result=$connection->query($query);
    if($connection->affected_rows>0)
    {
        echo "Giocattolo inserito con successo";
    }
    echo'<a href="pannello.php">Ritorna alla dashboard </a>';
}
?>