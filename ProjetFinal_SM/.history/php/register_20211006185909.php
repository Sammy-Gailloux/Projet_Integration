<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");
    include_once "sqlconn.php";

    //$availableArray = array();

    if (isset($_POST["submit"])){
        $username = $_POST["userName"];
        $firstname = $_POST["firstname"];
        $lastname = $_POST["lastname"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        //$userAvailable = json_decode(SQLquery("CALL la procédure stocké(les params)"))->response;
        
        if ($userAvailable == "0"){
            SQLExecute("CALL procédure stocké(params)");
            $availableArray = ["available"=>true];
        }//else["available"=>false];
        //echo json_encode($availableArray);

        SQLExecute("CALL procédure insertUser('$lastname', '$firstname', '$username', '$email', '$password')");
        //if ($userAvailable == "0"){
        //    SQLExecute("CALL procédure stocké(params)");
        //    $availableArray = ["available"=>true];
        //}else["available"=>false];
        //echo json_encode($availableArray);
    }