<?php

class NewsModel
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getAllNews($limit, $offset)
    {
        $sql = "SELECT * FROM news LIMIT :limit OFFSET :offset";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTotalNews()
    {
        $sql = "SELECT COUNT(*) as total FROM news";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    public function getNewsById($id)
    {
        $sql = "SELECT * FROM news WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createNews($data)
    {
        $sql = "INSERT INTO news (title, content, image, category_id, created_at) VALUES (:title, :content, :image, :category_id, NOW())";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($data);
    }

    public function updateNews($id, $data)
    {
        $sql = "UPDATE news SET title = :title, content = :content, image = :image, category_id = :category_id WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $data['id'] = $id;
        return $stmt->execute($data);
    }

    public function deleteNews($id)
    {
        $sql = "DELETE FROM news WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
