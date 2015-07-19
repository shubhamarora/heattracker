<?php
require_once "db_conf.php";

$clickX = $_GET['x'];
$clickY = $_GET['y'];
$eleSelector = $_GET['selector'];
$url = $_GET['url'];

$sql = "INSERT INTO click_location VALUES($clickX,$clickY,'$eleSelector','$url')";

if(!$conn->query($sql)) {
    die("Error in SQL query: " + $conn->error);
}

$conn->close();
?>