<?php
//header("Access-Control-Allow-Origin: *");
//header("Content-Type: application/json");
include_once "sqlconn.php";
function loginUser($username, $password){
    $userExist = SQLquery("select num_utilisateur, prenom, nom, courriel, mot_de_passe from utilisateurs where alias = '$username'");
    echo $userExist;
    if($userExist == null){/*maybe check other method*/
        echo "test";
        header("location: ../loginPage.php?error=wronglogin");/*../loginPage.php?error=wronglogin for error handling purpose*/
        exit();
    }
    //check password
    echo $userExist[0]["prenom"];
    $hashedPwd = $userExist["mot_de_passe"];
    $checkPwd = password_verify($password, $hashedPwd);
    echo $checkPwd;
    if($checkPwd === false){
        echo "test2";
        //header("location: ../loginPage.php?error=wrongpassword");
        //exit();
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