<?php
    require_once '../DAL/orderData.php';
    require_once '../BLL/utils.php';
    require_once '../DAL/bankData.php';
    require_once '../DAL/pichesData.php';
    require_once '../DAL/peakHoursData.php';
    require_once '../DAL/codeData.php';
    
    function getTimeOrder($id_user, $id_pitch) {
        $r = getTimeOrderById($id_user, $id_pitch);
        return $r['order_count'];
    }

    function createNewOrder($pitch_id, $user_id, $date, $start_time, $end_time, $name, $phone, $email, $price_perhour, $price_perpeak, $code) {
        # get total, desposited
        $peakhours = getPeakHours();
        $total = calculatePrice($price_perhour, $price_perhour, $peakhours, $start_time, $end_time);
        if ($code) {
            $codes = getDiscountData();
            if (count($codes) > 0) {
                foreach ($codes as $c) {
                    if ($code == $c['code']) {
                        $amount = $total * (100 - $c['amount']) / 100;
                        if ($amount > $c['usage_limit']) {
                            $total = $total - $c['usage_limit'];
                        }
                        else {
                            $total = $total - $amount;
                        }
                        break;
                    }
                } 
            }
        }

        $deposit = floor($total * 0.4);
        # format datetime
        $start_time = formatDateTime($date, $start_time);
        $end_time = formatDateTime($date, $end_time);
        $note = "Tien coc " . $pitch_id . $user_id . $start_time;
        $status = 1;
        if (checkTimeOrderById($pitch_id, $start_time, $end_time)) {
            $rr = createNewOrderData($pitch_id, $user_id, $name, $phone, $deposit, $code, $start_time, $end_time, $total, $status, $email, $note);
            return $rr;
        }
        else {
            return false;
        }
    }

    function getOrder($order_id) {
        $arr = getOrderById($order_id);
        return $arr;
    }
    
    function getBill() {
        $infor_bank = getBankData();
        return $infor_bank;
    }
?>