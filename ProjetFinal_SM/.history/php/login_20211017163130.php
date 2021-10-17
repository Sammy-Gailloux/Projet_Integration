<?php
//header("Access-Control-Allow-Origin: *");
//header("Content-Type: application/json");
include_once "sqlconn.php";

function loginUser($username, $password){
    $userExist = json_decode(SQLquery("CALL loginCheck('$username', '$password')"), true)[0];
    //var_dump($userExist);
    //echo $userExist[0]["prenom"];
    
    if($userExist == null){
        echo "test";
        header("location: ../loginPage.php?error=wronglogin");/*../loginPage.php?error=wronglogin for error handling purpose*/
        exit();
    }
    session_start();
    $_SESSION["userId"] = $userExist["num_utilisateur"];
    $_SESSION["username"] = $userExist["prenom".' '."nom"];
    echo $_SESSION["userId"];
    echo $_SESSION["username"];
    //header("location: ../index.php?success=goodlogin");
    //exit();   
}
if (isset($_POST["submit"])){
    $username = $_POST["userName"];
    $password = $_POST["password"];

    loginUser($username, $password);
}
else header("location: ../index.php");