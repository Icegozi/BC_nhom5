<?php
    require_once '../DAL/pichesData.php';
    require_once '../DAL/pitchDetailsData.php';

    function get_footballPichesDetails($id) {
        $conn = getConnection();
        if ($conn) {
            $pitch = getPitchById($conn, $id);
            $conn->close();
            return $pitch;
        }
        return null;
    }

    

function checkTimeOrder($conn, $pitch_id, $date, $start_time, $end_time) {
$query = "SELECT COUNT(*) as count FROM ORDERS WHERE pitch_id = ? AND date = ? AND (start_time < ? AND end_time> ?)";
    $stmt = $conn->prepare($query);
    $stmt->execute([$pitch_id, $date, $end_time, $start_time]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['count'] == 0;
    }