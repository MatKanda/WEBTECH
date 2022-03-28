<?php
define("SERVERNAME","localhost");
define("USERNAME","xkanda");
define("PASSWORD","XS9vNlM$#HcBq2");
class Database{
    public $connection=null;
    public function getConnection()
    {
        try {
            $connection = new PDO("mysql:host=".SERVERNAME. ";dbname=zadanie3", USERNAME, PASSWORD);
            // set the PDO error mode to exception
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $connection;
        } catch
        (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
}