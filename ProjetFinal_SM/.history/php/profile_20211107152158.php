<?php
include_once "sqlconn.php";

if (isset($_POST["submit"])) {
    $oldFirstname = $_SESSION["firstname"];
    $newUsername = $_POST["userName"];
    $newFirstname = $_POST["firstName"];
    $newLastname = $_POST["lastName"];
    $newEmail = $_POST["email"];
    $newPassword = $_POST["password"];

    SQLExecute("CALL modifyUser('$lastname', '$firstname', '$username', '$email', '$password')");
    header("location: ../index.php");
} else header("location: ../registerPage.php");