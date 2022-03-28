<?php
include "codeToCountry.php";
function getLoginsByState($connection,$state){
    $stm = $connection->prepare("SELECT number FROM logins WHERE state=?");
    $stm->execute([$state]);
    $results=$stm->fetchAll();
    $count=0;
    for ($i=0;$i<sizeof($results);$i++){
        $count=$count+$results[$i]["number"];
    }
    return $count;
}

function createTableBody($connection,$ip,$state,$city){
    //mam uz ip v db?
    $stm = $connection->prepare("SELECT * FROM logins WHERE ip=?");
    $stm->execute([$ip]);
    $result_ip=$stm->fetch();
    $is_in_db=$stm->rowCount();

    //0 znamena nie je v db tak pridam
    if($is_in_db==0){
        $stm = $connection->prepare("INSERT INTO logins (ip,state,date,number,city) VALUES(?,?,?,?,?)");
        $stm->execute([$ip, $state,date("d.m.Y"),1,$city]);
    }
    else{      //je v db, musim skontrolovat datum či je starši ako jeden den, ak je tak inc pocet loginov, ak nie tak nemenim
        if(date("d.m.Y")!=$result_ip["date"]){
            $number=$result_ip["number"];
            $stm= $connection->prepare("UPDATE logins SET date=?,number=? WHERE ip=?");
            $number++;
            $stm->execute([date("d.m.Y"),$number,$ip]);
        }
    }

    $stm = $connection->prepare("SELECT DISTINCT state FROM logins");
    $stm->execute([]);
    $results=$stm->fetchAll();
    echo "<tbody>";
    foreach ($results as $result){
        $img=strtolower(code_to_country($result["state"]));
        $img=$img.".png";
        echo "<tr>";
             echo "<td class='startModal'>".$result["state"]."</td>";
             echo "<td> <img src='https://ipdata.co/flags/$img'/ alt='country'> </td>";
             echo "<td>".getLoginsByState($connection,$result["state"])."</td>";
        echo "</tr>";
    }
}

function loadVisitor($connection,$ip,$page_number){
    $stm = $connection->prepare("SELECT * FROM visitors WHERE ip=?");
    $stm->execute([$ip]);
    $results=$stm->fetchAll();
//    $count=$stm->rowCount();

    date_default_timezone_set('Europe/Bratislava');
    $currentTime=date("H:i:s");
//    if($count==0){
        $stm = $connection->prepare("INSERT INTO visitors (ip,time,page_number,count) VALUES(?,?,?,?)");
        $stm->execute([$ip,$currentTime, $page_number,1]);
//    }else{
//        $number=$results[0]["count"];
//        $stm= $connection->prepare("UPDATE visitors SET count=? WHERE ip=?");
//        $number++;
//        $stm->execute([$number,$ip]);
//    }
}

function getAllTimes($connection,$page_number){
    $stm = $connection->prepare("SELECT * FROM visitors");
    $stm->execute();
    $results=$stm->fetchAll();

    $firstInterval=0;
    $secondInterval=0;
    $thirdInterval=0;
    $fourthInterval=0;
    foreach ($results as $result){
        if($result["time"]>"06:00:00" && $result["time"]<="15:00:00")
            $firstInterval++;
        else if($result["time"]>"15:00:00" && $result["time"]<="21:00:00")
            $secondInterval++;
        else if($result["time"]>"21:00:00" && $result["time"]<="24:00:00")
            $thirdInterval++;
        else if($result["time"]>"00:00:00" && $result["time"]<="06:00:00")
            $fourthInterval++;
    }
//    $stm = $connection->prepare("SELECT COUNT(id) FROM visitors WHERE page_number=?");
//    $stm->execute([$page_number]);
//    $results=$stm->fetch();
//    $thisPage=  "Návštevy tejto stránky: ".$results["COUNT(id)"];

    $stm = $connection->prepare("SELECT COUNT(id) FROM visitors WHERE page_number=1");
    $stm->execute();
    $results=$stm->fetch();
    $firstPage= $results[0];

    $stm = $connection->prepare("SELECT COUNT(id) FROM visitors WHERE page_number=2");
    $stm->execute();
    $results=$stm->fetch();
    $secondPage= $results[0];

    $stm = $connection->prepare("SELECT COUNT(id) FROM visitors WHERE page_number=3");
    $stm->execute();
    $results=$stm->fetch();
    $thirdPage= $results[0];

    $max=max($firstPage,$secondPage,$thirdPage);
    if($page_number==3) {
//        $thisPage=  "Návštevy tejto stránky: ".$results["COUNT(id)"];

        if ($max == $firstPage)
            echo "<p class='mostVisits'>Najviac návštev má 1. stránka</p>";
        elseif ($max == $secondPage)
            echo "<p class='mostVisits'>Najviac návštev má 2. stránka</p>";
        elseif ($max == $thirdPage)
            echo "<p class='mostVisits'>Najviac návštev má 3. stránka</p>";

//    echo "<br>6:00-15:00 -> ".$firstInterval."<br>15:00-21:00 -> ". $secondInterval."<br>21:00-24:00 -> ". $thirdInterval."<br>24:00-6:00 -> ". $fourthInterval;
        echo "<ul class='intervals'>";
        echo "<li>6:00-15:00 -> " . $firstInterval . "</li>";
        echo "<br><li>15:00-21:00 -> " . $secondInterval . "</li>";
        echo "<br><li>21:00-24:00 -> " . $thirdInterval . "</li>";
        echo "<br><li>24:00-6:00 -> " . $fourthInterval . "</li>";
        echo "</ul>";
    }
}



