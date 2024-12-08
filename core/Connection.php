<?php

class Connection
{
    private static $instance = null;
    private $connection;

    private function __construct()
    {
        $host = 'localhost';
        $db = 'tintuc';
        $user = 'root';
        $pass = 'root';

        try {
            $this->connection = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection()
    {
        return $this->connection;
    }
}
<<<<<<< HEAD

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "tintuc";


$conn = connectionDatabase($severname, $username, $password, $dbname);
$conn = null;
?>
=======
>>>>>>> bd5f8a5 (CRUD)
