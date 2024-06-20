<?php
    require_once './DAL/connect_database.php';

    function getPitchById($conn, $pitch_id) {
        $conn = getConnection();
        $query = "SELECT * FROM FOOTBALL_PITCHES WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $pitch_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $pitch = $result->fetch_assoc();
        $stmt->close();
        $conn->close();
        return $pitch;
    }