<?php
require_once "Database.php";

$title = "Basta Calcetto";

$pdo = Database::getInstance()->getConnection();

$result = $pdo->query("SELECT * FROM campi ORDER BY capienza DESC");
var_dump($result);
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

    <hr>
    <br>
    <div class="contenitore">

        <div class="contenitore_campo">
            <h3>Nome campo: </h3>
            <div class="box_image">
                <a href="campo.php">
                    <img src="https://lrvicenza.net/wp-content/uploads/2022/06/Stadio-Romeo-Menti-1024x356.jpg" alt="">
                </a>
            </div>
        </div>

    </div>

</body>
</html>