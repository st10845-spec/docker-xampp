
<h1>Hello world! </h1>

<?php
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
   
   echo "Connessione al database riuscita con mysqli!";

   $username="nicola";//se metto un latro utente che non esiste mi dice che il login fallisce
   $password="ciao1";

   //n_righe
   $query= "SELECT * FROM users WHERE username='$username' AND password='$password'";

   echo $query;
   echo"<br>";

   $result= $connection->query($query);
   if($result->num_rows)
   {
      echo("login effettuato con successo");
   }
   else
   {
      echo("login fallito");
   }

   //var_dump ($result);

   echo"<br>";
   $connection->close();

?>

Prova!