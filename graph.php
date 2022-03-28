<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "getConnection.php";
$connection=(new Database())->getConnection();

$stm = $connection->query("SELECT COUNT(id) FROM lectures");
$totalLectures = $stm->fetchAll();
$totalLectures = $totalLectures[0]["COUNT(id)"];

$attendance=[];
$lectures=[];
for ($i=1;$i<=$totalLectures;$i++) {
    $stm = "SELECT DISTINCT name,surname FROM user_actions WHERE lecture_id=?";
    $stm=$connection->prepare($stm);
    $stm->execute([$i]);
    $allPeople=$stm->fetchAll(PDO::FETCH_ASSOC);
    array_push($attendance,sizeof($allPeople));
}

    $stm = "SELECT date FROM lectures";
    $stm=$connection->prepare($stm);
    $stm->execute();
    $allLectures=$stm->fetchAll(PDO::FETCH_ASSOC);
    for ($i=0;$i<sizeof($allLectures);$i++){
        array_push($lectures,$allLectures[$i]["date"]);
    }

?>

<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <title>Zadanie4</title>
    <link href="custom.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

</head>
<body>
<ul>
    <li><a href="http://147.175.98.72/Zadanie4/">Home</a></li>
    <li><a href="http://147.175.98.72/Zadanie4/graph.php">Graph</a></li>
</ul>

<div id="chart"></div>

<script>
    var attendance = <?php echo json_encode($attendance); ?>;
    var lectures = <?php echo json_encode($lectures); ?>;
    var options = {
        series: [{
            name: 'Počet',
            data: attendance
        }],
        chart: {
            height: 460,
            type: 'bar',
        },
        plotOptions: {
            bar: {
                borderRadius: 10,
                dataLabels: {
                    position: 'top', // top, center, bottom
                },
            }
        },
        dataLabels: {
            enabled: true,
            formatter: function (val) {
                return val + " ľudí";
            },
            offsetY: -20,
            style: {
                fontSize: '12px',
                colors: ["#304758"]
            }
        },

        xaxis: {
            categories: lectures,
            position: 'top',
            axisBorder: {
                show: false
            },
            sTicks: {
                show: false
            },
            crosshairs: {
                fill: {
                    type: 'gradient',
                    gradient: {
                        colorFrom: '#D8E3F0',
                        colorTo: '#BED1E6',
                        stops: [0, 100],
                        opacityFrom: 0.4,
                        opacityTo: 0.5,
                    }
                }
            },
            tooltip: {
                enabled: true,
            }
        },
        yaxis: {
            axisBorder: {
                show: false
            },
            axisTicks: {
                show: false,
            },
            labels: {
                show: false,
                formatter: function (val) {
                    return val + " ľudí";
                }
            }
        }
    };

    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();
</script>
</body>
</html>
