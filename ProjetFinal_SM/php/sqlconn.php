<?php
    function SQLconn ($url = "167.114.152.54", $user = "sammy", $password = "HTDB", $database = "HTDB") {
        $mysqli = new mysqli($url, $user, $password, $database);
        if ($mysqli -> connect_errno) {
            echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
            exit();
        }
        return $mysqli;
    }
    function ResponseToJson($resultat){   
        $json_array = array();   
        while($row = mysqli_fetch_assoc($resultat)){
            $json_array[] = $row;
        }
        return json_encode($json_array);
    }
    function SQLquery($request){
        $mysqli = SQLconn();
        $result = $mysqli->query($request);
        $mysqli->close();
        return ResponseToJson($result);
    }
    function SQLExecute($toExec){
        $mysqli = SQLconn();
        $mysqli->query($toExec);
        $mysqli->close();
    }
    