<?php

function createMainTable($statement){
    echo "
            <thead>
        <tr>
            <th>Name</th>
            <th>Surname</th>
            <th>Year</th>
            <th>Country</th>
            <th>City</th>
            <th>Type</th>
            <th>Discipline</th>
        </tr>
        </thead>
        <tbody>";
    $rows = $statement->fetchAll(PDO::FETCH_ASSOC);

    foreach($rows as $row) {
        echo "<tr>";

        echo "<td><a href='http://147.175.98.72/Zadanie2/php/viewPerson.php?id=".$row["id"]."'>".$row["name"]."</a></td>";
        echo "<td><a href='http://147.175.98.72/Zadanie2/php/viewPerson.php?id=".$row["id"]."'>".$row["surname"]."</a></td>";
        echo "<td>" , $row["year"] , "</td>";
        echo "<td>" , $row["country"] , "</td>";
        echo "<td>" , $row["city"] , "</td>";
        echo "<td>" , $row["type"] , "</td>";
        echo "<td>" , $row["discipline"] , "</td>";

        echo "</tr>";
    }
    echo "
            </tbody>
    </table>";
}

function createTOP10($statement){
    echo "
                <table id='table2'>
                <thead>
                <tr>
                    <th>Surname</th>
                    <th>Name</th>
                    <th>Birth country</th>
                    <th>Number of medals</th>
                    <th>Modifications</th>                   
                </tr>
                </thead>
                <tbody>";
    $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach($rows as $row) {
        echo "<tr>";

        echo "<td><a href='http://147.175.98.72/Zadanie2/php/viewPerson.php?id=".$row["id"]."'>".$row["surname"]."</a></td>";
        echo "<td><a href='http://147.175.98.72/Zadanie2/php/viewPerson.php?id=".$row["id"]."'>".$row["name"]."</a></td>";

        echo "<td>" , $row["birth_country"] , "</td>";
        echo "<td>" , $row["COUNT(placement.placing)"] , "</td>";
        echo "<td> <button><a href='http://147.175.98.72/Zadanie2/php/modifications/deletePerson.php?id=".$row["id"]."'>"."Delete"."</a></button>
        <button><a href='http://147.175.98.72/Zadanie2/php/modifications/editPerson.php?id=".$row["id"]."'>"."Edit"."</a></button></td>";

        echo "</tr>";
    }
    echo "
                    </tbody>
            </table>";
}


function createPersonalTableHeader($statement){

    $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach($rows as $row) {

        echo "<h1>", $row["name"]." ".$row["surname"],"</h1>";
        echo "<ul>";
            echo "<li> Birth day: " , $row["birth_day"] , "</li>";
            echo "<li>Birth place: " , $row["birth_place"] , "</li>";
            echo "<li>Birth country: " , $row["birth_country"] , "</li>";
            echo "<li>Death day: " , $row["death_day"] , "</li>";
            echo "<li>Death place: " , $row["death_place"] , "</li>";
            echo "<li>Death country: " , $row["death_country"] , "</li>";
        echo "</ul>";
    }
}

function createPersonalTableOlympics($statement){
    echo
    "<table>
                <thead>
                <tr>
                    <th>Type</th>
                    <th>Year</th>
                    <th>Placing</th>
                    <th>Discipline</th>
                </tr>
                </thead>
                <tbody>";
    $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach($rows as $row) {
        echo "<tr>";

        echo "<td>" , $row["type"] , "</td>";
        echo "<td>" , $row["year"] , "</td>";
        echo "<td>" , $row["placing"] , "</td>";
        echo "<td>" , $row["discipline"] , "</td>";

        echo "</tr>";
    }
    echo "                
                </tbody>
            </table>";
}