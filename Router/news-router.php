<?php
// Kết nối tới Controller
require_once __DIR__ . '/../controller/NewsController.php';
require_once __DIR__ . '/../core/Connection.php';

// Tạo kết nối cơ sở dữ liệu
$dbConnection = $conn;
$newsController = new NewsController($dbConnection);

// Phân loại action từ URL
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    switch ($action) {
        case 'delete':
            if (isset($_GET['id'])) {
                $id = intval($_GET['id']); // Đảm bảo `id` là số nguyên
                $newsController->delete($id);
            } else {
                header('Location: /views/admin/news/index.php?status=error');
            }
            exit;
        case 'index':
        default:
            $newsController->index();
            exit;
    }
} else {
    $newsController->index();
}
