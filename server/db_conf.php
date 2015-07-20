<?php

$dbHost = "localhost";
$dbUser = "root";
$dbPass = "";
$dbName = "heatmap";

$conn = new mysqli($dbHost,$dbUser,$dbPass,$dbName);

if($conn->connect_error) {
    die("Connection Error: ".$conn->connect_error." in ".$conn->connect_errno);
}

?>