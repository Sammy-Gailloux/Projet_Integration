<?php
include_once "sqlconn.php";

if (isset($_POST["submit"])) {
    $oldUsername = $[""];
    $username = $_POST["userName"];
    $firstname = $_POST["firstName"];
    $lastname = $_POST["lastName"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    SQLExecute("CALL modifyUser('$lastname', '$firstname', '$username', '$email', '$password')");
    header("location: ../index.php");
} else header("location: ../registerPage.php");