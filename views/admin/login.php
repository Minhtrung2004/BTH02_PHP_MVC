<?php
// Kiểm tra nếu có dữ liệu từ form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy giá trị từ form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Kiểm tra thông tin đăng nhập (ví dụ: so sánh với dữ liệu trong CSDL hoặc mảng)
    if ($username == 'admin' && $password == 'password') {
        // Đăng nhập thành công, chuyển hướng đến trang khác
        header("Location: views/admin/news/index.php");
        exit();
    } else {
        // Đăng nhập thất bại, hiển thị thông báo lỗi
        echo "<p class='text-danger'>Tài khoản hoặc mật khẩu không đúng!</p>";
    }
}
?>

<!-- views/admin/login.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <link rel="stylesheet" href="../../public/css/login.css">
    <title>Login</title>
</head>

<body>
    <section class="vh-100">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <img src="../../public/img/draw2.jpg" class="img-fluid" alt="Sample image">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <form action="login.php" method="POST">
                        <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
                            <p class="lead fw-normal mb-0 me-3">Đăng nhập với</p>
                            
                               <!-- Facebook icon -->
        <button type="button" class="btn btn-primary btn-floating mx-1">
            <i class="fab fa-facebook-f"></i>
        </button>

        <!-- Twitter icon -->
        <button type="button" class="btn btn-info btn-floating mx-1">
            <i class="fab fa-twitter"></i>
        </button>

        <!-- Instagram icon -->
        <button type="button" class="btn btn-danger btn-floating mx-1">
            <i class="fab fa-instagram"></i>
        </button>
                        </div>

                        <div class="divider d-flex align-items-center my-4">
                            <p class="text-center fw-bold mx-3 mb-0">Hoặc</p>
                        </div>

                        <!-- Username input -->
                        <div class="form-outline mb-4">
                            <input type="text" name="username" id="form3Example3" class="form-control form-control-lg"
                                placeholder="Nhập tài khoản người dùng" required />
                            <label class="form-label" for="form3Example3">Tài khoản người dùng</label>
                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-3">
                            <input type="password" name="password" id="form3Example4" class="form-control form-control-lg"
                                placeholder="Nhập mật khẩu" required />
                            <label class="form-label" for="form3Example4">Mật khẩu</label>
                        </div>

                        <div class="d-flex justify-content-end align-items-center">
                            <a href="#!" class="text-body">Quên mật khẩu</a>
                        </div>

                        <div class="text-center text-lg-start mt-4 pt-2">
                            <button type="submit" class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">Đăng nhập</button>
                            <p class="small fw-bold mt-2 pt-1 mb-0 text-center">Không có tài khoản? <a href="#!" class="link-danger">Đăng ký</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>

</html>
