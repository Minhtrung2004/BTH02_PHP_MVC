<?php
function connectionDatabase($servername, $username, $password, $dbname)
{
    try {
        // Kết nối cơ sở dữ liệu
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        // Thông báo lỗi và kết thúc chương trình
        die("Kết nối thất bại: " . $e->getMessage());
    }
}

// Cấu hình cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tintuc";

?>