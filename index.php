<?php
require_once "Database.php"; // Link alla classe

$title = "Basta Calcetto";

// Connessione al database
$pdo = Database::getInstance()->getConnection();

$result = $pdo->query("SELECT * FROM campi ORDER BY capienza DESC");

/* Var dump brutto
$stmt = $pdo->prepare("SELECT * FROM campi ORDER BY capienza DESC");
$stmt->execute();
$result = $stmt->fetchAll();
var_dump($result);
*/

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
        <?php // For per mostrare i risultati
        foreach($result as $row){
        ?>
        <div class="contenitore_campo">
            <h2><?= $row['nome_campo'] ?></h2>
            <h4>Capienza: <?= $row['capienza']
                /*
                 * Bisogna aggiornare la capienza
                 * Per farlo si può fare dai data suorce dell'ide e aprire la visualizzazione della tabella campi
                 * Da qui si possono aggiornare i valori e aggiornare premendo la freccetta verde in alto
                 */
                ?></h4>
            <div class="box_image">
                <a href="campi.php?id_campo=<?= $row['nome_campo'] // Inserire la get ?>">
                    <img src="<?= $row['foto_url']?>" alt="">
                </a>
            </div>
        </div>
        <?php
        }
        ?>
    </div>

</body>
</html>