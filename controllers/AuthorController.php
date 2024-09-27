<?php
 include("services/AuthorService.php");

    class AuthorController {
        private $authorService;

        public function __construct() {
            $this->authorService = new AuthorService();
        }

        public function index() {
            $authors = $this->authorService->getAllAuthor();
            include("views/author/index.php");
        }

        //Phần thêm tác giả 

        public function viewAddAuthor() {
            include("views/author/add_author.php");
        }

        public function add(){
            if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['ten_tgia'])) {
                $ten_tgia = $_POST['ten_tgia'];
                $hinh_tgia = $_FILES['hinh_tgia']['name'] ?? null;
    
                // Gọi service để thêm mới
                $this->authorService->addAuthor($ten_tgia, $hinh_tgia);
    
                // Điều hướng về danh sách tác giả sau khi thêm
                header("Location: index.php?controller=author&action=index");
                exit();
            }
        }


        //Phần sửa
        public function viewEditAuthor() {
        $author_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

        $authorData = $this->authorService->getAuthorById($author_id);
        if (!$authorData) {
            echo "Tác giả không tồn tại.";
            return;
        }
        $author = new Author($authorData['ma_tgia'], $authorData['ten_tgia'], $authorData['hinh_tgia']);
        
        include_once("views/author/edit_author.php");
    }

    
    public function saveEditAuthor() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lấy thông tin từ form
            $ma_tgia = intval($_POST['txtCatId']);
            $ten_tgia = trim($_POST['txtCatName']);
            $hinh_tgia = isset($_POST['txtHinhTacgia']) ? trim($_POST['txtHinhTacgia']) : null;

            // Gọi phương thức để cập nhật thông tin tác giả
            if ($this->authorService->updateAuthor($ma_tgia, $ten_tgia, $hinh_tgia)) {
                // Chuyển hướng về trang danh sách tác giả
                header("Location: index.php?controller=author&action=index");
                exit();
            } else {
                echo "Lỗi cập nhật thông tin tác giả.";
            }
        }
    }


    // Phần xóa tác giả
    public function delete() {
        if (isset($_GET['id'])) { 
            $ma_tgia = intval($_GET['id']); // Chuyển đổi ID thành số nguyên

            // Gọi phương thức deleteAuthor trong AuthorService
            if ($this->authorService->deleteAuthor($ma_tgia)) {
                // Nếu xóa thành công, chuyển hướng về trang danh sách tác giả
                header('Location: index.php?controller=author&action=index');
                exit();
            } else {
                // Nếu có lỗi xảy ra khi xóa, có thể hiển thị thông báo
                echo "Có lỗi xảy ra khi xóa tác giả.";
            }
        } else {
            // Nếu không có ID trong URL, hiển thị thông báo lỗi
            echo "ID tác giả không hợp lệ.";
        }
}






    }
?>
