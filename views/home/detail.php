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
    $stmt = $pdo->query("SELECT * FROM news LIMIT 10");
    $news = $stmt->fetchAll();
}

$stmt = $pdo->query("SELECT * FROM categories");
$categories = $stmt->fetchAll();



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Newsers - Free HTML Magazine Template</title>
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
                                <img src="../../public/img/features-fashion.jpg"
                                    class="img-fluid rounded-circle border border-3 border-primary me-2"
                                    style="width: 30px; height: 30px;" alt="">
                                <a href="#">
                                    <p class="text-white mb-0 link-hover">Newsan unknown printer took a galley of type
                                        andscrambled Newsan.</p>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="top-link flex-lg-wrap">
                        <i class="fas fa-calendar-alt text-white border-end border-secondary pe-2 me-2"> <span
                                class="text-body">Tuesday, Sep 12, 2024</span></i>
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
                            <a href="detail-page.html" class="nav-item nav-link active">Detail Page</a>
                        </div>
                        <div class="d-flex flex-nowrap border-top pt-3 pt-xl-0">
                            <div class="d-flex">
                                <img src="../../public/img/weather-icon.png" class="img-fluid w-100 me-2" alt="">
                                <div class="d-flex align-items-center">
                                    <strong class="fs-4 text-secondary">31°C</strong>
                                    <div class="d-flex flex-column ms-2" style="width: 150px;">
                                        <span class="text-body">NEW YORK,</span>
                                        <small>Mon. 10 jun 2024</small>
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
    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content rounded-0">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Search by keyword</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex align-items-center">
                    <div class="input-group w-75 mx-auto d-flex">
                        <input type="search" class="form-control p-3" placeholder="keywords"
                            aria-describedby="search-icon-1">
                        <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Search End -->


    <!-- Single Product Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">

            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="mb-4">
                        <a href="#" class="h1 display-5">Tin tức mới nhất gần đây</a>
                    </div>
                    <div class="position-relative rounded overflow-hidden mb-3">
                        <img src="../../public/img/news-1.jpg" class="img-zoomin img-fluid rounded w-100" alt="">
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="#" class="text-dark link-hover me-3"><i class="fa fa-clock"></i> 06 minute read</a>
                        <a href="#" class="text-dark link-hover me-3"><i class="fa fa-eye"></i> 3.5k Views</a>
                        <a href="#" class="text-dark link-hover me-3"><i class="fa fa-comment-dots"></i> 05 Comment</a>
                        <a href="#" class="text-dark link-hover"><i class="fa fa-arrow-up"></i> 1.5k Share</a>
                    </div>
                    <p class="my-4">NVIDIA, công ty dẫn đầu về công nghệ AI và đồ họa, công bố kế hoạch xây dựng một
                        trung tâm
                        nghiên cứu và phát triển (R&D) tại Việt Nam. Đây được xem là bước đi chiến lược, góp phần thúc
                        đẩy
                        sự phát triển công nghệ và mở rộng hệ sinh thái AI tại khu vực Đông Nam Á
                    </p>
                    <p class="my-4">
                        NVIDIA công bố kế hoạch xây dựng trung tâm nghiên cứu và phát triển tại Việt Nam, mở ra cơ hội
                        lớn cho ngành công nghệ trong nước và khu vực
                    </p>
                    <div class="bg-light p-4 mb-4 rounded border-start border-3 border-primary">
                        <h1 class="mb-2">Những tin tức hay</h1>
                    </div>
                    <div class="row g-4">
                        <div class="col-6">
                            <div class="rounded overflow-hidden">
                                <img src="../../public/img/news-6.jpg" class="img-zoomin img-fluid rounded w-100"
                                    alt="">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="rounded overflow-hidden">
                                <img src="../../public/img/news-5.jpg" class="img-zoomin img-fluid rounded w-100"
                                    alt="">
                            </div>
                        </div>
                    </div>
                    <p class="my-4">Tượng Nữ thần Tự do là món quà của nước Pháp tặng Hoa Kỳ, chính thức được khánh
                        thành
                        vào ngày 28/10/1886. Tác phẩm cao 93m này tượng trưng cho tự do và dân chủ, với ngọn đuốc giơ
                        cao
                        tay phải mang ý nghĩa soi sáng nhân loại, và những xiềng xích bị phá vỡ dưới chân thể hiện sự
                        xóa bỏ nô lệ.
                        Tượng được xây dựng tại Pháp, sau đó vận chuyển đến Mỹ qua đường biển​
                    </p>
                    <p class="my-4">Có một bức tượng đá nổi bật của Abraham Lincoln, thể hiện hình ảnh ông khi còn trẻ,
                        cơ bắp và cởi trần.
                        Tượng này, được gọi là "Young Lincoln," hiện đang thu hút sự chú ý từ cộng đồng mạng và trở nên
                        viral.
                        Tượng được tạo ra vào năm 1939 bởi nghệ sĩ James Hansen, người đã sử dụng chính mình làm mẫu cho
                        hình ảnh này.
                        Bức tượng cho thấy một Lincoln trẻ, đứng với dáng vẻ thư giãn, với quần áo được kéo xuống, như
                        một mẫu hình thể thao.
                        Điều này đã gây ra rất nhiều phản ứng hài hước và lời khen từ cư dân mạng, khiến bức tượng thu
                        hút không ít sự chú ý, đặc biệt là từ các bình luận vui nhộn về ngoại hình "hấp dẫn" của ông
                    </p>
                    <div class="bg-light rounded my-4 p-4">
                        <h4 class="mb-4">You Might Also Like</h4>
                        <div class="row g-4">
                            <div class="col-lg-6">
                                <div class="d-flex align-items-center p-3 bg-white rounded">
                                    <img src="../../public/img/chatGPT.jpg" class="img-fluid rounded" alt="">
                                    <div class="ms-3">
                                        <a href="https://topdev.vn/blog/chat-gpt-la-gi/" class="h5 mb-2">Ứng dụng của
                                            chat gpt</a>
                                        <p class="text-dark mt-3 mb-0 me-3"><i class="fa fa-clock"></i> 06 minute read
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="d-flex align-items-center p-3 bg-white rounded">
                                    <img src="../../public/img/chatGPT-1.jpg" class="img-fluid rounded" alt="">
                                    <div class="ms-3">
                                        <a href="https://vi.wikipedia.org/wiki/Robot" class="h5 mb-2">Robot là gì ?</a>
                                        <p class="text-dark mt-3 mb-0 me-3"><i class="fa fa-clock"></i> 06 minute read
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-light rounded p-4">
                        <h4 class="mb-4">Comments</h4>
                        <div class="p-4 bg-white rounded mb-4">
                            <div class="row g-4">
                                <div class="col-3">
                                    <img src="../../public/img/footer-4.jpg" class="img-fluid rounded-circle w-100"
                                        alt="">
                                </div>
                                <div class="col-9">
                                    <div class="d-flex justify-content-between">
                                        <h5>Minh Trung</h5>
                                    </div>
                                    <small class="text-body d-block mb-3"><i class="fas fa-calendar-alt me-1"></i> Dec
                                        9, 2024</small>
                                    <p class="mb-0">Tin tức thật hay!
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="p-4 bg-white rounded mb-0">
                            <div class="row g-4">
                                <div class="col-3">
                                    <img src="../../public/img/footer-4.jpg" class="img-fluid rounded-circle w-100"
                                        alt="">
                                </div>
                                <div class="col-9">
                                    <div class="d-flex justify-content-between">
                                        <h5>Thanh Tú</h5>
                                    </div>
                                    <small class="text-body d-block mb-3"><i class="fas fa-calendar-alt me-1"></i> Dec
                                        9, 2024</small>
                                    <p class="mb-0">Thông tin hữu ích!
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="row g-4">
                        <div class="col-12">
                            <div class="p-3 rounded border">
                                <div class="input-group w-100 mx-auto d-flex mb-4">
                                </div>
                                <h4 class="mb-4">Popular Categories</h4>
                                <?php foreach($categories as $n):?>
                                <div class="row g-2">
                                    <div class="col-12 mb-2">
                                        <button
                                            class="link-hover btn btn-light w-100 rounded text-uppercase text-dark py-3">
                                            <a href="?category_id=<?php echo $n['id']; ?>"
                                                class="text-dark text-decoration-none">
                                                <p class="card-text"><?php echo $n['name']; ?></p>
                                            </a>
                                        </button>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                                <h4 class="my-4">News By Popular Categories</h4>
                                <?php foreach($news as $n): ?>
                                <div class="row g-4">
                                    <div class="col-12">
                                        <div class="row g-4 align-items-center features-item">
                                            <div class="col-4 mb-2">
                                                <div class="rounded-circle position-relative">
                                                    <div class="overflow-hidden rounded-circle">
                                                        <img src="../../public/img/<?php echo $n['image'];?>"
                                                            class="img-zoomin img-fluid rounded-circle w-100" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-8">
                                                <div class="features-content d-flex flex-column">
                                                    <p class="text-uppercase mb-2"><?php echo $n['title']; ?></p>
                                                    <a href="detailPage.php?id=<?php echo $n['id']; ?>"
                                                        class="h6"><?php echo $n['content']; ?></a>
                                                    <small class="text-body d-block">
                                                        <i class="fas fa-calendar-alt me-1"></i>
                                                        <?php echo $n['created_at']; ?>
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>

                                <h4 class="my-4">Stay Connected</h4>
                                <div class="row g-4">
                                    <div class="col-12">
                                        <a href="#"
                                            class="w-100 rounded btn btn-primary d-flex align-items-center p-3 mb-2">
                                            <i
                                                class="fab fa-facebook-f btn btn-light btn-square rounded-circle me-3"></i>
                                            <span class="text-white">13,977 Fans</span>
                                        </a>
                                        <a href="#"
                                            class="w-100 rounded btn btn-danger d-flex align-items-center p-3 mb-2">
                                            <i class="fab fa-twitter btn btn-light btn-square rounded-circle me-3"></i>
                                            <span class="text-white">21,798 Follower</span>
                                        </a>
                                        <a href="#"
                                            class="w-100 rounded btn btn-warning d-flex align-items-center p-3 mb-2">
                                            <i class="fab fa-youtube btn btn-light btn-square rounded-circle me-3"></i>
                                            <span class="text-white">7,999 Subscriber</span>
                                        </a>
                                        <a href="#"
                                            class="w-100 rounded btn btn-dark d-flex align-items-center p-3 mb-2">
                                            <i
                                                class="fab fa-instagram btn btn-light btn-square rounded-circle me-3"></i>
                                            <span class="text-white">19,764 Follower</span>
                                        </a>
                                        <a href="#"
                                            class="w-100 rounded btn btn-secondary d-flex align-items-center p-3 mb-2">
                                            <i class="bi-cloud btn btn-light btn-square rounded-circle me-3"></i>
                                            <span class="text-white">31,999 Subscriber</span>
                                        </a>
                                        <a href="#"
                                            class="w-100 rounded btn btn-warning d-flex align-items-center p-3 mb-4">
                                            <i class="fab fa-dribbble btn btn-light btn-square rounded-circle me-3"></i>
                                            <span class="text-white">37,999 Subscriber</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Single Product End -->


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
                        <p class="text-secondary line-h">Address: <span class="text-white">175 Tay Son, Dong Da
                                District, Hanoi</span>
                        </p>
                        <p class="text-secondary line-h">Email: <span class="text-white">Example@gmail.com</span></p>
                        <p class="text-secondary line-h">Phone: <span class="text-white">0987654321</span></p>
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

    <!-- Template Javascript -->
    <script src="../../public/js/app.js"></script>
</body>

</html>