<?php
    require_once '../DAL/pichesData.php';
    require_once '../DAL/pitchDetailsData.php';

    function getPitch($id) {
        $pitch = getPitchById($id);
        return $pitch;
    }

    function getPichesDetails($id) {
        $images = getPitchDetailsById($id);
        return $images;
    }

    
?>