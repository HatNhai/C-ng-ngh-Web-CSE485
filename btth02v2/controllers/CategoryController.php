<?php
include("services/CategoryService.php");
class CategoryController
{
    private $categoryService;

    public function __construct()
    {
        $this->categoryService = new CategoryService();
    }


    // Hàm xử lý hành động index
    public function index()
    {
        $categories = $this->categoryService->getAllCategories();
        include("views/category/list_category.php");
    }

    public function viewAddCategory()
    {
        include("views/category/add_category.php");
    }

    public function add()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['txtCatName'])) {
            $ten_tloai = $_POST['txtCatName'];

            // Gọi service để thêm mới
            $this->categoryService->addCategory($ten_tloai);

            // Điều hướng về danh sách tác giả sau khi thêm
            header("Location: index.php?controller=category&action=index");
            exit();
        }
    }


    //Phần sửa
    public function viewEditCategory()
    {
        $ma_tloai = isset($_GET['id']) ? intval($_GET['id']) : 0;

        $categoryData = $this->categoryService->getCategoryById($ma_tloai);
        if (!$categoryData) {
            echo "Thể loại không tồn tại.";
            return;
        }
        $category = new Category($categoryData['ma_tloai'], $categoryData['ten_tloai']);

        include_once("views/category/edit_category.php");
    }


    public function saveEditCategory()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lấy thông tin từ form
            $ma_tloai = intval($_POST['txtCatId']);
            $ten_tloai = trim($_POST['txtCatName']);

            // Gọi phương thức để cập nhật thông tin tác giả
            if ($this->categoryService->updateCategory($ma_tloai, $ten_tloai)) {
                // Chuyển hướng về trang danh sách tác giả
                header("Location: index.php?controller=category&action=index");
                exit();
            } else {
                echo "Lỗi cập nhật thông tin.";
            }
        }
    }


    // Phần xóa tác giả
    public function delete()
    {
        if (isset($_GET['id'])) {
            $ma_tloai = intval($_GET['id']); // Chuyển đổi ID thành số nguyên

            // Gọi phương thức deleteAuthor trong AuthorService
            if ($this->categoryService->deleteCategory($ma_tloai)) {
                // Nếu xóa thành công, chuyển hướng về trang danh sách tác giả
                header('Location: index.php?controller=category&action=index');
                exit();
            } else {
                // Nếu có lỗi xảy ra khi xóa, có thể hiển thị thông báo
                echo "Có lỗi xảy ra khi xóa thể loại.";
            }
        } else {
            // Nếu không có ID trong URL, hiển thị thông báo lỗi
            echo "ID thể loại không hợp lệ.";
        }
    }
}
