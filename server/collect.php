<?php

     /**
     * Enabling CORS request as heattracker.js will send an ajax call
     * to this php script which will save the collected sent data.
     *
     * Other Method: Send a 1x1 pixel image request to this php script
     * with the required data in the url get parameters. This way we
     * don't have to enable CORS request and the web service is easily
     * accessible.
     */

     // Allow from any origin
    if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 25920000');    // cache for 1 month
    }

    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET");

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
    }

    require_once "db_conf.php";

    $clickX = $_GET['x'];
    $clickY = $_GET['y'];
    $eleSelector = $_GET['selector'];
    $url = $_GET['url'];
    $tracking_id = $_GET['htid'];

    $sql = "INSERT INTO click_location VALUES($clickX,$clickY,'$eleSelector','$url','$tracking_id')";

    if(!$conn->query($sql)) {
        die("Error in SQL query: " + $conn->error);
    }

    $conn->close();
?>