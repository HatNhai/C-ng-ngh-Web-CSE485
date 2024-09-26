<?php
// Đảm bảo đã bao gồm CategoryService
require_once($_SERVER['DOCUMENT_ROOT'] . '/btth02v2_dasua/services/CategoryService.php');

// Tạo một đối tượng CategoryService
$categoryService = new CategoryService();

// Gọi phương thức getAllCategories để lấy danh sách các thể loại
$categories = $categoryService->getAllCategories();

if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['ma_tloai'])) {
    $categoryId = $_GET['ma_tloai'];
    $categoryService->deleteCategory($categoryId);

    // Sau khi xoá, điều hướng lại trang danh sách để cập nhật hiển thị
    header('Location: list_category.php?controller=category&action=index');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music for Life</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../../assets/css/style_login.css">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary shadow p-3 bg-white rounded">
            <div class="container-fluid">
                <div class="h3">
                    <a class="navbar-brand" href="#">Administration</a>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="../../views/admin/index.php">Trang chủ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../home/index.php">Trang ngoài</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active fw-bold" href="list_category.php">Thể loại</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href=".././author/index_author.php">Tác giả</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../../index.php">Bài viết</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main class="container mt-5 mb-5">
        <div class="row">
            <div class="col-sm">
                <a href="add_category.php" class="btn btn-success">Thêm mới</a>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tên thể loại</th>
                            <th>Sửa</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        if (isset($categories) && is_array($categories)) {
                            foreach ($categories as $category) {
                                echo "<tr>";
                                echo "<td>" . $category->getMaTLoai() . "</td>";
                                echo "<td>" . $category->getTenTLoai() . "</td>";
                                echo "<td><a href='edit_category.php?controller=category&ma_tloai=" . $category->getMaTLoai() . "'><i class='fa-solid fa-pen-to-square'></i></a></td>";
                                echo "<td><a href='list_category.php?controller=category&action=delete&ma_tloai=" . $category->getMaTLoai() . "'><i class='fa-solid fa-trash'></i></a></td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4' class='text-center'>Không có thể loại nào.</td></tr>";
                        }

                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <footer class="bg-white d-flex justify-content-center align-items-center border-top border-secondary border-2" style="height:80px">
        <h4 class="text-center text-uppercase fw-bold">TLU's music garden</h4>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>