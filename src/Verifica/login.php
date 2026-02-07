<?php
session_start();
if($_POST && isset($_POST["username"]) && isset($_POST["username"]) )
{
    
    // Ricezione dati tramite POST
    $username= $_POST['username'];
    $password = $_POST['password'];
    if($username=="santa" && $password="xmas")
    {
        $_SESSION['auth']=true;
        header('Location: pannello.php');
    }
}
else
{
    header('Location: pannello.php');
}

?>