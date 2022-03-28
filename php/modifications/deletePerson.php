<?php
$servername = "localhost";
$username = "xkanda";
$password = "XS9vNlM$#HcBq2";


try {
    $connection = new PDO("mysql:host=$servername;dbname=zadanie2", $username, $password);
    // set the PDO error mode to exception
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//    echo "Connected successfully";
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

$id = intval($_GET['id']);
//echo "som tu $id";
$sql = "DELETE FROM person WHERE id=$id";

// use exec() because no results are returned
try{
    $connection->exec($sql);
    header("Location:http://147.175.98.72/Zadanie2/");
} catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}
