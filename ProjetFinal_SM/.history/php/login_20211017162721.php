<?php
//header("Access-Control-Allow-Origin: *");
//header("Content-Type: application/json");
include_once "sqlconn.php";

function loginUser($username, $password){
    $userExist = json_decode(SQLquery("CALL loginCheck('$username', '$password')"), true);
    var_dump($userExist);
    //echo $userExist[0]["prenom"];
    
    if($userExist == null){
        echo "test";
        header("location: ../loginPage.php?error=wronglogin");/*../loginPage.php?error=wronglogin for error handling purpose*/
        exit();
    }
    session_start();
    $_SESSION["userId"] = $userExist["num_utilisateur"];
    $_SESSION["username"] = $userExist["prenom".' '."nom"];
    header("location: ../index.php");
    exit();
    
    //echo $test[0]["nom"];
    //$hashedPwd = $userData[0]["mot_de_passe"];
    //$toHash = password_hash($password, PASSWORD_DEFAULT);
    //$checkPwd = password_verify($toHash, $hashedPwd);
    //echo $hashedPwd;
    //echo $toHash;
    
}
if (isset($_POST["submit"])){
    $username = $_POST["userName"];
    $password = $_POST["password"];
    
    loginUser($username, $password);
}
else header("location: ../index.php");