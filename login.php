<?php
require_once "Database.php"; // Link alla classe
session_start();

$errore = "";

if (!empty($_POST)) {
    $pdo = Database::getInstance()->getConnection();
    $stmt = $pdo->prepare("SELECT * FROM utenti WHERE username = :username");
    $stmt->execute([":username" => $_POST['username']]);
    $utente = $stmt->fetch();

    if ($utente && password_verify($_POST['password'], $utente['password'])) {
        $_SESSION['username'] = $utente['username'];
        header('Location: index.php');
        exit;
    } else {
        $errore = "Credenziali non valide";
    }
}

$title = "Login";

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="https://pngimg.com/uploads/football/football_PNG52760.png">
</head>
<body>

<?php
require_once "navigation.php";
?>

<h1><?= $title ?></h1>
<div>
    <form action="" method="post">
        <div>
            <labbel for="username">Username</labbel>
            <input type="text" name="username" required>
        </div>

        <div>
            <labbel for="password">Password</labbel>
            <input type="password" name="password" required>
        </div>

        <input type="submit" value="Login">
        <?
        if ($errore != "") {
            ?>
            <?= $errore ?>
        <? }
        ?>
    </form>
</div>
</body>
</html>