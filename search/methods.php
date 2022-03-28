<?php

function getNameByDate($connection){
    $stm= $connection->prepare("SELECT SK,CZ,HU,PL,AT FROM record WHERE den=:date");
    $stm->bindParam(":date",$_GET["date"]);

    $stm->execute();
    $result=$stm->fetch(PDO::FETCH_ASSOC);
    echo json_encode($result);
//    var_dump($result);
}

function getDateByNameState($connection){
    if(isset($_GET["state"])){
        if($_GET["state"]=="SK")
            $state=$_GET["state"];
        elseif($_GET["state"]=="CZ")
            $state="CZ";
        elseif($_GET["state"]=="AT")
            $state="AT";
        elseif($_GET["state"]=="HU")
            $state="HU";
        elseif($_GET["state"]=="PL")
            $state="PL";

        $stm= $connection->prepare("SELECT $state,den FROM record");
        $stm->execute();
        $results=$stm->fetchAll(PDO::FETCH_ASSOC);
        $name=$_GET["name"];

        foreach ($results as $result){
            if($result[$state]==$name){
                echo json_encode($result);
            }

        }
    }

}
