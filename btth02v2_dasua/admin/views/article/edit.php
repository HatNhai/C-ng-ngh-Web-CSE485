<?php include 'layouts/header.php'; ?>
<?php include 'layouts/nav.php'; ?>

<main>
    <div class="wrapper container p-4">
        <?php if (isset($message) && !empty($message)): ?>
            <div class="alert <?= strpos($message, 'Lỗi') !== false ? 'alert-danger' : 'alert-success' ?>">
                <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>
        <h1>Chỉnh Sửa Bài Viết</h1>
        <form action="index.php?controller=ArticleController&action=edit&id=<?= htmlspecialchars($article->ma_bviet) ?>" method="POST" onsubmit="return validateForm()">
            <input type="hidden" name="id" value="<?= htmlspecialchars($article->ma_bviet) ?>">
            <div class="mb-3">
                <label for="ma_bviet" class="form-label">Mã bài viết</label>
                <input type="number" class="form-control" id="ma_bviet" name="ma_bviet" value="<?= htmlspecialchars($article->ma_bviet) ?>" required readonly>
            </div>
            <div class="mb-3">
                <label for="tieude" class="form-label">Tiêu đề</label>
                <input type="text" class="form-control" id="tieude" name="tieude" value="<?= htmlspecialchars($article->tieude) ?>" required>
            </div>
            <div class="mb-3">
                <label for="ten_bhat" class="form-label">Tên bài hát</label>
                <input type="text" class="form-control" id="ten_bhat" name="ten_bhat" value="<?= htmlspecialchars($article->ten_bhat) ?>" required>
            </div>
            <div class="mb-3">
                <label for="ma_tloai" class="form-label">Thể loại</label>
                <select class="form-control" id="ma_tloai" name="ma_tloai" required>
                    <option value="">-- Chọn thể loại --</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= $category['ma_tloai'] ?>" <?= $category['ma_tloai'] == $article->ma_tloai ? 'selected' : '' ?>>
                            <?= htmlspecialchars($category['ten_tloai']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="tomtat" class="form-label">Tóm tắt</label>
                <textarea class="form-control" id="tomtat" name="tomtat" rows="3" required><?= htmlspecialchars($article->tomtat) ?></textarea>
            </div>
            <div class="mb-3">
                <label for="noidung" class="form-label">Nội dung</label>
                <textarea class="form-control" id="noidung" name="noidung" rows="5" required><?= htmlspecialchars($article->noidung) ?></textarea>
            </div>
            <div class="mb-3">
                <label for="ma_tgia" class="form-label">Tác giả</label>
                <select class="form-control" id="ma_tgia" name="ma_tgia" required>
                    <option value="">-- Chọn tác giả --</option>
                    <?php foreach ($authors as $author): ?>
                        <option value="<?= $author['ma_tgia'] ?>" <?= $author['ma_tgia'] == $article->ma_tgia ? 'selected' : '' ?>>
                            <?= htmlspecialchars($author['ten_tgia']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="ngayviet" class="form-label">Ngày viết</label>
                <input type="date" class="form-control" id="ngayviet" name="ngayviet" value="<?= htmlspecialchars(date('Y-m-d', strtotime($article->ngayviet))) ?>" required>
            </div>
            <div class="mb-3">
                <label for="hinhanh" class="form-label">Link hình ảnh</label>
                <input maxlength="200" type="url" class="form-control" id="hinhanh" name="hinhanh" value="<?= htmlspecialchars($article->hinhanh) ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Cập nhật bài viết</button>
        </form>
    </div>
</main>

<?php include 'layouts/footer.php'; ?>