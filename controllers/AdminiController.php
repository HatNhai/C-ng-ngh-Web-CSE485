<?php
require_once('./services/AdminiService.php');

class AdminiController {
    private $AdminiService;

    public function __construct() {
        $this->AdminiService = new AdminiService();
    }

    public function index() {
        
        $result = $this->AdminiService->getAllUsers();
         
        include('views/admin/index.php');
    }
}

?>