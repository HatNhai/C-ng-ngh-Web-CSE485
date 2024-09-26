<?php include 'layouts/header.php'; ?>
<?php include 'layouts/nav.php'; ?>

<main>
    <div class="wrapper container p-4">
        <?php if (isset($message) && !empty($message)): ?>
            <div class="alert <?= strpos($message, 'Lỗi') !== false ? 'alert-danger' : 'alert-success' ?>">
                <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>

        <h1>Xóa Bài Viết</h1>
        <form action="index.php?controller=ArticleController&action=delete&id=<?= htmlspecialchars($article->ma_bviet) ?>" method="POST">
            <input type="hidden" name="id" value="<?= htmlspecialchars($article->ma_bviet) ?>">
            <div class="mb-3">
                <p>Bạn có chắc chắn muốn xóa bài viết với tiêu đề: <strong><?= htmlspecialchars($article->tieude) ?></strong>?</p>
            </div>
            <button type="submit" class="btn btn-danger">Xóa bài viết</button>
            <a href="index.php?controller=ArticleController&action=index" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
</main>

<?php include 'layouts/footer.php'; ?>