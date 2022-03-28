<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once ("../getConnection.php");


if(isset($_POST["username"])) {
    session_start();
    $connection = (new Database())->getConnection();

    $username = $_POST['username'];
    $password = $_POST['password'];


    $ldapconfig['host'] = 'ldap.stuba.sk';//CHANGE THIS TO THE CORRECT LDAP SERVER
    $ldapconfig['port'] = '389';
    $ldapconfig['basedn'] = 'ou=People, DC=stuba, DC=sk';//CHANGE THIS TO THE CORRECT BASE DN
    $ldapconfig['usersdn'] = 'cn=users';//CHANGE THIS TO THE CORRECT USER OU/CN
    $ds=ldap_connect($ldapconfig['host'], $ldapconfig['port']);

    ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
    ldap_set_option($ds, LDAP_OPT_REFERRALS, 0);
    ldap_set_option($ds, LDAP_OPT_NETWORK_TIMEOUT, 10);

    $dn="uid=".$username.",".$ldapconfig['basedn'];
    if(isset($_POST['username'])){
        if ($bind=ldap_bind($ds, $dn, $password)) {
//            echo("Login correct");
            $sr=ldap_search($ds,'ou=People, DC=stuba, DC=sk','uid='.$username,['givenname','surname','mail']);
            $info=ldap_get_entries($ds,$sr);

            try{
                $sql=$connection->prepare("SELECT * FROM user WHERE login=?");
                $sql->execute([$_POST["username"]]);
                $count = $sql->rowCount();

                if($count==0){
                    $stm = $connection->prepare("INSERT INTO user (login,email,name,surname,password,token) VALUES (?,?,?,?,?,?)");
                    $stm->execute([$_POST["username"], $info[0]['mail'][0], $info[0]['givenname'][0], $info[0]['sn'][0], "-",0]);
                }
            $stm = $connection->prepare("SELECT user.id FROM user WHERE user.login=?");
            $stm->execute([$username]);
            $result= $stm->fetchAll(PDO::FETCH_ASSOC);

            $stm = $connection->prepare("INSERT INTO login (login_id,logDate,type) VALUES (?,?,?)");
            $stm->execute([$result[0]["id"], date("Y/m/d"), "LDAP"]);
            }catch (Exception $e){
                echo $e->getMessage();
            }
            $_SESSION["login"]=$username;
            header("location:../index.php");
        } else {
            echo "Login Failed: Please check your username or password";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <title>Zadanie3</title>
    <link href=../css/mainPage.css rel="stylesheet">
</head>
<body>
<h1 style="margin-left: 42%"> LDAP login</h1>
<div class="login">
    <form action="" method="post">
        <label for="username">Username</label><br>
        <input id="username" name="username"><br>
        <label for="password">Password</label><br>
        <input id=password type="password" name="password"><br>
        <button class="loginButton" type="submit" value="Submit">Login</button>
    </form>
    <a class="goBack" href="https://wt72.fei.stuba.sk/Zadanie3">Go back</a>

</div>
<footer>
    Created by: Matúš Kanda
</footer>
</body>
</html>
