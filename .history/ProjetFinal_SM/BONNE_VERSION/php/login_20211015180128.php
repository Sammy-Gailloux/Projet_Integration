<?php
    //header("Access-Control-Allow-Origin: *");
    //header("Content-Type: application/json");
    include_once "sqlconn.php";

    function loginUser($username, $password){

    }

    if (isset($_POST["submit"])){
        $username = $_POST["username"];
        $password = $_POST["password"];
        

    }
    else header("Location: ../loginPage.php");