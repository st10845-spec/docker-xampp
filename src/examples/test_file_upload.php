<?php
    echo "richiesta POST";
    var_dump($_POST);
    if($_POST && isset ($_POST['submit'])&& isset($_FILES)&& isset($_FILES['file1']) )
    {
        var_dump($_FILES);
        if(isset($_FILES['file1']))
        {
            var_dump($_FILES['file1']);

            $path=$_FILES['file1']['tmp_name'];
            if(file_exists($path))//vede se nel percorso c'è qualcosa
            {
                //$FILES è UNarray associativo multi-dimensionale,1 livello-> nome file    2 livello->dati relativi a ogni file
                $contenuto=file_get_contents();//per accedere a un file in php
                $contenuto_decode=json_decode($contenuto,true); //json_decode ha un secondo parametro(true,false)->ritorna array associativo,ritorna un oggetto
                var_dump($contenuto_decode);
    
                foreach($contenuto_decode as $key => $value)
                {
                    var_dump($key);
                    var_dump($value);
                    //inserisco la tuple(la singola riga->ogni value) appena letta dentro al database
    
                }
            }
            else
                echo'file1 non trovato';
        }

    //il file caricato dall'utente puo essere salvato nel database-> con il tipo BLOB
    //nel codice i file vengono salvati in una directory temporanea(dopo viene cancellata)
    //ci serve una funzione che prenda il percorso temporaneo del file e lo mette in una directory scelta da me(in maniera automatica)

    if(isset($_FILES['file2']))
    {
        var_dump($_FILES['file2']);
        $path=$_FILES['file2']['tmp_name'];
        if(file_exists($path))
        {
            move_uploaded_file($path,"./$_FILES['file2']['name']");//da finire 
            //anche qui potremmo decidere di mettere il file nel db  
        }
    }
    else
        echo 'file2 non trovato';

    }
   
?>


<!DOCTYPE html>
<html>
    <body>
        <form action="" method="post" enctype="multipart/form-data">
        Select image to upload:
            <br>

            //carichiamo e visualliziamo a video(file di testo)
            <input type="file" name="file1" id="file1">
            <br>
            //spostiamo il file in una directory non temporanea
            <input type="file" name="file2" id="file2">

            <input type="submit" value="Upload Image" name="submit">
        </form>
    </body>
</html>