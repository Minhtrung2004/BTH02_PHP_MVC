<?php
require_once('C:/xampp/htdocs/BTH02_PHP_MVC/core/Connection.php');

$category_id = isset($_GET['category_id']) ? $_GET['category_id'] : null;

$pdo = connectionDatabase($servername, $username, $password, $dbname);

if ($category_id) {
    $stmt = $pdo->prepare("SELECT * FROM news WHERE category_id = :category_id LIMIT 10");
    $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
    $stmt->execute();
    $news = $stmt->fetchAll();
} else {
    $stmt = $pdo->query("SELECT * FROM news limit 0");
    $news = $stmt->fetchAll();
}

$stmt = $pdo->query("SELECT * FROM categories");
$categories = $stmt->fetchAll();



?>
<?php foreach ($news as $new) { ?>
<div class="col-12">
    <div class="row g-4 align-items-center">
        <div class="col-5">
            <div class="overflow-hidden rounded">
                <img src="./public/img/<?php echo $new['image']; ?>" class="img-zoomin img-fluid rounded w-100" alt="">
            </div>
        </div>
        <div class="col-7">
            <div class="features-content d-flex flex-column">
                <a href="#" class="h6"><?php echo $new['title']; ?></a>
                <small><i class="fa fa-clock"> <?php echo $new['content']; ?></i></small>
                <small><i class="fa fa-eye"> <?php echo $new['id']; ?></i></small>
            </div>
        </div>
    </div>
</div>
<?php } ?>