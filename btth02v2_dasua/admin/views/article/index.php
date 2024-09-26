<?php include 'layouts/header.php'; ?>
<?php include 'layouts/nav.php'; ?>

<main>
    <div class="wrapper container p-4">
        <a href='index.php?controller=ArticleController&action=create'>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal">
                Thêm bài viết
            </button>
        </a>

        <!-- Bảng hiển thị dữ liệu với tính năng responsive -->
        <div class="table-responsive mt-4">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th class="text-nowrap" scope="col">Mã bài viết</th>
                        <th class="text-nowrap" scope="col">Tiêu đề</th>
                        <th class="text-nowrap" scope="col">Tên bài hát</th>
                        <th class="text-nowrap" scope="col">Thể loại</th>
                        <th class="text-nowrap" scope="col">Tóm tắt</th>
                        <th class="text-nowrap" scope="col">Nội dung</th>
                        <th class="text-nowrap" scope="col">Tác giả</th>
                        <th class="text-nowrap" scope="col">Ngày viết</th>
                        <th class="text-nowrap" scope="col">Hình ảnh</th>
                        <th class="text-nowrap" scope="col">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($articles)): ?>
                        <?php foreach ($articles as $article): ?>
                            <tr>
                                <td><?= htmlspecialchars($article->ma_bviet); ?></td>
                                <td><?= htmlspecialchars($article->tieude); ?></td>
                                <td><?= htmlspecialchars($article->ten_bhat); ?></td>
                                <td><?= htmlspecialchars($article->ma_tloai); ?></td>
                                <td><?= htmlspecialchars($article->tomtat); ?></td>
                                <td><?= htmlspecialchars($article->noidung); ?></td>
                                <td><?= htmlspecialchars($article->ma_tgia); ?></td>
                                <td><?= htmlspecialchars($article->ngayviet); ?></td>
                                <td><img class="img__article" src="<?= htmlspecialchars($article->hinhanh); ?>" style="height: 200px;" /></td>
                                <td>
                                    <div class="d-flex">
                                        <a href="index.php?controller=ArticleController&action=edit&id=<?= $article->ma_bviet; ?>" class="btn btn-warning btn-sm me-2"><i class="fas fa-edit"></i> Sửa</a>
                                        <a href="index.php?controller=ArticleController&action=delete&id=<?= $article->ma_bviet; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')"><i class="fas fa-trash"></i> Xóa</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="10">Không có dữ liệu</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Phân trang -->
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center mt-4">
                <?php if ($page > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="?controller=ArticleController&action=index&page=<?= $page - 1 ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                        <a class="page-link" href="?controller=ArticleController&action=index&page=<?= $i ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>

                <?php if ($page < $totalPages): ?>
                    <li class="page-item">
                        <a class="page-link" href="?controller=ArticleController&action=index&page=<?= $page + 1 ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</main>

<?php include 'layouts/footer.php'; ?>