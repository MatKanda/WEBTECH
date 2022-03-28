<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include ("../indexHTML.php");

try {
    $connection = new PDO("mysql:host=localhost;dbname=zadanie3", "xkanda", "XS9vNlM$#HcBq2");
    // set the PDO error mode to exception
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch
(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

//session_start();
define('MYDIR','../google-api-php-client--PHP8.0/');
require_once(MYDIR."vendor/autoload.php");

$redirect_uri = 'https://wt72.fei.stuba.sk/Zadanie3/oauth/';

$client = new Google_Client();
$client->setAuthConfig('../configs/credentials.json');
$client->setRedirectUri($redirect_uri);
$client->addScope("email");
$client->addScope("profile");
      
$service = new Google_Service_Oauth2($client);
			
if(isset($_GET['code'])){
  $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
  $client->setAccessToken($token);
  $_SESSION['upload_token'] = $token;

  // redirect back to the example
  header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
}

// set the access token as part of the client
if (!empty($_SESSION['upload_token'])) {
  $client->setAccessToken($_SESSION['upload_token']);
  if ($client->isAccessTokenExpired()) {
    unset($_SESSION['upload_token']);
  }
} else {
  $authUrl = $client->createAuthUrl();
}

if ($client->getAccessToken()) {
    //Get user profile data from google
    $UserProfile = $service->userinfo->get();
    var_dump($client->getAccessToken());
    if(!empty($UserProfile)){
        $output = '<h1>Profile Details </h1>';
        $output .= '<img src="'.$UserProfile['picture'].'">';
        $output .= '<br/>Google ID : ' . $UserProfile['id'];
        $output .= '<br/>Name : ' . $UserProfile['given_name'].' '.$UserProfile['family_name'];
        $output .= '<br/>Email : ' . $UserProfile['email'];
        $output .= '<br/>Locale : ' . $UserProfile['locale'];
        $output .= '<br/><br/>Logout from <a href="logout.php">Google</a>';
        $_SESSION["login"]=$UserProfile['email'];
        try {
            $sql=$connection->prepare("SELECT * FROM user WHERE login=?");
            $sql->execute([$UserProfile['email']]);
            $count = $sql->rowCount();

            if($count==0){
                $stm = $connection->prepare("INSERT INTO user (login,email,name,surname,password,token) VALUES (?,?,?,?,?,?)");
                $stm->execute([$UserProfile['email'], $UserProfile['email'], $UserProfile['given_name'], $UserProfile['family_name'], "-",0]);
            }

            $stm = $connection->prepare("SELECT user.id FROM user WHERE user.login=?");
            $stm->execute([$UserProfile['email']]);
            $result= $stm->fetchAll(PDO::FETCH_ASSOC);

            $stm = $connection->prepare("INSERT INTO login (login_id,logDate,type) VALUES (?,?,?)");
            $stm->execute([$result[0]["id"], date("Y/m/d"), "Google"]);
        }catch (Exception $e){
            echo $e->getMessage();
        }
        header("location:../index.php");


    }else{
        $output = '<h3 style="color:red">Some problem occurred, please try again.</h3>';
    }   
  } else {
      $authUrl = $client->createAuthUrl();
      $output = '<a href="'.filter_var($authUrl, FILTER_SANITIZE_URL).'"><img src="images/glogin.png" alt=""/></a>';
  }
?>

<div><?php echo $output; ?></div>
