<?php
include_once "sqlconn.php";

if (isset($_POST["submit"])) {
    var_dump($_SESSION);
    
    //$oldFirstname = $_SESSION["firstname"];
    //$oldPassword = $_SESSION["password"];
    //$newUsername = $_POST["userName"];
    //$newFirstname = $_POST["firstName"];
    //$newLastname = $_POST["lastName"];
    //$newEmail = $_POST["email"];
    //$newPassword = $_POST["password"];
//
    //SQLExecute("CALL modifyUser('$oldFirstname', 
    //                            '$oldPassword',
    //                            '$newLastname', 
    //                            '$newFirstname', 
    //                            '$newUsername', 
    //                            '$newEmail', 
    //                            '$newPassword')");
    header("location: ../index.php");
} else header("location: ../registerPage.php");