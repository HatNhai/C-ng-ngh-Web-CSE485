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
                    <?php
                    // Mảng các đường dẫn và nhãn tương ứng với controller và action
                    $navItems = [
                        'Trang chủ' => ['link' => '../views/admin/index.php'],
                        'Trang ngoài' => ['link' => '../views/home/index.php'],
                        'Thể loại' => ['link' => '../views/category/list_category.php'],
                        'Tác giả' => ['link' => '../views/author/index_author.php'],
                        'Bài viết' => ['controller' => 'ArticleController', 'action' => 'index'],
                    ];

                    // Lấy controller và action hiện tại từ URL
                    $currentController = isset($_GET['controller']) ? $_GET['controller'] : '';
                    $currentAction = isset($_GET['action']) ? $_GET['action'] : '';

                    // Duyệt qua từng phần tử của mảng và kiểm tra active
                    foreach ($navItems as $label => $params) {
                        if (isset($params['link'])) {
                            $url = $params['link'];
                            $isActive = (strpos($_SERVER['REQUEST_URI'], $url) !== false) ? 'active' : '';
                        } else {
                            $isActive = ($currentController === $params['controller'] && $currentAction === $params['action']) ? 'active' : '';
                            $url = 'index.php?controller=' . $params['controller'] . '&action=' . $params['action'];
                        }
                        echo "<li class='nav-item'>
                                <a class='nav-link $isActive' href='$url'>$label</a>
                              </li>";
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
</header>