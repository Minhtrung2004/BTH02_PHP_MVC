<?php
require_once('C:/xampp/htdocs/BTH02_PHP_MVC/core/Connection.php');

// Nhận từ khóa tìm kiếm
$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : null;

// Kết nối cơ sở dữ liệu bằng PDO
$pdo = connectionDatabase($servername, $username, $password, $dbname);


// Nếu có từ khóa tìm kiếm
if ($keyword) {
    // Truy vấn tìm kiếm
    $stmt = $pdo->prepare("
        SELECT news.id, news.title, news.content, news.image, news.created_at, categories.name AS category_name
        FROM news
        INNER JOIN categories ON news.category_id = categories.id
        WHERE news.title LIKE :keyword OR news.content LIKE :keyword
        ORDER BY news.created_at DESC
    ");
    $searchKeyword = '%' . $keyword . '%';
    $stmt->bindParam(':keyword', $searchKeyword, PDO::PARAM_STR);
    $stmt->execute();
    $news = $stmt->fetchAll();
} else {
    $news = [];
}

$stmt = $pdo->query("SELECT * FROM categories");
$categories = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Kết quả tìm kiếm</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@100;600;800&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="../../public/lib/animate/animate.min.css" rel="stylesheet">
    <link href="../../public/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">


    <!-- Customized Bootstrap Stylesheet -->
    <link href="../../public/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../../public/css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Navbar start -->
    <div class="container-fluid sticky-top px-0">
        <div class="container-fluid topbar bg-dark d-none d-lg-block">
            <div class="container px-0">
                <div class="topbar-top d-flex justify-content-between flex-lg-wrap">
                    <div class="top-info flex-grow-0">
                        <span class="rounded-circle btn-sm-square bg-primary me-2">
                            <i class="fas fa-bolt text-white"></i>
                        </span>
                        <div class="pe-2 me-3 border-end border-white d-flex align-items-center">
                            <p class="mb-0 text-white fs-6 fw-normal">Trending</p>
                        </div>
                        <div class="overflow-hidden" style="width: 735px;">
                            <div id="note" class="ps-2">
                                <a href="#">
                                    <p class="text-white mb-0 link-hover">Vì Một Việt Nam Sạch, Xanh: Chúng Ta Đã Làm
                                        Gì?</p>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="top-link flex-lg-wrap">
                        <i class="fas fa-calendar-alt text-white border-end border-secondary pe-2 me-2"> <span
                                class="text-body">Monday, Dec 09, 2024</span></i>
                        <div class="d-flex icon">
                            <p class="mb-0 text-white me-2">Follow Us:</p>
                            <a href="" class="me-2"><i class="fab fa-facebook-f text-body link-hover"></i></a>
                            <a href="" class="me-2"><i class="fab fa-twitter text-body link-hover"></i></a>
                            <a href="" class="me-2"><i class="fab fa-instagram text-body link-hover"></i></a>
                            <a href="" class="me-2"><i class="fab fa-youtube text-body link-hover"></i></a>
                            <a href="" class="me-2"><i class="fab fa-linkedin-in text-body link-hover"></i></a>
                            <a href="" class="me-2"><i class="fab fa-skype text-body link-hover"></i></a>
                            <a href="" class=""><i class="fab fa-pinterest-p text-body link-hover"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid bg-light">
            <div class="container px-0">
                <nav class="navbar navbar-light navbar-expand-xl">
                    <a href="../../index.php" class="navbar-brand mt-3">
                        <p class="text-primary display-6 mb-2" style="line-height: 0;">Newsers</p>
                        <small class="text-body fw-normal" style="letter-spacing: 12px;">Nespaper</small>
                    </a>
                    <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarCollapse">
                        <span class="fa fa-bars text-primary"></span>
                    </button>
                    <div class="collapse navbar-collapse bg-light py-3" id="navbarCollapse">
                        <div class="navbar-nav mx-auto border-top">
                            <a href="../../index.php" class="nav-item nav-link">Home</a>
                            <a href="./detail.php" class="nav-item nav-link">Detail Page</a>
                        </div>
                        <div class="d-flex flex-nowrap border-top pt-3 pt-xl-0">
                            <div class="d-flex">
                                <img src="../../public/img/weather-icon.png" class="img-fluid w-100 me-2" alt="">
                                <div class="d-flex align-items-center">
                                    <strong class="fs-4 text-secondary">25°C</strong>
                                    <div class="d-flex flex-column ms-2" style="width: 150px;">
                                        <span class="text-body">Ha Noi,</span>
                                        <small>Monday, Dec 09, 2024</small>
                                    </div>
                                </div>
                            </div>
                            <button
                                class="btn-search btn border border-primary btn-md-square rounded-circle bg-white my-auto"
                                data-bs-toggle="modal" data-bs-target="#searchModal"><i
                                    class="fas fa-search text-primary"></i></button>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- Navbar End -->

    <!-- Modal Search Start -->
    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="searchModalLabel">Tìm kiếm</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form gửi từ khóa tìm kiếm -->
                    <form action="../home/search.php" method="GET">
                        <input type="text" name="keyword" class="form-control" placeholder="Nhập từ khóa tìm kiếm..."
                            required>
                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary w-100">Tìm kiếm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <h1 class="text-center" style="color: rgb(84, 103, 173);">
            Kết quả tìm kiếm cho từ khóa: "<?php echo htmlspecialchars($_GET['keyword']); ?>"
        </h1>
        <?php if (!empty($news)): ?>
        <div class="row">
            <?php foreach ($news as $row): ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <!-- Sử dụng h-100 để card chiếm hết chiều cao của col -->
                    <img src="../../public/img/<?php echo htmlspecialchars($row['image']); ?>" class="card-img-top"
                        alt="<?php echo htmlspecialchars($row['title']); ?>">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title"><?php echo htmlspecialchars($row['title']); ?></h5>
                        <p class="card-text"><?php echo substr(htmlspecialchars($row['content']), 0, 100); ?>...</p>
                        <p class="card-text"><small class="text-muted">Danh mục:
                                <?php echo htmlspecialchars($row['category_name']); ?></small></p>
                        <a href="detailPage.php?id=<?php echo $row['id']; ?>" class="btn btn-primary mt-auto">Đọc
                            thêm</a> <!-- Sử dụng mt-auto để đẩy nút "Đọc thêm" xuống dưới cùng -->
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
        <p>Không tìm thấy kết quả nào.</p>
        <?php endif; ?>
    </div>



    <!-- Footer Start -->
    <div class="container-fluid bg-dark footer py-5">
        <div class="container py-5">
            <div class="pb-4 mb-4" style="border-bottom: 1px solid rgba(255, 255, 255, 0.2);">
                <div class="row g-4">
                    <div class="col-lg-3">
                        <a href="#" class="d-flex flex-column flex-wrap">
                            <p class="text-white mb-0 display-6">Newsers</p>
                            <small class="text-light" style="letter-spacing: 11px; line-height: 0;">Newspaper</small>
                        </a>
                    </div>
                    <div class="col-lg-9">
                        <div class="d-flex position-relative rounded-pill overflow-hidden">


                        </div>
                    </div>
                </div>
            </div>
            <div class="row g-5">
                <div class="col-lg-6 col-xl-3">
                    <div class="footer-item-1">
                        <h4 class="mb-4 text-white">Get In Touch</h4>
                        <p class="text-secondary line-h">Address: <span class="text-white">175 Tay Son, Dong Da, Ha
                                Noi</span>
                        </p>
                        <p class="text-secondary line-h">Email: <span class="text-white">Example@gmail.com</span></p>
                        <p class="text-secondary line-h">Phone: <span class="text-white">0123456789</span></p>
                        <div class="d-flex line-h">
                            <a class="btn btn-light me-2 btn-md-square rounded-circle" href=""><i
                                    class="fab fa-twitter text-dark"></i></a>
                            <a class="btn btn-light me-2 btn-md-square rounded-circle" href=""><i
                                    class="fab fa-facebook-f text-dark"></i></a>
                            <a class="btn btn-light me-2 btn-md-square rounded-circle" href=""><i
                                    class="fab fa-youtube text-dark"></i></a>
                            <a class="btn btn-light btn-md-square rounded-circle" href=""><i
                                    class="fab fa-linkedin-in text-dark"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-3">
                    <div class="d-flex flex-column text-start footer-item-3">
                        <h4 class="mb-4 text-white">Categories</h4>
                        <?php foreach($categories as $n): ?>
                        <p class="btn-link text-white" href=""><i class="fas fa-angle-right text-white me-2"></i>
                            <?php echo $n['name'];?></p>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-3">
                    <div class="footer-item-4">
                        <h4 class="mb-4 text-white">Our Gallary</h4>
                        <div class="row g-2">
                            <div class="col-4">
                                <div class="rounded overflow-hidden">
                                    <img src="../../public/img/footer-1.jpg" class="img-zoomin img-fluid rounded w-100"
                                        alt="">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="rounded overflow-hidden">
                                    <img src="../../public/img/footer-2.jpg" class="img-zoomin img-fluid rounded w-100"
                                        alt="">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="rounded overflow-hidden">
                                    <img src="../../public/img/footer-3.jpg" class="img-zoomin img-fluid rounded w-100"
                                        alt="">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="rounded overflow-hidden">
                                    <img src="../../public/img/footer-4.jpg" class="img-zoomin img-fluid rounded w-100"
                                        alt="">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="rounded overflow-hidden">
                                    <img src="../../public/img/footer-5.jpg" class="img-zoomin img-fluid rounded w-100"
                                        alt="">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="rounded overflow-hidden">
                                    <img src="../../public/img/footer-6.jpg" class="img-zoomin img-fluid rounded w-100"
                                        alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Copyright Start -->
    <div class="container-fluid copyright bg-dark py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <span class="text-light"><a href="#"><i class="fas fa-copyright text-light me-2"></i>Your Site
                            Name</a>, All right reserved.</span>
                </div>
                <div class="col-md-6 my-auto text-center text-md-end text-white">
                    Designed By <a class="border-bottom" href="https://htmlcodex.com">HTML Codex</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Copyright End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary border-2 border-white rounded-circle back-to-top"><i
            class="fa fa-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../public/lib/easing/easing.min.js"></script>
    <script src="../../public/lib/waypoints/waypoints.min.js"></script>
    <script src="../../public/lib/owlcarousel/owl.carousel.min.js"></script>

    <script src="../../public/js/main.js"></script>
</body>

</html>