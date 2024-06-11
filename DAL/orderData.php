<?php
    function checkTimeOrder($pitch_id, $start_time, $end_time) {
        $conn = getConnection();
        $stmt = $conn->prepare("SELECT COUNT(*) as count FROM orders WHERE pitch_id = ? AND (start_at < ? AND end_at > ?)");
        $stmt->bind_param('iss', $pitch_id, $start_time, $end_time);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        $conn->close();
        return $row['count'] == 0;
    }

    function createNewOrder($pitch_id, $name=null, $start_time, $end_time, $total, $status, $byuser_id, $phone=null, $email=null, $deposit, $code, $note=null, $user_id=null, $create_at=null) {
        $conn = getConnection();

        # tự tăng id
        $re = $conn->query("SELECT MAX(id) as max_id FROM orders");
        $row = $re->fetch_assoc();
        $max_id = $row['max_id'];
        if ($max_id) {
            $id = (int)$max_id + 1;
        }
        else {
            $id = 1;
        }

        # tạo bản ghi mới
        $stmt = $conn->prepare("INSERT INTO orders (name, phone, email, code, start_at, end_at) VALUE (?, ?, ?, ?, ?)");
        $stmt->bind_param('issss');
        if ($stmt->execute()) {
            $stmt->close();
            $conn->close();
            return true;
        }
        else {
            $stmt->close();
            $conn->close();
            return false;
        }
    }