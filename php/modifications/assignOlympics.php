<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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

$statementOH = $connection->query("SELECT oh.id, oh.type, oh.year, oh.city, oh.country FROM oh");
$rowsOH = $statementOH->fetchAll(PDO::FETCH_ASSOC);

$statementPerson = $connection->query("SELECT person.id, person.name, person.surname FROM person");
$rowsPerson = $statementPerson->fetchAll(PDO::FETCH_ASSOC);

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sql = "INSERT INTO placement (person_id,oh_id,placing,discipline) VALUES (?,?,?,?)";
    $stmt = $connection->prepare($sql);
    $stmt->execute([$_POST["person"], $_POST["OH"], $_POST["placing"], $_POST["discipline"]]);

}
?>
<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <title>Zadanie2</title>
    <link href="../../css/editPerson.css" rel="stylesheet">
</head>

<body>
<h1>Assign olympics to a person</h1>
<form action="assignOlympics.php" method="post" enctype="multipart/form-data">
    <div class="inputs">
    <label for="OH">Olympics</label><br>
        <select name="OH" id="OH">
            <?php
            foreach ($rowsOH as $row) {
                echo $row["id"].$row["year"];
                echo '<option value="'.$row["id"].'"  >'.$row["type"]."     ".$row["year"]."     ".$row["city"]."     ".$row["country"].'</option>';
            }
            ?>
        </select><br>
        <label for="person">Person</label><br>
        <select name="person" id="person">
            <?php
            foreach ($rowsPerson as $row) {
                echo $row["id"].$row["year"];
                echo '<option value="'.$row["id"].'"  >'.$row["name"]."     ".$row["surname"].'</option>';
            }
            ?>
        </select>
    <br><label for="placing">Placing</label>
        <br><input class="form__field"  required id="placing" name="placing" type="number" min="1">
        <br> <label for="discipline">Discipline</label>
        <br><input class="form__field"  required id="discipline" name="discipline" >

        <br><input class="submit" type="submit" value="Submit">
    </div>
</form>
<button class="goBack"><a href="../../index.php">Go Back</a></button>

</body>
</html>


