<?php
    require_once "Database.php"; // Link alla classe

    $title = $_GET['id_campo']; // Prendere il parametro dall'array super globale di get

    // Connessione al database
    $pdo = Database::getInstance()->getConnection();

    // si usa statement perchè serve una query con parametro
    $stmt = $pdo->prepare("SELECT * FROM campi WHERE nome_campo = :nome_campo");
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
</head>
<body>
<h1><?= $title ?></h1>
</body>
</html>
