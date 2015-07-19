<?php

$dbHost = "localhost";
$dbUser = "root";
$dbPass = "";
$dbName = "heatmap";

$conn = new mysqli($dbHost,$dbUser,$dbPass,$dbName);

if($conn->connect_error) {
    http_response_code(404);
}
http_response_code(404);
?>