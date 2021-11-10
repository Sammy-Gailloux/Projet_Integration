<?php
include_once "sqlconn.php";

if (isset($_POST["submit"])) {
    $oldPassword = $_POST["oldPassword"];
    $newUsername = $_POST["userName"];
    $newFirstname = $_POST["firstName"];
    $newLastname = $_POST["lastName"];
    $newEmail = $_POST["email"];
    $newPassword = $_POST["newPassword"];

    SQLExecute("CALL modifyUser('$oldPassword', '$newLastname', '$newFirstname', '$newUsername', '$newEmail', '$newPassword')");
    ///////////////////////////////////////////////////////////////////
    //Pas sécuritaire car on peut voir certain nom de colonne de la bd
    ///////////////////////////////////////////////////////////////////
    $userExist = json_decode(SQLquery("CALL loginCheck('$newUsername', '$newPassword')"), true)[0];
    $_SESSION["alias"] = $userExist["alias"];
    $_SESSION["userId"] = $userExist["num_utilisateur"];
    $_SESSION["loggedin"] = true;
    header("location: ./logout.php");
    header("location: ./login.php");
    header("location: ../index.php");
} else header("location: ../registerPage.php");