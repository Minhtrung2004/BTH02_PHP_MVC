<?php
require '../core/Connection.php';
require '../views/admin/news/index.php';


class NewsController
{
    private $newsModel;

    public function __construct()
    {
        $dbConnection = Connection::getInstance()->getConnection();
        $this->newsModel = new NewsModel($dbConnection);
    }

    public function index($page = 1, $limit = 12)
    {
        $offset = ($page - 1) * $limit;
        $news = $this->newsModel->getAllNews($limit, $offset);
        $total = $this->newsModel->getTotalNews();
        include __DIR__ . '/../views/admin/news/index.php';
    }

    public function create()
    {
        include __DIR__ . '/../views/admin/news/create.php';
    }

    public function store($data)
    {
        $this->newsModel->createNews($data);
        header('Location: /views/admin/news/index.php');
        exit;
    }

    public function edit($id)
    {
        $news = $this->newsModel->getNewsById($id);
        include __DIR__ . '/../views/admin/news/edit.php';
    }

    public function update($id, $data)
    {
        $this->newsModel->updateNews($id, $data);
        header('Location: /views/admin/news/index.php');
        exit;
    }

    public function delete($id)
    {
        $this->newsModel->deleteNews($id);
        header('Location: /views/admin/news/index.php');
        exit;
    }
}
