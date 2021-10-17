<?php
//header("Access-Control-Allow-Origin: *");
//header("Content-Type: application/json");
include_once "sqlconn.php";
function loginUser($username, $password){
    $userExist = SQLquery("select num_utilisateur, prenom, nom, courriel, mot_de_passe from utilisateurs where alias = '$username'");
    if($userExist == null){/*maybe check other method*/
        echo "test";
        header("location: ../loginPage.php?error=wronglogin");/*../loginPage.php?error=wronglogin for error handling purpose*/
        exit();
    }
    //check password
    $userData = json_decode($userExist, true);
    //var_dump($userData);
    //echo $test[0]["nom"];
    $hashedPwd = $userData[0]["mot_de_passe"];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $checkPwd = password_verify($password, $hashedPwd);
    echo $hashedPwd;
    echo $password;
    if($checkPwd === false){
        //echo "test2";
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