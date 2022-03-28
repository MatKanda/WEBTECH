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
include "createTable.php";
$id = intval($_GET['id']);

$statementHeader = $connection->query("SELECT * from person WHERE person.id=$id");
$statementOlympics = $connection->query("SELECT oh.type, oh.year, placement.placing, placement.discipline FROM 
                                                    oh,placement,person WHERE placement.person_id=person.id AND person.id=$id 
                                                    AND placement.oh_id=oh.id ORDER BY oh.year DESC");
?>

<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <title>Zadanie2</title>
    <link href="../css/person.css" rel="stylesheet">
    <!--    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">-->
</head>

<body>
    <?php
    createPersonalTableHeader($statementHeader);
    createPersonalTableOlympics($statementOlympics);
    ?>
    <button class="buttonEdit"><a href="http://147.175.98.72/Zadanie2/php/modifications/editPerson.php?id=<?php echo $id?>">Edit person</a></button>
    <button><a href="../index.php">Go Back</a></button>
</body>
</html>
