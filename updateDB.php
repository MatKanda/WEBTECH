<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include  "getConnection.php";
$connection=(new Database())->getConnection();
if(isset($_POST["start"])){
    $connection->query('SET foreign_key_checks = 0');
    $PDOStatement = $connection->prepare("TRUNCATE TABLE results");
    $PDOStatement->execute();
    $connection->query('SET foreign_key_checks = 1');
    $sql = "INSERT INTO results (sin, cos, sin_cos, lambda) VALUES (?,?,?,?)";
    $stmt= $connection->prepare($sql);
    $stmt->execute([1, 1, 1,1]);
}
if(isset($_POST["func"])){
    $stm = $connection->query("SELECT * FROM results");
    $results = $stm->fetchAll();
    $sin=$results[0]["sin"];
    $cos=$results[0]["cos"];
    $sin_cos=$results[0]["sin_cos"];

    if($_POST["func"]=="sin"){
        $sql = "UPDATE results SET sin=?";

        if($sin==1){
            $connection->prepare($sql)->execute([0]);
        }
        else {
            $connection->prepare($sql)->execute([1]);
        }
    }
    elseif($_POST["func"]=="cos"){
        $sql = "UPDATE results SET cos=?";
        if($cos==1){
            $connection->prepare($sql)->execute([0]);
        }
        else{
            $connection->prepare($sql)->execute([1]);
        }
    }
    elseif($_POST["func"]=="sin_cos"){
        $sql = "UPDATE results SET sin_cos=?";
        if($sin_cos==1) {
            $connection->prepare($sql)->execute([0]);
        }
        else {
            $connection->prepare($sql)->execute([1]);
        }
    }
    elseif($_POST["func"]=="lambda"){
        echo $_POST["lambdaValue"];
        $sql = "UPDATE results SET lambda=?";
        $connection->prepare($sql)->execute([$_POST["lambdaValue"]]);
    }
}
