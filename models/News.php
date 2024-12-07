<?php
class NewsModel
{
    private $conn;

    public function __construct($dbConnection)
    {
        $this->conn = $dbConnection;
    }

    // Hàm xóa tin tức
    public function deleteNews($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM news WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }

    // Lấy tất cả tin tức
    public function getAllNews()
    {
        $stmt = $this->conn->prepare("SELECT * FROM news");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
