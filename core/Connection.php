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

<?php
// class Connection
// {
// private static $instance = null;
// private $connection;

// private function __construct()
// {
// $host = 'localhost';
// $db = 'tintuc';
// $user = 'root';
// $pass = 'root';

// try {
// $this->connection = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
// $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// } catch (PDOException $e) {
// die("Connection failed: " . $e->getMessage());
// }
// }

// public static function getInstance()
// {
// if (self::$instance === null) {
// self::$instance = new self();
// }
// return self::$instance;
// }

// public function getConnection()
// {
// return $this->connection;
// }
// }
// >>>>>>> bd5f8a5a0f0fa0397132d45f9c312b019d8c7b44
?>