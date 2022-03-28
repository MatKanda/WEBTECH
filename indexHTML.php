<?php
include_once ("getConnection.php");

session_start();

function sessionToDB(){
    $connection=(new Database())->getConnection();
    try{
        $stm = $connection->prepare("SELECT user.id FROM user WHERE user.login=?");
        $stm->execute([$_SESSION["login"]]);
        $result= $stm->fetchAll(PDO::FETCH_ASSOC);

        $stm = $connection->prepare("INSERT INTO login (login_id,logDate,type) VALUES (?,?,?)");
        $stm->execute([$result[0]["id"], date("Y/m/d"), "2FA"]);
    }catch (Exception $e){
        echo $e->getMessage();
    }
}

function upperLogged(){
    $connection=(new Database())->getConnection();
    try {
        $stm = $connection->prepare("SELECT user.id FROM user WHERE user.login=?");
        $stm->execute([$_SESSION["login"]]);
        $results = $stm->fetchAll(PDO::FETCH_ASSOC);

        $stm = $connection->prepare("SELECT * FROM login WHERE login.login_id=?");
        $stm->execute([$results[0]["id"]]);
        $results=$stm->fetchAll(PDO::FETCH_ASSOC);
    }catch (PDOException $e){
        $e->getMessage();
    }


    echo "<div class='upperLogged'>".$_SESSION["login"]." je prave prihlaseny"."</div><br>
    <a class='logOut' href=logout.php>Logout</a>
    <a class='logHistory'>Login history</a>
    <table class='sessions'>
        <thead>
            <th>Login date</th>
            <th>Login type</th>
        </thead>
        <tbody>";
       foreach($results as $result) {
            echo "<tr>";
           echo "<td>".$result["logDate"]."</td>";
           echo "<td>".$result["type"]."</td>";
           echo "</tr>";
       }
    echo "</tbody>
        </table>";

}

function upperNotLogged(){
    echo
        "<div class='upperNotLogged'>Nikto nie je prihlaseny</div>" . "<br> 
    <form class=login action=login.php method=post>
        <label for=login>Login</label><br>
        <input type=text placeholder=Login name=login id=login required><br>
    
        <label for=password>Password</label><br>
        <input type=password placeholder=Password name=password id=password required><br>
    
        <button class=loginButton type=submit>Login</button>
    <div class='otherLogins'>
        <a href=ldap/index.php>Stuba login</a><br> <br>
        <a href=oauth/index.php>Google login</a><br>
    </div>
        <div class=register>
        <a href=register.php>Zaregistrujte sa</a>
    </div>
    </form>";
}