<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "getConnection.php";
include ("functions.php");
$connection=(new Database())->getConnection();


$connection->query('SET foreign_key_checks = 0');
$PDOStatement = $connection->prepare("TRUNCATE TABLE user_actions");
$PDOStatement->execute();
$PDOStatement = $connection->prepare("TRUNCATE TABLE lectures");
$PDOStatement->execute();
$connection->query('SET foreign_key_checks = 1');


$curl=curl_init();
$home="https://github.com";
$raw="https://raw.githubusercontent.com";
curl_setopt($curl, CURLOPT_URL,$home."/apps4webte/curldata2021");
curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);
$html=curl_exec($curl);
curl_close($curl);

$doc = new DOMDocument();
@$doc->loadHTML($html);

$selector = new DOMXPath($doc);
$result=$doc->getElementsByTagName('a');


$allLinks=[];
foreach($result as $node) {
    $url=$node->getAttribute('href');
    $url=str_replace ( "/blob", "", $url );
    if(str_ends_with( $url , ".csv" ))
//        echo "<a href=".$raw.$url.">".$home.$url."</a><br>";
        array_push($allLinks,$raw.$url);
}
//var_dump($allLinks);


foreach($allLinks as $index=>$link) {

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $allLinks[$index]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);

    $str = mb_convert_encoding($output, "UTF-8", "UTF-16");
    $rows = explode("\n", $str);
    $csv = [];

    $stm = "INSERT INTO lectures (date) values (?)";
    $connection->prepare($stm)->execute([createLectureDate($allLinks[$index])]);


    $stm= $connection->prepare("INSERT INTO user_actions (lecture_id,name,surname,action,timestamp) values
    (?,?,?,?,?)");
    $stm->bindParam(":name",$name);
    $stm->bindParam(":surname",$surnaname);
    $stm->bindParam(":action",$action);
    $stm->bindParam(":timestamp",$timestamp);

    foreach ($rows as $key=>$row){
        $rowArray=str_getcsv($row, "\t");
        if($key>0 && ($rowArray[0])){
            $fullName=explode(" ", $rowArray[0]);
            $name=$fullName[0];
            $surname=$fullName[1];

            $action=$rowArray[1];

            if($index!=2) {
                $timestamp = date("Y-m-d H:i:s", date_create_from_format('d/m/Y, H:i:s', $rowArray[2])->getTimestamp());
            }
            else {
                $timestamp = date("Y-m-d H:i:s", date_create_from_format("Y-m-d H:i:s", createJeblyDatum($rowArray[2]))->getTimestamp());
            }
            $stm->execute([$index+1,$name,$surname,$action,$timestamp]);
        }
    }

}
echo "Successfully updated."."<br>";
echo ' <a href="index.php">Ok</a>';
?>
