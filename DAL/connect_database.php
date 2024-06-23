<?php
function getConnection() {
    $host = "localhost:5306";
    $db_name = "quan_ly_san_bong";
    $username = "root";
    $password = "";

    try {
        $conn = new mysqli($host, $username, $password, $db_name);
        return $conn;
    } catch(PDOException $exception) {
        echo "Connection error: " . $exception->getMessage();
        return null;
    }
}