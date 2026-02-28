<?php
$connection = new mysqli("db", "user", "user", "LinkShortner", 3306);

if (isset($_GET['code'])) {

    $code = $_GET['code'];

    $stmt = $connection->prepare( "SELECT original_URL FROM Links WHERE short_URL = ?");
    $stmt->bind_param("s", $code);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) 
    {
        $row = $result->fetch_assoc();

        $connection->query("UPDATE Links SET n_visits = n_visits + 1 WHERE short_URL = '$code'");

        header("Location: " . $row['original_URL']);
        exit;
    }
}
?>