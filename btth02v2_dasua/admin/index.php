<?php
// Load config file
require_once './config/config.php';


// Chọn controller mặc định
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'ArticleController';

// Include controller
require_once "controllers/$controller.php";

// Tạo controller
$controllerInstance = new $controller();

// Gọi phương thức tương ứng
$action = isset($_GET['action']) ? $_GET['action'] : 'index';
$controllerInstance->$action();
