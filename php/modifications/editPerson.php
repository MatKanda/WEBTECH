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

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $date = $_POST["deathDay"];
    if ($date != "") {
        $myDateTime = DateTime::createFromFormat('Y-m-d', $_POST["deathDay"]);
        $date = $myDateTime->format('d.m.Y');
    }

    $sql = "UPDATE person SET name=?, surname=?, death_day=? ,death_place=? ,death_country=? WHERE id=?";
    $connection->prepare($sql)->execute([$_POST["name"], $_POST["surname"], $date, $_POST["deathPlace"], $_POST["deathCountry"], $_POST["id"]]);
    header("Location:http://147.175.98.72/Zadanie2/");
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
    <h1>Editing person with id: <?php echo $id?></h1>
    <form action="editPerson.php" method="post" enctype="multipart/form-data">
        <div class="inputs">
        <input name="id" style="display: none" value=<?php echo $id?>>
            <br> <label for="name">Name</label>
            <br><input class="form__field"  required id="name" name="name" value="<?php echo $connection->query("SELECT person.name from person WHERE person.id=$id")->fetchAll(PDO::FETCH_ASSOC)[0]["name"];?>">
            <br><label for="surname">Surname</label>
        <br><input class="form__field"  required id="surname" name="surname" value="<?php echo $connection->query("SELECT person.surname from person WHERE person.id=$id")->fetchAll(PDO::FETCH_ASSOC)[0]["surname"];?>">
<!--        <label for="medals">Medals</label>-->
<!--        <input class="form__field" id="medals" name="medals" value="--><?php //echo $connection->query("SELECT placement.person_id, COUNT(placement.placing) FROM placement where placement.placing<=3 AND placement.person_id=10 GROUP BY placement.person_id")->fetchAll(PDO::FETCH_ASSOC)[0]["COUNT(placement.placing)"]?><!--">-->
            <br><label for="deathDay">Death day</label>
            <br><input class="form__field" id="deathDay" type="date" name="deathDay" value="<?php echo $connection->query("SELECT person.death_day from person WHERE person.id=$id")->fetchAll(PDO::FETCH_ASSOC)[0]["death_day"];?>">
            <br> <label for="deathPlace">Death place</label>
            <br><input class="form__field" id="deathPlace" name="deathPlace" value="<?php echo $connection->query("SELECT person.death_place from person WHERE person.id=$id")->fetchAll(PDO::FETCH_ASSOC)[0]["death_place"];?>">
            <br><label for="deathCountry">Death country</label>
            <br><input class="form__field" id="deathCountry" name="deathCountry" value="<?php echo $connection->query("SELECT person.death_country from person WHERE person.id=$id")->fetchAll(PDO::FETCH_ASSOC)[0]["death_country"];?>">
            <br><input class="submit" type="submit" value="Submit">
        </div>
    </form>
    <button class="goBack"><a href="../../index.php">Go Back</a></button>

</body>
</html>

