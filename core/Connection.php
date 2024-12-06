<?php
function connectionDatabase($servername, $username, $password, $dbname)
{
    try {
        // Chuỗi kết nối chính xác
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

        // Thiết lập chế độ báo lỗi
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        // Thông báo lỗi chi tiết
        echo "Connection failed: " . $e->getMessage();
        return null; // Trả về null nếu không kết nối được
    }
}

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "tintuc";


$conn = connectionDatabase($servername, $username, $password, $dbname);

// if ($conn) {
//     echo "Kết nối thành công!";
//     // Đóng kết nối
//     $conn = null;
// } else {
//     echo "Kết nối thất bại.";
// }
?>
