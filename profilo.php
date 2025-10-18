<?php
require_once "Database.php"; // Link alla classe
session_start();

$title = "Profilo";

// Connessione al database
$pdo = Database::getInstance()->getConnection();

if (!empty($_POST)) {

    if (isset($_POST["Logout"]) && $_POST["Logout"] == 1) {
        session_destroy();
        header("Location: login.php");
        exit;
    }

    $delete = $pdo->prepare("DELETE FROM prenotazioni WHERE id_campo = :id_campo AND id_utente = :id_utente AND data_prenotazione = :data_prenotazione");
    $delete->execute([
            ':id_campo' => $_POST['id_campo'],
            ':id_utente' => $_POST['id_utente'],
            ':data_prenotazione' => $_POST['data_prenotazione']
    ]);


    header("location: profilo.php");

    var_dump($delete);
}

//$stmt = $pdo->prepare("SELECT prenotazioni.*, utenti.username FROM prenotazioni INNER JOIN utenti ON prenotazioni.id_utente = utenti.id ORDER BY id_utente DESC");
$stmt = $pdo->prepare("SELECT prenotazioni.*, utenti.username FROM prenotazioni INNER JOIN utenti ON prenotazioni.id_utente = utenti.id WHERE utenti.username = :username ORDER BY id_utente DESC");
$stmt->execute(['username' => $_SESSION['username']]);
$prenotazioni = $stmt->fetchAll();

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
<div class="profilo_upper_con">
    <h2>Benvenuto <?= $_SESSION['username'] ?></h2>
    <form action="" method="post">
        <input type="hidden" name="Logout" value="1">
        <input type="submit" value="LogOut">
    </form>
</div>
<br>
<hr>
<br><br>
<?php // For per mostrare i risultati
foreach ($prenotazioni as $row) {
    ?>
    <div class="prenotazioni_profilo_con">
        <div class="prenotazioni_profilo">
            <div>
                <a href="campi.php?id_campo=<?= $row['id_campo'] ?>">
                    <?= $row['username'] ?> - <?= $row['id_campo'] ?> - <?= $row['data_prenotazione'] ?>
                </a>
            </div>

            <div>
                <form action="" method="post">
                    <input type="hidden" name="data_prenotazione" value="<?= $row['data_prenotazione'] ?>">
                    <input type="hidden" name="id_campo" value="<?= $row['id_campo'] ?>">
                    <input type="hidden" name="id_utente" value="<?= $row['id_utente'] ?>">
                    <input type="submit" value="DELETE">
                </form>

            </div>

        </div>
        <hr>
        <br>
    </div>

    <?php
}
?>
</body>
</html>
