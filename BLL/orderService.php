<?php
    require_once './DAL/connect_database.php';
    require_once './DAL/orderData.php';
    require_once './BLL/utils.php';


    function createNewOrder($pitch_id, $date, $start_time, $end_time, $name, $phone, $email) {
        # format datetime
        $start_time = formatDateTime($date, $start_time);
        $end_time = formatDateTime($date, $end_time);

        if (checkTimeOrder($pitch_id, $start_time, $end_time)) {
            
            # tính tiền
            

        }
        else {
            return 'Thời gian đã được đặt';
        }
        
        
    }