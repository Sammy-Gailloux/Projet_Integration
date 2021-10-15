<?php
    //header("Access-Control-Allow-Origin: *");
    //header("Content-Type: application/json");
    include_once "sqlconn.php";

    function loginUser($username, $password){
        $userExist = SQLquery("select prenom, nom, courriel from utilisateurs where alias = 'test12';");
        echo $userExist;
        if($userExist !==null){
            header("Location: ../loginPage.php");/*../loginPage.php?error=wronglogin for error handling purpose*/
            exit();
        }
    }

    if (isset($_POST["submit"])){
        $username = $_POST["username"];
        $password = $_POST["password"];
        

    }
    else header("Location: ../loginPage.php");