<?php
require_once 'connect_database.php';
require_once __DIR__ . '/../MODEL/football_pitches_model.php';

function getDataPitch(){
    $conn = getConnection();
    $sql = "SELECT * FROM football_pitches";
    $result = $conn->query($sql);
    
    if ($result === false) {
        // Xử lý lỗi truy vấn cơ sở dữ liệu
        die("Error in query: " . $conn->error);
    }
    
    $conn->close();
    return $result;
}

function AddPitchToData($name, $time_start, $time_end, $description, $price_per_hour, $price_per_peak_hour, $is_maintenance, $pitch_type_id, $created_at, $updated_at) {
    $conn = getConnection();
    try {
        // Prepare the SQL query with placeholders
        $query = "INSERT INTO football_pitches(name, time_start, time_end, description, price_per_hour, price_per_peak_hour, is_maintenance, pitch_type_id, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        // Prepare the statement
        $stmt = $conn->prepare($query);

        // Bind parameters with types
        // 'ssssddiiss' corresponds to 10 parameters: 9 strings and 1 integer
        $stmt->bind_param('ssssddiiss', $name, $time_start, $time_end, $description, $price_per_hour, $price_per_peak_hour, $is_maintenance, $pitch_type_id, $created_at, $updated_at);

        // Execute the statement
        $stmt->execute();

        // Close the statement
        $stmt->close();
    } catch (Exception $e) {
        // Handle any exceptions
        $errorMessage = "Lỗi: " . $e->getMessage();
    }
    
    // Close the connection
    $conn->close();
}

function UpdatePitch($id, $name, $time_start, $time_end, $description, $price_per_hour, $price_per_peak_hour, $is_maintenance, $pitch_type_id, $updated_at){
    $conn = getConnection();
    $query = "UPDATE football_pitches SET name = '$name', time_start = '$time_start', time_end = '$time_end', description = '$description', price_per_hour = '$price_per_hour', price_per_peak_hour = '$price_per_peak_hour', is_maintenance = '$is_maintenance', pitch_type_id = '$pitch_type_id', updated_at = '$updated_at' WHERE id = '$id'";
    if ($conn->query($query) === false) {
        
    }
    $conn->close();
}

function DelId($id){
    $conn = getConnection();
    $query = "DELETE FROM football_pitches WHERE id = '$id'";
    if ($conn->query($query) === false) {
        
    }
    $conn->close();
}
?>
