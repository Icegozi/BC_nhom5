<?php
    require_once '../DAL/connect_database.php';

    function getTimeOrderById($id_user, $id_pitch) {
        $conn = getConnection();
        $stmt = $conn->prepare("SELECT COUNT(*) as order_count FROM orders WHERE user_id = ? AND football_pitch_id = ?");
        $stmt->bind_param('ii', $id_user, $id_pitch);
        $row = null;
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
        }
        $stmt->close();
        $conn->close();
        return $row;
    }

    function checkTimeOrderById($pitch_id, $start_time, $end_time) {
        $conn = getConnection();
        $stmt = $conn->prepare("SELECT COUNT(*) as count FROM orders WHERE football_pitch_id = ? AND (start_at < ? AND end_at > ?)");
        $stmt->bind_param('iss', $pitch_id, $start_time, $end_time);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        $conn->close();
        return ($row['count'] == 0);
    }

    function createNewOrderData($pitch_id, $user_id, $name, $phone, $deposit, $code, $start_time, $end_time, $total, $status, $email=null, $note=null, $create_at=null) {
        $conn = getConnection();
        $id = null;
        $created_at = null;
        # tạo bản ghi mới
        if ($code == null) {
            $code = NULL;
        }
        $stmt = $conn->prepare("INSERT INTO orders (id, name, phone, email, deposit, code, start_at, end_at, total, status, note, user_id, football_pitch_id, created_at) VALUES (?, ?, ?, ?, ? , ? , ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('isssdsssdisiis', $id, $name, $phone, $email, $deposit, $code, $start_time, $end_time, $total, $status, $note, $user_id, $pitch_id, $created_at);
        if ($stmt->execute()) {
            $stmt->close();
            
            $checkStmt = $conn->prepare("SELECT id FROM orders WHERE start_at = ? AND end_at = ? AND user_id = ? AND football_pitch_id = ?");
            $checkStmt->bind_param("ssii", $start_time, $end_time, $user_id, $pitch_id);
            if ($checkStmt->execute()) {
                $re = $checkStmt->get_result();
                if ($re->num_rows == 0) {
                    return 0;
                }
                else {
                    $r = $re->fetch_assoc();
                    $id = $r["id"];
                }
            }
            $checkStmt->close();
            $conn->close();
            return $id;
        }
        else {
            $stmt->close();
            $conn->close();
            return false;
        }
    }

    function getStatusOrderById($order_id) {
        $conn = getConnection();
        $result = $conn->query("SELECT status FROM orders WHERE order_id = $order_id");
        $row = $result->fetch_assoc();
        $conn->close();
        return $row["status"];
    }

    function getOrderById($order_id) {
        $conn = getConnection();
        $re = $conn->query("SELECT * FROM orders WHERE id = $order_id");
        $r = $re->fetch_assoc();
        $conn->close();
        return $r;
    }
?>