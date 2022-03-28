<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "getConnection.php";
$connection=(new Database())->getConnection();
?>

<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <title>Zadanie4</title>
    <link href="custom.css" rel="stylesheet">
</head>
<body>
<ul>
    <li><a href="http://147.175.98.72/Zadanie4/">Home</a></li>
    <li><a href="http://147.175.98.72/Zadanie4/graph.php">Graph</a></li>
    <li id="updateData"><a href="updateDB.php">Update data</a></li>
</ul>

<!--<button class="myBtn">Open Modal</button>-->
<div id="loader" class="loader"></div>

    <table id="table">
        <thead class="tbl-header">
        <tr>
            <th>Meno</th>
            <th>Priezvisko</th>
            <?php
            $stm=$connection->query("SELECT * FROM lectures");
            $rows=$stm->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rows as $row){
                echo "<th>" ."Prednaska: ".$row["date"] . "</th>";
            }
            ?>
            <th>Celkova ucast</th>
            <th>Celkovy cas</th>
        </tr>
        </thead>

        <tbody class="tbl-content">
            <?php
            $stm = $connection->query("SELECT COUNT(id) FROM lectures");
            $totalLectures = $stm->fetchAll();
            $totalLectures = $totalLectures[0]["COUNT(id)"];

            $stm = $connection->query("SELECT DISTINCT name,surname FROM user_actions");
            $allPeople=$stm->fetchAll(PDO::FETCH_ASSOC);

//            var_dump($allPeople);

            for($i=0;$i<sizeof($allPeople);$i++){
                $stm = "SELECT name,surname FROM user_actions WHERE name=? AND surname=?";
                $stm=$connection->prepare($stm);
                $stm->execute([$allPeople[$i]["name"],$allPeople[$i]["surname"]]);
                $result=$stm->fetchAll(PDO::FETCH_ASSOC);

                if($result[0]["surname"]=="" || $result[0]["surname"]==null)
                    continue;

//                var_dump($result);
                echo "<tr>";
                echo "<td>".$result[0]["name"]."</td>";
                echo "<td>".$result[0]["surname"]."</td>";

                $sumOfTimes=0;
                $attendance=0;
                for($j=1;$j<=$totalLectures;$j++){
                    $stm = "SELECT MAX(timestamp) FROM user_actions WHERE lecture_id=?";
                    $stm=$connection->prepare($stm);
                    $stm->execute([$j]);
                    $result=$stm->fetchAll(PDO::FETCH_ASSOC);
                    $lastDisconnect=$result[0]["MAX(timestamp)"];

                    $stm = "SELECT COUNT(id),name,surname FROM user_actions WHERE lecture_id=? AND name=? AND surname=?";
                    $stm=$connection->prepare($stm);
                    $stm->execute([$j,$allPeople[$i]["name"],$allPeople[$i]["surname"]]);
                    $result=$stm->fetchAll(PDO::FETCH_ASSOC);

                    $stm2 = "SELECT timestamp FROM user_actions WHERE lecture_id=? AND name=? AND surname=?";
                    $stm2=$connection->prepare($stm2);
                    $stm2->execute([$j,$allPeople[$i]["name"],$allPeople[$i]["surname"]]);
                    $result2=$stm2->fetchAll(PDO::FETCH_ASSOC);

                    $times=[];
                    $even=0;

//                    echo $result[0]["COUNT(id)"];
                    for($o=0;$o<$result[0]["COUNT(id)"];$o++){
                        array_push($times,$result2[$o]["timestamp"]);
                        $even++;
                    }
                    if($even!=0)
                        $attendance++;

                    $name=$allPeople[$i]['name'];
                    $surname=$allPeople[$i]['surname'];
                    $lectureID=$j;
                    if($even%2!=0) {
                        array_push($times, $lastDisconnect);
                        echo "<td class='myBtn redText'>".calculateTime($times)."</td>";
                    }else {
                        echo "<td class='myBtn'>" . calculateTime($times) . "</td>";
                    }
                    $sumOfTimes=$sumOfTimes+calculateTime($times);

                }
                echo "<td>$attendance</td>";
                echo "<td>$sumOfTimes</td>";
                echo "</tr>";
            }
                function calculateTime($array){
                    $sum = 0;
                    for ($i = 0; $i < sizeof($array)-1; $i++) {
                        $to_time = strtotime($array[$i]);
                        $from_time = strtotime($array[$i + 1]);
                        $sum = $sum+round(abs($to_time - $from_time) / 60, 2);
                    }
                    return $sum;
                }

        ?>
        </tbody>
    </table>

<div id="myModal" class="modal">
    <div id="modal-content">
        <span class="close">&times;</span>
        <p></p>
    </div>

</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script  src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.js"></script>
<script src="custom.js"></script>
</body>
</html>

