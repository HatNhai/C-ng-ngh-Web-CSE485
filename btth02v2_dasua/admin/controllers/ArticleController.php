<?php
require_once 'models/Article.model.php';
require_once 'models/Category.model.php';
require_once 'models/Author.model.php';

class ArticleController
{
    // Phương thức hiển thị danh sách bài viết với phân trang
    public function index()
    {
        $limit = 10; // Số bài viết trên mỗi trang
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Lấy số trang từ URL, mặc định là 1
        $offset = ($page - 1) * $limit; // Tính toán vị trí bắt đầu của bài viết

        // Lấy tổng số bài viết để tính toán số trang
        $total = ArticleModel::getTotalCount();
        $totalPages = ceil($total / $limit); // Tính tổng số trang

        // Lấy danh sách bài viết với join và phân trang
        $articles = ArticleModel::getAllWithPagination($limit, $offset);

        include 'views/article/index.php'; // Hiển thị danh sách bài viết
    }

    // Phương thức tạo bài viết mới
    public function create()
    {
        // Fetch authors and categories from the database
        $authors = AuthorModel::getAll(); // Lấy danh sách tác giả
        $categories = CategoryModel::getAll(); // Lấy danh sách thể loại
        $message = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Nhận dữ liệu từ form
            $ma_bviet = $_POST['ma_bviet'] ?? '';
            $tieude = $_POST['tieude'] ?? '';
            $ten_bhat = $_POST['ten_bhat'] ?? '';
            $ma_tloai = $_POST['ma_tloai'] ?? 0;
            $tomtat = $_POST['tomtat'] ?? '';
            $noidung = $_POST['noidung'] ?? '';
            $ma_tgia = $_POST['ma_tgia'] ?? 0;
            $ngayviet = $_POST['ngayviet'] ?? '';
            $hinhanh = $_POST['hinhanh'] ?? '';

            // Kiểm tra xem mã bài viết đã tồn tại chưa
            if ($this->checkIfExists($ma_bviet)) {
                $message = "Lỗi: Mã bài viết đã tồn tại!";
                include 'views/article/create.php'; // Hiển thị lại form với thông báo lỗi
                return;
            }

            // Thêm bài viết mới
            $article = new ArticleModel();
            $article->ma_bviet = $ma_bviet;
            $article->tieude = $tieude;
            $article->ten_bhat = $ten_bhat;
            $article->ma_tloai = $ma_tloai;
            $article->tomtat = $tomtat;
            $article->noidung = $noidung;
            $article->ma_tgia = $ma_tgia;
            $article->ngayviet = $ngayviet;
            $article->hinhanh = $hinhanh;

            // Lưu bài viết vào cơ sở dữ liệu
            $article->save();
            $message = 'Thêm bài viết thành công!';
            // header('Location: index.php?controller=ArticleController&action=index'); // Chuyển hướng đến danh sách bài viết
            // exit();
        }

        include 'views/article/create.php'; // Hiển thị form thêm bài viết
    }

    // Phương thức kiểm tra mã bài viết đã tồn tại
    private function checkIfExists($ma_bviet)
    {
        $article = ArticleModel::getById($ma_bviet); // Gọi phương thức để lấy bài viết theo ID
        return $article !== null; // Nếu bài viết không null, có nghĩa là mã đã tồn tại
    }

    // Phương thức chỉnh sửa bài viết theo ID
    public function edit()
    {
        // Lấy id từ URL parameters
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;

        // lấy thông tin bài viết
        $article = ArticleModel::getById($id); // Lấy thông tin bài viết từ cơ sở dữ liệu
        if (!$article) {
            echo "Bài viết không tồn tại."; // Thông báo nếu bài viết không tồn tại
            header('Location: index.php?controller=ArticleController&action=index');
            return;
        }

        // Fetch authors and categories for the form
        $authors = AuthorModel::getAll(); // Lấy danh sách tác giả
        $categories = CategoryModel::getAll(); // Lấy danh sách thể loại

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Cập nhật dữ liệu từ form gửi về
            $article->tieude = $_POST['tieude'] ?? $article->tieude;
            $article->ten_bhat = $_POST['ten_bhat'] ?? $article->ten_bhat;
            $article->ma_tloai = $_POST['ma_tloai'] ?? $article->ma_tloai;
            $article->tomtat = $_POST['tomtat'] ?? $article->tomtat;
            $article->noidung = $_POST['noidung'] ?? $article->noidung;
            $article->ma_tgia = $_POST['ma_tgia'] ?? $article->ma_tgia;
            $article->hinhanh = $_POST['hinhanh'] ?? $article->hinhanh;

            // Lưu bài viết đã chỉnh sửa vào cơ sở dữ liệu
            $article->save();
            header('Location: index.php'); // Chuyển hướng về danh sách
            exit(); // Thêm exit để ngăn tiếp tục thực hiện mã
        } else {
            include 'views/article/edit.php'; // Hiển thị form sửa bài viết
        }
    }

    // Phương thức xóa bài viết theo ID
    public function delete()
    {
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0; // Lấy ID từ URL

        // Kiểm tra xem bài viết có tồn tại không
        $article = ArticleModel::getById($id);
        if (!$article) {
            echo "Bài viết không tồn tại."; // Thông báo nếu bài viết không tồn tại
            header('Location: index.php?controller=ArticleController&action=index');
            exit; // Dừng thực thi tiếp theo
        }


        ArticleModel::delete($id); // Gọi phương thức xóa bài viết
        echo "<script>
                    alert('Bài viết đã được xóa.');
                    window.location.reload();
                  </script>";
        exit;
    }
}
