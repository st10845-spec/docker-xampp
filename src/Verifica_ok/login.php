
<?php
var_dump($_POST);

$connection = new mysqli("db", "user", "user", "Sfilata", 3306);

if ($connection->connect_error) 
{
    die("Errore DB");
}

$username_admin="admin";
$password_admin="admin";

if($_POST && isset($_POST['username'])&& isset($_POST['password']))
{
    $username=$_POST['username'];
    $password=$_POST['password'];

    if($username==$username_admin && $password==$password_admin)
    {
        session_start();
        $_SESSION['admin'] = true;
        header("Location: dashboard.php");

    }
    else
    {
        $sql=("SELECT * FROM abitante WHERE CF=? AND data=?");
        $stmt=$connection->prepare($sql);
        $stmt->bind_param("ss",$username,$password);
        $result=$stmt->execute();
        if($result->num_rows==1)
        {
            $row=$result->fetch_assoc();
            session_start();
            $_SESSION['username']=$row['CF'];
            header("Location: dashboard.php");
        }
    }
}

?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <form method="POST">
        <h1 class="title has-text-centered">Link Shorter</h1>
        <h2 class="subtitle has-text-centered">Login</h2>

        <div class="field">
            <label class="label">Username</label>
            <div class="control">
                <input class="input" name="username" required>
            </div>
        </div>

        <div class="field">
            <label class="label">Password</label>
            <div class="control">
                <input class="input" type="password" name="password" required>
            </div>
        </div>

        <div class="field">
            <button class="button is-primary is-fullwidth">
                Accedi
            </button>
        </div>
    </form>
    </div>

</body>
</html>

