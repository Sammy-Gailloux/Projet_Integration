<?php
//header("Access-Control-Allow-Origin: *");
//header("Content-Type: application/json");
include_once "sqlconn.php";

function loginUser($alias, $password){
    $userExist = json_decode(SQLquery("CALL loginCheck('$alias', '$password')"), true)[0];
    
    if($userExist == null){
        echo "test";
        header("location: ../loginPage.php?error=wronglogin");
        exit();
    }
    session_start();
    $_SESSION["userId"] = $userExist["num_utilisateur"];
    $_SESSION["alias"] = $userExist["alias"];
    header("location: ../index.php?login=success");
    exit();   
}
if (isset($_POST["submit"])){
    $alias = $_POST["alias"];
    $password = $_POST["password"];

    loginUser($alias, $password);
}
else header("location: ../index.php");