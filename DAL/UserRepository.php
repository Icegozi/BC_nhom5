<?php
require_once __DIR__ . '/connect_database.php';

class UserRepository {
    private $conn;

    public function __construct() {
        $this->conn = getConnection();
    }

    public function findUserByEmail($email) {
        $sql = "SELECT id, password, type FROM users WHERE email=?";
        
        // Sử dụng prepared statement để tránh SQL Injection
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        // Lấy thông tin người dùng
        $user = $result->fetch_assoc();
        
        // Đóng statement và trả về kết quả
        $stmt->close();
        return $user;
    }
}