<?php
include('../includes/header.php');
include('../includes/nav.php');
include('../includes/database-connection.php'); // Kết nối tới database

$message = ''; // Khởi tạo biến message

// Kiểm tra nếu có ID từ query string
$id = $_GET['id'] ?? null;

if ($id) {
    // Xóa bài viết
    $stmt = $conn->prepare("DELETE FROM baiviet WHERE ma_bviet=?");
    $stmt->bind_param("s", $id);

    if ($stmt->execute()) {
        $message = "Bài viết đã được xóa thành công!";
    } else {
        $message = "Lỗi: " . htmlspecialchars($stmt->error);
    }

    $stmt->close();
} else {
    $message = "Lỗi: ID bài viết không hợp lệ!";
}

$conn->close();
?>

<main>
    <div class="wrapper container p-4">
        <?php if ($message): ?>
            <div class="alert <?= strpos($message, 'Lỗi') !== false ? 'alert-danger' : 'alert-success' ?>">
                <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>
        <a href="article.php" class="btn btn-primary">Quay lại danh sách bài viết</a>
    </div>
</main>

<?php
include('../includes/footer.php');
?>