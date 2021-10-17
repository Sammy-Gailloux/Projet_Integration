<?php
//header("Access-Control-Allow-Origin: *");
//header("Content-Type: application/json");
include_once "sqlconn.php";

function loginUser($username, $password){
    $userExist = json_decode(SQLquery("CALL loginCheck('$username', '$password')"), true);
    var_dump
    //echo $userExist[0];
    //echo $password;
    
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