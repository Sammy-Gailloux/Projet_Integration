<?php
//header("Access-Control-Allow-Origin: *");
//header("Content-Type: application/json");
include_once "sqlconn.php";
function loginUser($username, $password){
    $userExist = SQLquery("select num_utilisateur prenom, nom, courriel, mot_de_passe from utilisateurs where alias = '$username';");
    echo $userExist;
    if($userExist == null){/*maybe check other method*/
        echo "test";
        header("location: ../loginPage.php");/*../loginPage.php?error=wronglogin for error handling purpose*/
        exit();
    }
    //check password
    $hashedPwd = $userExist["mot_de_passe"];
    $checkPwd = password_verify($password, $hashedPwd);
    if($checkPwd === false){
        header("location: ../loginPage.php");
        exit();
    }else if ($checkPwd === true){
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