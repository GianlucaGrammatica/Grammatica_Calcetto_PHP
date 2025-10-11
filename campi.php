<?php
require_once "Database.php"; // Link alla classe

$title = $_GET['id_campo']; // Prendere il parametro dall'array super globale di get

// Connessione al database
$pdo = Database::getInstance()->getConnection();

// si usa statement perchè serve una query con parametro
$stmt = $pdo->prepare("SELECT * FROM campi WHERE nome_campo = :nome_campo");
$stmt->bindParam(':nome_campo', $title);
$stmt->execute();
$campo = $stmt->fetch();

$utenti = $pdo->query("SELECT * FROM utenti");

//$stmt = $pdo->prepare("SELECT * FROM prenotazioni WHERE id_campo = :id_campo");
$stmt = $pdo->prepare("SELECT prenotazioni.*, utenti.username FROM prenotazioni 
                                INNER JOIN utenti ON prenotazioni.id_utente = utenti.id
                                WHERE id_campo = :id_campo ORDER BY prenotazioni.data_prenotazione ASC");

$stmt->execute(["id_campo" => $title]);
$prenotazioni = $stmt->fetchAll();

if (!empty($_POST)) {
    $stmt = $pdo->prepare("INSERT INTO prenotazioni (id_campo, id_utente, data_prenotazione) VALUES(:id_campo, :id_utente, :data)");

    try {
        $stmt->execute([
                ':id_campo' => $_POST['id_campo'],
                ':id_utente' => $_POST['id_utente'],
                ':data' => $_POST['data']
        ]);

        header("location: index.php"); // Rederict
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
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
<nav>
    <strong>
        <a href="index.php"><- back</a>
    </strong>
</nav>

<h1><?= $title ?></h1>
<hr>
<br>
<div class="contenitore">
    <div class="contenitore_campo">
        <h2><?= $campo['nome_campo'] ?></h2>
        <h4>Capienza: <?= $campo['capienza'] ?></h4>
        <div class="box_image">
            <img src="<?= $campo['foto_url'] ?>" alt="">
        </div>
    </div>

    <div class="contenitore_campo">
        <form action="" method="post">
            <div class="contenitore_form_input">
                <h1>Form Prenotazione</h1>
                <hr class="hr1">
                <br>

                <input type="hidden" name="id_campo" value="<?= $campo['nome_campo'] ?>">

                <div>
                    <strong>
                        <label for="id_utente">Utente: </label>
                        <?php foreach ($utenti as $row) { ?>

                            <input type="radio" name="id_utente" id="id_utente" value="<?= $row['id'] ?>" required>
                            <label for="id_utente"><?= $row['username'] ?></label>
                        <?php } ?>
                    </strong>
                </div>

                <br>
                <hr class="hr2">
                <br>

                <div>
                    <label>
                        <input type="date" name="data" required>
                    </label>
                    <input type="submit" value="Torna Indietro">
                </div>

                <br>
                <hr class="hr2">
                <h2>Prenotazioni Attuali:</h2>
                <ul>
                    <?php foreach ($prenotazioni as $row) { ?>
                        <li><strong><?= $row['username'] ?> - <?= $row['data_prenotazione'] ?></strong></li>
                    <?php } ?>
                </ul>


            </div>
        </form>
    </div>
</div>
</body>
</html>
