<?php
session_start();
if (!isset($_SESSION['username'])) 
{
    header("Location: login.php");
    exit;
}

$connection = new mysqli("db", "user", "user", "ChatRoom", 3306);
$result = $connection->query("SELECT * FROM chatrooms");
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Chat</title>
    <style> 
        /* Reset base */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body 
        {
            background-color: #f4f7f9;
            color: #333;
            padding: 20px;
        }

        h2 
        {
            margin-bottom: 10px;
            color: #2c3e50;
        }

        h3 {
            margin: 20px 0 10px;
            color: #34495e;
        }

        a {
            text-decoration: none;
            color: #2980b9;
            transition: color 0.2s;
        }

        a:hover {
            color: #1c5980;
        }

        ul 
        {
            list-style: none;
            margin-top: 10px;
        }

        li 
        {
            background-color: #fff;
            padding: 12px 15px;
            margin-bottom: 8px;
            border-radius: 6px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            transition: transform 0.1s, box-shadow 0.1s;
        }

        li:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        form 
        {
            margin-bottom: 20px;
            display: flex;
            gap: 10px;
        }

        input[type="text"] 
        {
            flex: 1;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            outline: none;
            transition: border-color 0.2s;
        }

        input[type="text"]:focus {
            border-color: #2980b9;
        }

        button 
        {
            padding: 10px 20px;
            border: none;
            background-color: #2980b9;
            color: white;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        button:hover 
        {
            background-color: #1c5980;
        }

        .logout 
        {
            display: inline-block;
            margin-top: 30px;
            color: #e74c3c;
            font-weight: bold;
        }

        .logout:hover 
        {
            color: #c0392b;
        }

        .container 
        {
            max-width: 600px;
            margin: auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 6px 15px rgba(0,0,0,0.05);
            width: 100%;
        }

        body 
        {
            min-height: 100vh;
            background-color: #f4f7f9;
            color: #333;
            display: flex;
            justify-content: center;/* centro orizzontale */
            align-items: center;     /* centro verticale */
        }

    </style>
</head>
<body>
    <div class="container">
        <h2>Ciao <?php echo htmlspecialchars($_SESSION['username']); ?> 👋</h2>

        <h3>Chatroom disponibili:</h3>
        <ul>
            <?php while ($row = $result->fetch_assoc()): ?>
            <li>
                <a href="chat.php?id=<?php echo $row['id']; ?>">
                    <?php echo htmlspecialchars($row['name']); ?>
                </a>
            </li>
            <?php endwhile; ?>
        </ul>

        <h3>Crea nuova chatroom</h3>

        <form method="POST" action="crea_chatroom.php">
            <input type="text" name="nome" placeholder="Nome chatroom" required>
            <button type="submit" name="azione" value="crea">Crea</button>
            <button type="submit" name="azione" value="elimina">Elimina</button>
        </form>
        <a class="logout" href="logout.php">Logout</a>
    </div>
</body>
</html>

                                                            
