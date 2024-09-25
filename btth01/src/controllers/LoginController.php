<?php
session_start();

require_once '../models/UserModel.php';
require_once '../core/Database.php';


class LoginController {
    private $userModel;

    public function __construct() {
        $db = Database::connect();
        $this->userModel = new UserModel($db);
    }

    public function login() {
        printf("User");
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            if ($this->userModel->login($username, $password)) {
                $_SESSION['username'] = $username; // Lưu thông tin user vào session
                
                header("Location: ../../admin/index.php");

                exit();
            } else {
                $error = "Tên đăng nhập hoặc mật khẩu không đúng!";
                require '../views/login.php'; // Trả về view với thông báo lỗi
            }
        } else {
            require '../views/login.php'; // Hiển thị form đăng nhập
        }
    }
}

$controller = new LoginController();
$controller->login();
?>