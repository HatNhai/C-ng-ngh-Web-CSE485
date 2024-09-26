<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/btth02v2_dasua/configs/DBConnection.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/btth02v2_dasua/services/AdminiService.php');

class AdminiController {
    private $AdminiService;

    public function __construct() {
        $this->AdminiService = new AdminiService();
    }

    public function index() {
            $result = $this->AdminiService->getAllUsers();
            require_once($_SERVER['DOCUMENT_ROOT'] . '/btth02v2_dasua/views/admin/index.php');
        
            
        }
        
}
?>
