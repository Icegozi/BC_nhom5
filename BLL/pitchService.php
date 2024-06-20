<?php
    require_once '../DAL/pichesData.php';
    require_once '../DAL/pitchDetailsData.php';

    function getPitch($id) {
        $pitch = getPitchById($id);
        return $pitch;
    }

<<<<<<< HEAD
    function getPichesDetails($id) {
        $images = getPitchDetailsById($id);
        return $images;
    }

    
?>
=======
    function checkTimeOrder($conn, $pitch_id, $date, $start_time, $end_time) {
    $query = "SELECT COUNT(*) as count FROM ORDERS WHERE pitch_id = ? AND date = ? AND (start_time < ? AND end_time > ?)";
    $stmt = $conn->prepare($query);
    $stmt->execute([$pitch_id, $date, $end_time, $start_time]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['count'] == 0;
    }
>>>>>>> 9a12902fc5bf40b04c3f6b7269b59ce429f226a3
