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

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    try{
        $sql=$connection->prepare("SELECT name, surname FROM person WHERE name=? AND surname=?");
        $sql->execute([$_POST["name"], $_POST["surname"]]);
        $count = $sql->rowCount();
        if($count==0){
            $sql = "INSERT INTO person (name, surname, birth_day, birth_place, birth_country, death_day, death_place, death_country)
        VALUES (?,?,?,?,?,?,?,?)";
            $stmt = $connection->prepare($sql);
            $stmt->execute([$_POST["name"], $_POST["surname"], $_POST["birthDay"], $_POST["birthPlace"], $_POST["birthCountry"], $_POST["deathDay"], $_POST["deathPlace"], $_POST["deathCountry"]]);
        }else
            echo "<script type='text/javascript'>alert('You cannot add already existing person');</script>";
    }catch (Exception $e){
        echo $e->getMessage();
    }
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
    <h1>Add a new person</h1>
<form action="addPerson.php" method="post" enctype="multipart/form-data">
    <div class="inputs">
        <br> <label for="name">Name</label>
        <br><input class="form__field"  required id="name" name="name">
        <br><label for="surname">Surname</label>
        <br><input class="form__field"  required id="surname" name="surname" >
        <br> <label for="birthDay">Birth day</label>
        <br><input type="date" class="form__field"  required id="birthDay" name="birthDay">
        <br> <label for="birthPlace">Birth place</label>
        <br><input class="form__field"  required id="birthPlace" name="birthPlace">
        <br> <label for="birthCountry">Birth country</label>
        <br><input class="form__field"  required id="birthCountry" name="birthCountry">
        <br><label for="deathDay">Death day</label>
        <br><input class="form__field" id="deathDay" type="date" name="deathDay" >
        <br> <label for="deathPlace">Death place</label>
        <br><input class="form__field" id="deathPlace" name="deathPlace">
        <br><label for="deathCountry">Death country</label>
        <br><input class="form__field" id="deathCountry" name="deathCountry" >
        <br><input class="submit" type="submit" value="Submit">
    </div>
</form>
<button class="goBack"><a href="../../index.php">Go Back</a></button>

</body>
</html>

