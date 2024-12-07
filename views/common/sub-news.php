<?php foreach ($articles as $article) { ?>
    <div class="col-12">
        <div class="row g-4 align-items-center">
            <div class="col-5">
                <div class="overflow-hidden rounded">
                    <img src="./public/img/<?php echo $article['image']; ?>" class="img-zoomin img-fluid rounded w-100" alt="">
                </div>
            </div>
            <div class="col-7">
                <div class="features-content d-flex flex-column">
                    <a href="#" class="h6"><?php echo $article['title']; ?></a>
                    <small><i class="fa fa-clock"> <?php echo $article['content']; ?></i></small>
                    <small><i class="fa fa-eye"> <?php echo $article['id']; ?></i></small>
                </div>
            </div>
        </div>
    </div>
<?php } ?>