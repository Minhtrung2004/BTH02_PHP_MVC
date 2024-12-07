<?php
require '../../../core/Connection.php';
$sql = "SELECT * FROM news";
$limit = 12;

// Lấy trang hiện tại từ URL hoặc mặc định là 1
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Lấy tổng số bản ghi từ cơ sở dữ liệu
$total_sql = "SELECT COUNT(*) as total FROM news";
$total_stmt = $conn->prepare($total_sql);
$total_stmt->execute();
$total_result = $total_stmt->fetch();
$total_rows = $total_result['total'];

// Lấy dữ liệu chỉ cho trang hiện tại
$sql = "SELECT * FROM news LIMIT :limit OFFSET :offset";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$results = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Bootstrap Simple Data Table</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../../../public/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../public/css/admin.css">


</head>

<body>

    <div class="container-xll">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-8">
                            <h2>Admin <b>Page</b></h2>
                        </div>
                        <div class="col-sm-4">
                            <div class="search-box">
                                <i class="material-icons">&#xE8B6;</i>
                                <input type="text" class="form-control" placeholder="Search&hellip;">
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Title<i class="fa fa-sort"></i></th>
                            <th>content</th>
                            <th>Image<i class="fa fa-sort"></i></th>
                            <th>Created_at</th>
                            <th>Cretegory_id<i class="fa fa-sort"></i></th>
                            <th>Actions<i class="fa fa-sort"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($results as $result) { ?>
                            <tr>
                                <td><?php echo htmlspecialchars($result['id']) ?></td>
                                <td><?php echo htmlspecialchars($result['title']) ?></td>
                                <td><?php echo htmlspecialchars($result['content']) ?></td>
                                <td><?php echo htmlspecialchars($result['image']) ?></td>
                                <td><?php echo htmlspecialchars($result['created_at']) ?></td>
                                <td><?php echo htmlspecialchars($result['category_id']) ?></td>
                                <td>
                                    <a href="#" class="view" title="View" data-toggle="tooltip"><i class="material-icons">&#xE417;</i></a>
                                    <a href="#" class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                                    <a href="#" class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <div class="clearfix">
                    <div class="hint-text">
                        Showing <b><?php echo $limit; ?></b> out of <b><?php echo $total_rows; ?></b> entries
                    </div>
                    <ul class="pagination">
                        <?php
                        // Previous button
                        if ($page > 1) {
                            echo '<li class="page-item"><a href="?page=' . ($page - 1) . '" class="page-link"><i class="fa fa-angle-double-left"></i></a></li>';
                        } else {
                            echo '<li class="page-item disabled"><a href="#" class="page-link"><i class="fa fa-angle-double-left"></i></a></li>';
                        }

                        // Hiển thị các nút phân trang
                        $total_pages = ceil($total_rows / $limit);
                        for ($i = 1; $i <= $total_pages; $i++) {
                            if ($i == $page) {
                                echo '<li class="page-item active"><a href="?page=' . $i . '" class="page-link">' . $i . '</a></li>';
                            } else {
                                echo '<li class="page-item"><a href="?page=' . $i . '" class="page-link">' . $i . '</a></li>';
                            }
                        }

                        // Next button
                        if ($page < $total_pages) {
                            echo '<li class="page-item"><a href="?page=' . ($page + 1) . '" class="page-link"><i class="fa fa-angle-double-right"></i></a></li>';
                        } else {
                            echo '<li class="page-item disabled"><a href="#" class="page-link"><i class="fa fa-angle-double-right"></i></a></li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="../../public/js/admin.js"></script>
</html>