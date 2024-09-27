<?php
include("services/MemberService.php");

class MemberController {
    private $memberService; 

    public function __construct() {
        $this->memberService = new MemberService(); 
    }

    public function login() {
        session_start(); 

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? ''; 
            $password = $_POST['password'] ?? '';

            // Tìm kiếm người dùng
            $member = $this->memberService->findUser($username, $password);

            if ($member) {
                // Đăng nhập thành công
                $_SESSION['username'] = $member->getUsername();
                header('Location: index.php?controller=Admini&action=index'); 
                exit;
            } else {
                // Đăng nhập thất bại
                $error = "Tên đăng nhập hoặc mật khẩu không chính xác!";
                include 'views/admin/login.php'; 
            }
        } else {
            include 'views/admin/login.php'; 
        }
    }
}
?>