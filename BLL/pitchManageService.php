<?php
    require_once __DIR__ . '/../DAL/pitchManageData.php';
    require_once __DIR__ . '/../DAL/connect_database.php';
    require_once __DIR__ .'/../MODEL/football_pitches_model.php';
    function getDataPitchforTable() {
        $result = [];
        $result= getDataPitch();
        return $result;
    }
    function checkAddingPitch( $name, $time_start, $time_end, $description, $price_per_hour, $price_per_peak_hour, $is_maintenance, $pitch_type_id, $created_at, $updated_at){
        $conn = getConnection();  
        
        
        AddPitchToData( $name, $time_start, $time_end, $description, $price_per_hour, $price_per_peak_hour, $is_maintenance, $pitch_type_id, $created_at, $updated_at);
        
        $conn->close();   
        
    }
    function checkUpdatePitch($id, $name, $time_start, $time_end, $description, $price_per_hour, $price_per_peak_hour, $is_maintenance, $pitch_type_id,  $updated_at){
        $conn = getConnection();
        if(!isset($id)||!isset($name)||!isset($time_start)||!isset($time_end)||!isset($description)||!isset($price_per_hour)||!isset($price_per_peak_hour)||!isset($is_maintenance)){
            echo 'Thông tin điền vào bị thiếu';
        }
        $query = "SELECT * FROM football_pitches";
        $result = $conn->query($query);
        while($row = $result->fetch_assoc()){
            if($id== $row["id"]){
               UpdatePitch($id, $name, $time_start, $time_end, $description, $price_per_hour, $price_per_peak_hour, $is_maintenance, $pitch_type_id,  $updated_at);
                    
                
             }
          }
          $conn->close();
    }
    function checkDelete($id){
        $conn = getConnection();
        $query = "SELECT * FROM football_pitches";
        $result = $conn->query($query);
        while($row = $result->fetch_assoc()) {
            if($id===$row["id"]){
                DelId($id);
            }
        }
    }
    