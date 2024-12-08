<?php
// models/User.php

class User {

    private $db;

    public function __construct() {
        // Kết nối với database
        $this->db = new PDO('mysql:host=localhost;dbname=tintuc', 'leduc', 'password'); // Cập nhật với thông tin DB của bạn
    }

    // Lấy thông tin người dùng theo username
    public function getUserByUsername($username) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = :username LIMIT 1");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
