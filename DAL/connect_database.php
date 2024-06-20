<?php
function getConnection() {
    $host = "localhost:8111";
    $db_name = "qlsss";
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
?>