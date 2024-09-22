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
                    // Mảng các đường dẫn và nhãn tương ứng, với mỗi nhãn có thể có nhiều đường dẫn active
                    $navItems = [
                        'Trang chủ' => ['./', 'index.php'],
                        'Trang ngoài' => ['../index.php'],
                        'Thể loại' => ['category.php'],
                        'Tác giả' => ['author.php'],
                        'Bài viết' => ['article.php','article_add.php', 'article_edit.php'],
                    ];

                    // Duyệt qua từng phần tử của mảng và kiểm tra active
                    foreach ($navItems as $label => $urls) {
                        // Kiểm tra xem basename của trang hiện tại có nằm trong danh sách các URL không
                        $active = in_array(basename($_SERVER['PHP_SELF']), array_map('basename', $urls)) ? 'active' : '';
                        echo "<li class='nav-item'>
                                <a class='nav-link $active' href='{$urls[0]}'>$label</a>
                              </li>";
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
</header>
