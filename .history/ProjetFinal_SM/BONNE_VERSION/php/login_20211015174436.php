<?php
    //header("Access-Control-Allow-Origin: *");
    //header("Content-Type: application/json");
    include_once "sqlconn.php";

    if (isset($_POST["submit"])){
        $username = $_POST["username"];
        $password = $_POST["password"];
        echo "ça marche";
    }
    else header("Location: ../loginPage.php");