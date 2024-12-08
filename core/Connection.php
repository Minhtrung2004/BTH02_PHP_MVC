<?php

class Connection
{
    private static $instance = null;
    private $connection;

    private function __construct()
    {
        $host = '127.0.0.1';
        $db = 'tintuc';
        $user = 'leduc';
        $pass = 'password';

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
