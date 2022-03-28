<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//    include_once("../config.php");
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
include "php/createTable.php";

$statement = $connection->query("SELECT MAX(person.id) FROM person");
$rows = $statement->fetchAll(PDO::FETCH_ASSOC);
$maxID=$rows[0]["MAX(person.id)"];

if(isset($_GET["id"])) {
    $id = intval($_GET['id']);
    $statement = $connection->query("SELECT * from person WHERE person.id=$id");
    header("Location : http://147.175.98.72/Zadanie2/php/viewPerson.php?id=$id");
}

?>
<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <title>Zadanie2</title>
    <link href="css/index.css" rel="stylesheet">
<!--    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">-->
</head>

<body>

<button id="myBtn">TOP 10</button>
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>TOP 10</h2>
                <?php
                $statement = $connection->query("SELECT person.id, person.name,person.surname,person.birth_country, COUNT(placement.placing)
                                                            FROM person,placement
                                                            where placement.placing=1 AND placement.person_id=person.id
                                                            GROUP BY placement.person_id 
                                                            ORDER BY COUNT(placement.placing) DESC, person.surname ASC
                                                            LIMIT 10");

                createTOP10($statement);
                ?>
        </div>
    </div>

<button id="myBtn2"> <a href="php/modifications/addPerson.php">Add new person</a></button>
<button id="myBtn3"> <a href="php/modifications/assignOlympics.php">Assign olympics</a></button>


    <h1>Olympijské hry</h1>
    <table id="table">
        <?php

        $statement = $connection->query("SELECT person.id, person.name, person.surname, oh.year,oh.country,oh.city,oh.type,placement.discipline 
                                                    FROM placement,person,oh where  placement.person_id=person.id 
                                                    AND placement.oh_id=oh.id AND placement.placing=1");
        createMainTable($statement);
        ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script  src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.js"></script>
    <script src="js/custom.js"></script>
</body>
</html>