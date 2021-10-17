<?php
//header("Access-Control-Allow-Origin: *");
//header("Content-Type: application/json");
include_once "sqlconn.php";

function encryptPass($password) {
    $sSalt = '20adeb83e85f03cfc84d0fb7e5f4d290';
    $sSalt = substr(hash('sha256', $sSalt, true), 0, 32);
    $method = 'aes-256-cbc';

    $iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);

    $encrypted = base64_encode(openssl_encrypt($password, $method, $sSalt, OPENSSL_RAW_DATA, $iv));
    return $encrypted;
}
function loginUser($username, $password){
    $userExist = json_decode(SQLquery("select num_utilisateur, prenom, nom, courriel, mot_de_passe from utilisateurs where alias = '$username' and mot_de_passe = '$password'"), true);
    echo $userExist[0]["prenom"];
    encryptPass()
    if($userExist == null){/*maybe check other method*/
        echo "test";
        //header("location: ../loginPage.php?error=wronglogin");/*../loginPage.php?error=wronglogin for error handling purpose*/
        exit();
    }

    //var_dump($userData);
    //echo $test[0]["nom"];
    //$hashedPwd = $userData[0]["mot_de_passe"];
    //$toHash = password_hash($password, PASSWORD_DEFAULT);
    //$checkPwd = password_verify($toHash, $hashedPwd);
    //echo $hashedPwd;
    //echo $toHash;
    if($userExist === false){
        //echo "test2";
        //header("location: ../loginPage.php?error=wrongpassword");
        //exit();
    }else if ($userExist === true){
        session_start();
        $_SESSION["userId"] = $userExist["num_utilisateur"];
        $_SESSION["username"] = $userExist["prenom".' '."nom"];
        header("location: ../index.php");
        exit();
    }
}
if (isset($_POST["submit"])){
    $username = $_POST["userName"];
    $password = $_POST["password"];
    
    loginUser($username, $password);
}
else if (!isset($_POST["submit"])) echo "marche pas";