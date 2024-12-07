<?php
require_once __DIR__ . '/../../../core/Connection.php';


class NewsController
{
    private $newsModel;

    public function __construct($dbConnection)
    {
        $this->newsModel = new NewsModel($dbConnection);
    }

    // Hàm xóa tin tức
    public function delete($id)
    {
        if ($this->newsModel->deleteNews($id)) {
            header('Location: /views/admin/news/index.php?status=success');
        } else {
            header('Location: /views/admin/news/index.php?status=error');
        }
        exit;
    }

    // Hàm hiển thị danh sách
    public function index()
    {
        $results = $this->newsModel->getAllNews();
        require_once __DIR__ . '/../views/admin/news/index.php';
    }
}
