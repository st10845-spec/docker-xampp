<?php
    echo "richiesta POST";
    var_dump($_POST);
    if($_POST && isset ($_POST['submit']))
    {
        var_dump($_FILES);
        var_dump($_FILES['file1']);
        $contenuto=file_get_contents($_FILES['file1']['tmp_name']);
        $contenuto_decode=json_decode($contenuto,true);
        var_dump($contenuto_decode);
        foreach($contenuto_decode as $key => $value)
        {
            var_dump($key);
            var_dump($value);
        }

    }
?>


<!DOCTYPE html>
<html>
    <body>
        <form action="" method="post" enctype="multipart/form-data">
        Select image to upload:
            <br>
            //spostiamo il file in una directory non temporanea
            <input type="file" name="file2" id="file2">
            <br>
            //carichiamo e visualliziamo a video(file di testo)
            <input type="file" name="file1" id="file1">
            <br>
            <input type="submit" value="Upload Image" name="submit">
        </form>
    </body>
</html>