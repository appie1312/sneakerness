<?php
class Database {
    private $host = "localhost";
    private $user = "root";       // of jouw mysql-gebruiker
    private $pass = "";           // je wachtwoord (vaak leeg op XAMPP)
    private $dbname = "sneakerness"; // de database die je met createscript.sql hebt aangemaakt

    private $dbh;  // database handler (PDO)
    private $stmt;

    public function __construct() {
        $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->dbname . ";charset=utf8";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];
        $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
    }

    public function getConnection() {
        return $this->dbh;
    }
}