<?php

require '../controller/NewsController.php';
$controller = new NewsController();

$action = $_GET['action'] ?? 'index';
$id = $_GET['id'] ?? null;

switch ($action) {
    case 'index':
        $page = $_GET['page'] ?? 1;
        $controller->index($page);
        break;

    case 'create':
        $controller->create();
        break;

    case 'store':
        $data = [
            'title' => $_POST['title'],
            'content' => $_POST['content'],
            'image' => $_POST['image'],
            'category_id' => $_POST['category_id']
        ];
        $controller->store($data);
        break;

    case 'edit':
        $controller->edit($id);
        break;

    case 'update':
        $data = [
            'title' => $_POST['title'],
            'content' => $_POST['content'],
            'image' => $_POST['image'],
            'category_id' => $_POST['category_id']
        ];
        $controller->update($id, $data);
        break;

    case 'delete':
        $controller->delete($id);
        break;

    default:
        echo "404 Not Found";
        break;
}
