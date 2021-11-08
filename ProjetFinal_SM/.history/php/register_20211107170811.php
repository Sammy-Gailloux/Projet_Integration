<?php
//header("Access-Control-Allow-Origin: *");
//header("Content-Type: application/json");
include_once "sqlconn.php";

echo "test register.php";
if (isset($_POST["submit"])) {
    $username = $_POST["userName"];
    $firstname = $_POST["firstName"];
    $lastname = $_POST["lastName"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    SQLExecute("CALL insertUser('$lastname', '$firstname', '$username', '$email', '$password')");
    header("location: ../index.php");
} else header("location: ../registerPage.php");
