<?php
define("SERVERNAME","localhost");
define("USERNAME","xkanda");
define("PASSWORD","XS9vNlM$#HcBq2");

require_once "getConnection.php";
$connection=(new Database())->getConnection();

class Database{
    public $connection=null;
    public function getConnection()
    {
        try {
            $connection = new PDO("mysql:host=".SERVERNAME. ";dbname=zadanie4", USERNAME, PASSWORD);
            // set the PDO error mode to exception
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $connection;
        } catch
        (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
}
