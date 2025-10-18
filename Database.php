<?php
require __DIR__ . '/vendor/autoload.php';
/*
*   Questa classe serve come wrapper di pdo
 * Serve per evitare la creazione di più istanze di pdo per evitare un possibile attacco che satura il database creando infinite connessioni
*/

/*
 * Il costruttore è privato
 * Creiamo una funzione static che controlli se esiste già un'istanza della classe
 */

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/config');
$dotenv->load();
$dotenv->required(['DBUSER', 'DBNAME', 'DBHOST'])->notEmpty();

class Database
{

    private static $instance = null;

    private $pdo;

    private function __construct()
    {
        $this->pdo = new PDO("mysql:host=" . $_ENV["DBHOST"] . ";dbname=" . $_ENV["DBNAME"], $_ENV["DBUSER"], $_ENV["DBPASSWORD"],

            // Per recuperare l'array dei risultati in automatico
            [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]
        );
    }

    public static function getInstance()
    {
        // Dentro le funzioni statiche si usa self al posto di this
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection()
    {
        // Istanza della connessione
        return $this->pdo;
    }

}