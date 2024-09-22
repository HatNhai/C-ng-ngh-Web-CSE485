<?php
include('../includes/header.php');
include('../includes/nav.php');
include('../includes/database-connection.php'); // Kết nối tới database

$message = ''; // Khởi tạo biến message
$stmt = null; // Khởi tạo biến stmt

// Xử lý khi form được submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ma_bviet = $_POST['ma_bviet']; // Nhận mã bài viết từ form
    $tieude = $_POST['tieude'];
    $ten_bhat = $_POST['ten_bhat'];
    $ma_tloai = $_POST['ma_tloai'];
    $tomtat = $_POST['tomtat'];
    $noidung = $_POST['noidung'];
    $ma_tgia = $_POST['ma_tgia'];
    $ngayviet = $_POST['ngayviet'];
    $hinhanh = $_POST['hinhanh']; // Sử dụng link URL
    $id = $_POST['id'] ?? null; // ID của bài viết nếu cập nhật

    if ($id) {
        // Cập nhật bài viết
        $stmt = $conn->prepare("UPDATE baiviet SET ma_bviet=?, tieude=?, ten_bhat=?, ma_tloai=?, tomtat=?, noidung=?, ma_tgia=?, ngayviet=?, hinhanh=? WHERE ma_bviet=?");
        $stmt->bind_param("issississi", $ma_bviet, $tieude, $ten_bhat, $ma_tloai, $tomtat, $noidung, $ma_tgia, $ngayviet, $hinhanh, $id);
        if ($stmt->execute()) {
            $message = "Bài viết đã được cập nhật thành công!";
        } else {
            $message = "Lỗi: " . htmlspecialchars($stmt->error);
        }
    } else {
        // Kiểm tra xem mã bài viết đã tồn tại chưa
        $checkStmt = $conn->prepare("SELECT COUNT(*) FROM baiviet WHERE ma_bviet = ?");
        $checkStmt->bind_param("s", $ma_bviet);
        $checkStmt->execute();
        $checkStmt->bind_result($count);
        $checkStmt->fetch();
        $checkStmt->close();

        if ($count > 0) {
            $message = "Lỗi: Mã bài viết đã tồn tại!";
        } else {
            // Thêm bài viết mới
            $stmt = $conn->prepare("INSERT INTO baiviet (ma_bviet, tieude, ten_bhat, ma_tloai, tomtat, noidung, ma_tgia, ngayviet, hinhanh) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("issississ", $ma_bviet, $tieude, $ten_bhat, $ma_tloai, $tomtat, $noidung, $ma_tgia, $ngayviet, $hinhanh);
            if ($stmt->execute()) {
                $message = "Bài viết đã được thêm thành công!";
            } else {
                $message = "Lỗi: " . htmlspecialchars($stmt->error);
            }
        }
    }

    if ($stmt) {
        $stmt->close(); // Đảm bảo gọi close() chỉ khi stmt được khởi tạo
    }
}

// Fetch authors and categories from the database
$authors = $conn->query("SELECT ma_tgia, ten_tgia FROM tacgia");
$categories = $conn->query("SELECT ma_tloai, ten_tloai FROM theloai");

// Nếu bạn cần tải dữ liệu bài viết để cập nhật
$id = $_GET['id'] ?? null;
$article = null;
if ($id) {
    $stmt = $conn->prepare("SELECT * FROM baiviet WHERE ma_bviet=?");
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $article = $result->fetch_assoc();
    $stmt->close();

    // Nếu không tìm thấy bài viết, chuyển hướng và xóa ID
    if (!$article) {
        header("Location: article_add.php");
        exit; // Dừng thực thi tiếp theo
    }
}
?>
<main>
    <div class="wrapper container p-4">
        <?php if ($message): ?>
            <div class="alert <?= strpos($message, 'Lỗi') !== false ? 'alert-danger' : 'alert-success' ?>">
                <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>
        <h1><?= $article ? 'Cập Nhật Bài Viết' : 'Thêm Bài Viết Mới' ?></h1>
        <form action="article_add.php" method="POST">
            <input type="hidden" name="id" value="<?= $article['id'] ?? '' ?>">
            <div class="mb-3">
                <label for="ma_bviet" class="form-label">Mã bài viết</label>
                <input type="text" class="form-control" id="ma_bviet" name="ma_bviet" value="<?= htmlspecialchars($article['ma_bviet'] ?? '') ?>" required <?= $id ? 'readonly' : '' ?>>
            </div>
            <div class="mb-3">
                <label for="tieude" class="form-label">Tiêu đề</label>
                <input type="text" class="form-control" id="tieude" name="tieude" value="<?= htmlspecialchars($article['tieude'] ?? '') ?>" required>
            </div>
            <div class="mb-3">
                <label for="ten_bhat" class="form-label">Tên bài hát</label>
                <input type="text" class="form-control" id="ten_bhat" name="ten_bhat" value="<?= htmlspecialchars($article['ten_bhat'] ?? '') ?>" required>
            </div>
            <div class="mb-3">
                <label for="ma_tloai" class="form-label">Thể loại</label>
                <select class="form-control" id="ma_tloai" name="ma_tloai" required>
                    <option value="">-- Chọn thể loại --</option>
                    <?php while ($row = $categories->fetch_assoc()): ?>
                        <option value="<?= $row['ma_tloai'] ?>" <?= (isset($article) && $article['ma_tloai'] == $row['ma_tloai']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($row['ten_tloai']) ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="tomtat" class="form-label">Tóm tắt</label>
                <textarea class="form-control" id="tomtat" name="tomtat" rows="3" required><?= htmlspecialchars($article['tomtat'] ?? '') ?></textarea>
            </div>
            <div class="mb-3">
                <label for="noidung" class="form-label">Nội dung</label>
                <textarea class="form-control" id="noidung" name="noidung" rows="5" required><?= htmlspecialchars($article['noidung'] ?? '') ?></textarea>
            </div>
            <div class="mb-3">
                <label for="ma_tgia" class="form-label">Tác giả</label>
                <select class="form-control" id="ma_tgia" name="ma_tgia" required>
                    <option value="">-- Chọn tác giả --</option>
                    <?php while ($row = $authors->fetch_assoc()): ?>
                        <option value="<?= $row['ma_tgia'] ?>" <?= (isset($article) && $article['ma_tgia'] == $row['ma_tgia']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($row['ten_tgia']) ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="ngayviet" class="form-label">Ngày viết</label>
                <input type="date" class="form-control" id="ngayviet" name="ngayviet" value="<?= htmlspecialchars($article['ngayviet'] ?? '') ?>" required>
            </div>
            <div class="mb-3">
                <label for="hinhanh" class="form-label">Link hình ảnh</label>
                <input type="url" class="form-control" id="hinhanh" name="hinhanh" value="<?= htmlspecialchars($article['hinhanh'] ?? '') ?>" required>
            </div>
            <button type="submit" class="btn btn-primary"><?= $article ? 'Cập Nhật' : 'Thêm bài viết' ?></button>
        </form>
    </div>
</main>

<?php
$conn->close();
include('../includes/footer.php');
?>