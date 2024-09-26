<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/btth02v2_dasua/services/CategoryService.php');

class CategoryController {
    private $categoryService;

    public function __construct() {
        $this->categoryService = new CategoryService();
    }

    // Phương thức hiển thị danh sách các thể loại
    public function index() {
        $categories = $this->categoryService->getAllCategories();
        require_once($_SERVER['DOCUMENT_ROOT'] . '/btth02v2_dasua/views/category/list_category.php');
    }

    // Phương thức hiển thị trang thêm thể loại
    /* public function add() {
        require_once($_SERVER['DOCUMENT_ROOT'] . '/DucHai/btth02v2_dasua/views/category/add_category.php');
    } */

    public function getCategoryById($ma_tloai) {
        return $this->categoryService->getCategoryById($ma_tloai); // Trả về đối tượng
    }    

    // Phương thức thêm mới thể loại
    public function addCat() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ten_tloai = $_POST['txtCatName'] ?? '';
            $this->categoryService->addCategory($ten_tloai);
        }
    }

    // Phương thức cập nhật thể loại
    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ma_tloai = $_POST['txtCatId'];
            $ten_tloai = $_POST['txtCatName'];

            $this->categoryService->updateCategory($ma_tloai, $ten_tloai);
        }
    }

    // Phương thức xoá thể loại
    public function delete() {
        if (isset($_GET['ma_tloai'])) { 
            $ma_tloai = $_GET['ma_tloai'];
            $this->categoryService->deleteCategory($ma_tloai);
        }
    }
}
?>
