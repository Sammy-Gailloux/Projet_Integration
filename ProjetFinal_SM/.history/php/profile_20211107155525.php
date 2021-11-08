<?php
include_once "sqlconn.php";
session_start();
if (isset($_POST["submit"])) {
    //echo "session";
    //var_dump($_SESSION);
    //echo "post";
    //var_dump($_POST);
    $oldFirstname = $_SESSION["firstname"];
    $oldPassword = $_SESSION["password"];
    $newUsername = $_POST["userName"];
    $newFirstname = $_POST["firstName"];
    $newLastname = $_POST["lastName"];
    $newEmail = $_POST["email"];
    $newPassword = $_POST["password"];

    SQLExecute("CALL modifyUser('$oldFirstname', 
                                '$oldPassword',
                                '$newLastname', 
                                '$newFirstname', 
                                '$newUsername', 
                                '$newEmail', 
                                '$newPassword')");
    //header("location: ../index.php");
} else header("location: ../registerPage.php");