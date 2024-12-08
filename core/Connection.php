<?php
class Connection
{
    private static $instance = null;
    private $conn;

    // Hàm khởi tạo (Constructor) để kết nối với CSDL
    private function __construct($servername, $username, $password, $dbname)
    {
        try {
            $this->conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Kết nối thất bại: " . $e->getMessage());
        }
    }

    // Hàm lấy đối tượng kết nối, nếu chưa có thì tạo mới
    public static function getInstance()
    {
        if (self::$instance === null) {
            // Cấu hình cơ sở dữ liệu
            $servername = "localhost";
            $username = "leduc";
            $password = "password";
            $dbname = "tintuc";

            self::$instance = new Connection($servername, $username, $password, $dbname);
        }
        return self::$instance;
    }

    // Phương thức để lấy đối tượng kết nối
    public function getConnection()
    {
        return $this->conn;
    }
}
?>
