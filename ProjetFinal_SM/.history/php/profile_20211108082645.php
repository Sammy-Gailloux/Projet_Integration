<?php
include_once "sqlconn.php";
if (isset($_POST["submit"])) {
    echo "post";
    var_dump($_POST);
    //in ancienMDP varchar(45),
	//in nouveau_nom varchar(50), 
    //in nouveau_prenom varchar(50),
    //in nouvel_alias varchar(45),
    //in nouveau_courriel varchar(200),
    //in nouveau_mdp varchar(45)

    $oldPassword = $_POST["oldPassword"];
    $newUsername = $_POST["userName"];
    $newFirstname = $_POST["firstName"];
    $newLastname = $_POST["lastName"];
    $newEmail = $_POST["email"];
    $newPassword = $_POST["newPassword"];

    SQLExecute("CALL modifyUser('$oldPassword', '$newLastname', '$newFirstname', '$newUsername', '$newEmail', '$newPassword')");
    ////////////////////
    //PAS SÉCURITAIRE
    $userExist = json_decode(SQLquery("CALL loginCheck('$alias', '$password')"), true)[0];
    $_SESSION["alias"] = $userExist["num_utilisateur"];
    $_SESSION["userId"] = 
    header("location: ../index.php");
} else header("location: ../registerPage.php");