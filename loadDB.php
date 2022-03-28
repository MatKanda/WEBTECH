<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include ("getConnection.php");
$connection=(new Database())->getConnection();

if (file_exists('meniny.xml')) {
    $xml = simplexml_load_file('meniny.xml');
} else {
    exit('Failed to open test.xml.');
}

foreach ($xml->children() as $row) {
    $date=$row->den;
    $sk = $row->SK;
    $skdni = $row->SKdni;
    $skd = $row->SKd;
    $sks = $row->SKsviatky;
    $czs = $row->CZsviatky;
    $hu = $row->HU;
    $cz = $row->CZ;
    $pl = $row->PL;
    $at = $row->AT;


    $sql = "INSERT INTO record(den,SK,SKdni,SKd,SKsviatky,CZ,CZsviatky,HU,PL,AT) 
            VALUES ('" . $date . "','" . $sk . "','" . $skdni. "','" . $skd . "','" . $sks . "','" . $cz . "','" . $czs . "','" . $hu . "','" . $pl . "','" . $at . "')";

    $connection->exec($sql);
}
