<?php

function createLectureDate($rawData){
    $trimmed=explode("/",$rawData);;
    $trimmed=explode("_",$trimmed[6]);
    $day=$trimmed[0][6].$trimmed[0][7];
    $month=$trimmed[0][4].$trimmed[0][5];
    $year=$trimmed[0][0].$trimmed[0][1].$trimmed[0][2].$trimmed[0][3];
    return $year."-".$month."-".$day;
}

function createJeblyDatum($rawData){
    $trimmed= explode(",", $rawData);
    $trimmedDate=explode("/",$trimmed[0]);
    $day="0".$trimmedDate[0];
    $month=$trimmedDate[1];
    $year=$trimmedDate[2];

    $trimmedTime=explode(" ",$trimmed[1]);
    return $year."-".$month."-".$day. " ".$trimmedTime[1];
}


