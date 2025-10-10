<?php

class Database
{
    private static $instance = null;

    private $pdo;

    private function __construct(){
       $this->pdo = new PDO("mysql:host=localhost;dbname=grammatica_calcetto_php", "root", "");
    }

    public static function getInstance(){
        if(self::$instance === null){
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection(){
        return $this->pdo;
    }
}