<?php
function connectionDatabase($servername, $username, $password, $dbname)
{
    try {
        // Kết nối cơ sở dữ liệu
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        die("Kết nối thất bại: " . $e->getMessage());
    }
}

$servername = "localhost";
$username = "root";
$password = "123456";
$dbname = "tintuc";

try {
    $conn = connectionDatabase($servername, $username, $password, $dbname);
    echo "Kết nối thành công!";
} catch (PDOException $e) {
    echo "Lỗi: " . $e->getMessage();
} finally {
    $conn = null;
}
?>