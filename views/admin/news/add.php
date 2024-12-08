<?php
require '../../../core/Connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy thông tin từ form
    $title = $_POST['title'];
    $content = $_POST['content'];
    $image = $_POST['image'];
    $category_id = $_POST['category_id'];

    try {
        // Kết nối tới cơ sở dữ liệu
        $dbConnection = Connection::getInstance()->getConnection();
        

        // Insert dữ liệu
        $sql = "INSERT INTO news (title, content, image, created_at, category_id) 
                VALUES (:title, :content, :image, NOW(), :category_id)";

        $stmt = $dbConnection->prepare($sql);

        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);

        $stmt->execute();

        header("Location: ../news-list.php"); // Chỉ hướng sau khi thêm tin tức thành công
        exit();
    } catch (PDOException $e) {
        die("Database error: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Add News</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2>Thêm tin tức mới</h2>
        <form method="POST" action="add-news.php">
            <div class="form-group">
                <label for="title">Tiêu đề</label>
                <input type="text" class="form-control" name="title" id="title" required>
            </div>
            <div class="form-group">
                <label for="content">Nội dung</label>
                <textarea class="form-control" name="content" id="content" rows="5" required></textarea>
            </div>
            <div class="form-group">
                <label for="image">URL hình ảnh</label>
                <input type="url" class="form-control" name="image" id="image" required>
            </div>
            <div class="form-group">
                <label for="category_id">Category ID</label>
                <input type="number" class="form-control" name="category_id" id="category_id" min="1" required>
            </div>
            <button type="submit" class="btn btn-primary">Thêm tin tức</button>
        </form>
    </div>
</body>

</html>