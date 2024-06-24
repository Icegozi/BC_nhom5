<?php
session_start();
require_once __DIR__ . '/../BLL/pitchService.php';
require_once __DIR__ . '/../BLL/orderService.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['submit'])) {
        $date = trim( $_POST['date']);
        $start_time = trim($_POST['start_time']);
        $end_time = trim($_POST['end_time']);
        $namee = trim(htmlspecialchars($_POST['name']));
        $namee = formatStandard($namee);
        $sdt = htmlspecialchars(trim($_POST['phone']));
        $email = isset($_POST['email']) ? htmlspecialchars(trim($_POST['email'])) : null;
        $code = isset($_POST['code']) ? htmlspecialchars(trim($_POST['code'])) : null;
        $pitch_details_id = trim($_POST['pitch_details_id']);
        $price_perhour = trim($_POST['price_perhour']);
        $price_perpeak = trim($_POST['price_perpeak']);
        
        if (!$namee) {
            echo "<script type='text/javascript'>alert('Tên không được chứa ký tự đặc biệt');window.location.replace('pitchDetail.php');</script>";
            exit;
        }

        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
        } else {
            $user_id = 1;
        }
        
        try {
            $re = createNewOrder($pitch_details_id, $user_id, $date, $start_time, $end_time, $namee, $sdt, $email, $price_perhour, $price_perpeak, $code);
            if ($re) {
                $_SESSION["order_id"] = $re;
                $_SESSION["pitch_id"] = $pitch_details_id;
                $_SESSION["name_pitch"] = $name;
                $_SESSION["quantity_pitch"] = $volume;
                $_SESSION["name_user"] = $namee;
                $_SESSION["phone"] = $sdt;
                $_SESSION["email"] = $email;
                $_SESSION["start_time"] = formatDateTime($date, $start_time);
                $_SESSION["end_time"] = formatDateTime($date, $end_time);
                header("Location: order.php");
                exit();
            } else {
                echo "<script type='text/javascript'>alert('Đặt không thành công'); window.location.replace('pitchDetail.php');</script>";
            }
        } catch (Exception $e) {
            echo "<script type='text/javascript'>alert('Message: " . $e->getMessage() . "'); window.location.replace('pitchDetail.php');</script>";
        }
    } else {
        
    }
}