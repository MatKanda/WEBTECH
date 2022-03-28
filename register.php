<?php

session_start();
require_once "getConnection.php";

if($_SERVER["REQUEST_METHOD"]=="POST") {
    if (strcmp($_POST["password"], $_POST["repeatPassword"])==0) {
        try {
            $connection = (new Database())->getConnection();
            $sql=$connection->prepare("SELECT * FROM user WHERE login=?");
            $sql->execute([$_POST["login"]]);
            $count = $sql->rowCount();

            if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            }else{
                echo "<script type='text/javascript'>alert('Invalid email form');</script>";
            }

            if($count!=0){
                echo "<script type='text/javascript'>alert('The user with this login already exists');</script>";
            }else{
                $stm = $connection->prepare("INSERT INTO user (login,email,name,surname,password,token) VALUES (?,?,?,?,?,?)");
                $hashPassword = password_hash($_POST["password"], PASSWORD_DEFAULT);
                $stm->execute([$_POST["login"], $_POST["email"], $_POST["name"], $_POST["surname"], $hashPassword,0]);

                $_SESSION["login"]=$_POST["login"];
                header("location:2fa/start.php");
            }

        }catch(PDOException $e){
            echo "error: ".$e->getMessage();
            }
    }else
        echo "Zadane hesla sa nezhoduju";
}

?>
<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <title>Zadanie3</title>
    <link href="css/mainPage.css" rel="stylesheet">
</head>

<body>
<div style="margin-left: 45%">
    <h1>Register</h1>
    <form action="register.php" method="post">
        <label for="login">Login</label><br>
        <input type="text" placeholder="Login" name="login" id="login" required><br>

        <label for="name">Name</label><br>
        <input type="text" placeholder="Name" name="name" id="name" required><br>

        <label for="surname">Surname</label><br>
        <input type="text" placeholder="Surname" name="surname" id="surname" required><br>

        <label for="email">Email</label><br>
        <input type="text" placeholder="Email" name="email" id="email" required><br>

        <label for="password">Password</label><br>
        <input type="password" placeholder="Password" name="password" id="password" required><br>

        <label for="repeatPassword">Repeat password</label><br>
        <input type="password" placeholder="Password" name="repeatPassword" id="repeatPassword" required><br>

        <button class="loginButton" type="submit">Register</button>
    </form>
    <a class="goBack" href="https://wt72.fei.stuba.sk/Zadanie3">Go back</a>
</div>
<footer>
    Created by: Matúš Kanda
</footer>
</body>
</html>

