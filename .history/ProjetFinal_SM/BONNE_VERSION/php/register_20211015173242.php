<?php
//header("Access-Control-Allow-Origin: *");
//header("Content-Type: application/json");
include_once "sqlconn.php";

//$availableArray = array();
echo "test register.php";
if (isset($_POST["submit"])) {
    $username = $_POST["userName"];
    $firstname = $_POST["firstName"];
    $lastname = $_POST["lastName"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    echo "marche";
    //$userAvailable = json_decode(SQLquery("CALL la procédure stocké(les params)"))->response;

    //if ($userAvailable == "0"){
    //    SQLExecute("CALL procédure stocké(params)");
    //    $availableArray = ["available"=>true];
    //}//else["available"=>false];
    //echo json_encode($availableArray);

    SQLExecute("CALL insertUser('$lastname', '$firstname', '$username', '$email', '$password')");
    header("Location: ../index.php");
    //if ($userAvailable == "0"){
    //    SQLExecute("CALL procédure stocké(params)");
    //    $availableArray = ["available"=>true];
    //}else["available"=>false];
    //echo json_encode($availableArray);
} else;
