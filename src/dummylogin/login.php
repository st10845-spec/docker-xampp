
<?php 

 
   $usernameForm=htmlspecialchars($_POST["nome"]);//se metto un altro utente che non esiste mi dice che il login fallisce
   $passwordForm=htmlspecialchars($_POST["password"]);

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
   //andare a capo
   echo"<br>";

   // evita l'sql injection
   $state=$connection->prepare( "SELECT * FROM users WHERE username=? AND password =?"); // mi serve quando le query sono parametriche 
   $state->bind_param("ss", $usernameForm, $passwordForm);

   $state->execute();

   $result=$state->get_result();

   if($result->num_rows)
   {
      echo("login effettuato con successo");
      if($usernameForm=="sofia")//quello scelto  come amministratore 
      {
         $query="SELECT * FROM users";
         $result=$connection->query($query);
         echo"la tabella user contiene le seguenti righe:$result->num_rows<br>";
         var_dump($result);

         echo"<table border='1'>";
         echo"<tr><th>username</th><th>password</th></tr>";
         echo "</tr";

         /*$result1=$result->fetch_assoc();
         var_dump($result1);
         $result2=$result->fetch_assoc();
         var_dump($result2);*/

         while($rows=$result->fetch_assoc)
         {
            echo "<tr>";
            echo "<td>"$row['usernameForm']."</td>;
            echo "<td>"$row['$passwordForm']."</td>;
            echo "</tr>";
         
         }
         echo "</table>"
      }
   }
   else
   {
      echo("login fallito");
   }
   //infine stampa una tabella con gli username e le password degli singoli utenti sui database
   //accedendo con sofia
   echo"<br>";
   $connection->close();

?>

