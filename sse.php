<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

include  "getConnection.php";
$connection=(new Database())->getConnection();

$index=0;

while (true) {
    $stm = $connection->query("SELECT * FROM results");
    $results = $stm->fetchAll();
    $sin=$results[0]["sin"];
    $cos=$results[0]["cos"];
    $sin_cos=$results[0]["sin_cos"];
    $lambda=$results[0]["lambda"];

    if($sin==1 && $cos==1 && $sin_cos==1){
        $msg=json_encode(["x"=>$index,"sin"=>sin($index*$lambda)*sin($index*$lambda),"cos"=>cos($index*$lambda)*cos($index*$lambda),"sin_cos"=>sin($index*$lambda)*cos($index*$lambda)]);
    }
    elseif ($sin==0 && $cos==1 && $sin_cos==1){
        $msg=json_encode(["x"=>$index,"sin"=>"stopped", "cos"=>cos($index*$lambda)*cos($index*$lambda),"sin_cos"=>sin($index*$lambda)*cos($index*$lambda)]);
    }
    elseif ($sin==1 && $cos==0 && $sin_cos==1){
        $msg=json_encode(["x"=>$index,"sin"=>sin($index*$lambda)*sin($index*$lambda),"cos"=>"stopped", "sin_cos"=>sin($index*$lambda)*cos($index*$lambda)]);
    }
    elseif ($sin==1 && $cos==1 && $sin_cos==0){
        $msg=json_encode(["x"=>$index,"sin"=>sin($index*$lambda)*sin($index*$lambda),"cos"=>cos($index*$lambda)*cos($index*$lambda),"sin_cos"=>"stopped"]);
    }
    elseif ($sin==0 && $cos==0 && $sin_cos==1){
        $msg=json_encode(["x"=>$index,"sin"=>"stopped","cos"=>"stopped","sin_cos"=>sin($index*$lambda)*cos($index*$lambda)]);
    }
    elseif ($sin==1 && $cos==0 && $sin_cos==0){
        $msg=json_encode(["x"=>$index,"sin"=>sin($index*$lambda)*sin($index*$lambda),"cos"=>"stopped","sin_cos"=>"stopped"]);
    }
    elseif ($sin==0 && $cos==1 && $sin_cos==0){
        $msg=json_encode(["x"=>$index,"sin"=>"stopped","cos"=>cos($index*$lambda)*cos($index*$lambda),"sin_cos"=>"stopped"]);
    }
    elseif ($sin==0 && $cos==0 && $sin_cos==0){
        $msg=json_encode(["x"=>$index, "sin"=>"stopped","cos"=>"stopped","sin_cos"=>"stopped"]);
    }
    sendSSE($index++,$msg);
    sleep(2);
}

function sendSSE($id,$msg){
    echo "id: $id\n";
    echo "event: event\n";
    echo "data: $msg\n\n";
    ob_flush();
    flush();
}
