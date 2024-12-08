<?php
// controllers/LoginController.php

require_once 'models/User.php';

class LoginController {

    public function showLoginForm() {
        // Hiển thị trang login
        include 'views/admin/login.php';
    }

    public function handleLogin() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lấy dữ liệu từ form
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Kiểm tra thông tin đăng nhập
            $userModel = new User();
            $user = $userModel->getUserByUsername($username);

            // Kiểm tra xem người dùng có tồn tại và mật khẩu đúng không
            if ($user && password_verify($password, $user['password'])) {
                // Đăng nhập thành công, lưu thông tin người dùng vào session
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];

                // Nếu người dùng là admin (role = 1), chuyển hướng đến trang admin
                if ($user['role'] == 1) {
                    header('Location: /admin/news/index.php');
                    exit(); // Chấm dứt script sau khi chuyển hướng
                } else {
                    // Nếu là người dùng bình thường, chuyển hướng đến trang dashboard
                    header('Location: /user/dashboard');
                    exit();
                }
            } else {
                // Đăng nhập thất bại, quay lại trang login với thông báo lỗi
                $error_message = 'Tài khoản hoặc mật khẩu không đúng!';
                include 'views/admin/login.php';
            }
        }
    }
}
