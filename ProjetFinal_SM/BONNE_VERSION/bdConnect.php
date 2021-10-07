<?php

$servername = "167.114.152.54";
$username = "sammy";
$password = "HTDB";
$dbname="HTDB";

// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>