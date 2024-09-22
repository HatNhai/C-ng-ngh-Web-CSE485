<?php
include('../includes/header.php');
include('../includes/nav.php');
include('../includes/database-connection.php'); // Kết nối tới database

// Kiểm tra ID từ URL
$id = $_GET['id'] ?? null;
if ($id) {
    // Kiểm tra xem ID có tồn tại trong cơ sở dữ liệu không
    $checkStmt = $conn->prepare("SELECT COUNT(*) FROM baiviet WHERE ma_bviet = ?");
    $checkStmt->bind_param("s", $id);
    $checkStmt->execute();
    $checkStmt->bind_result($count);
    $checkStmt->fetch();
    $checkStmt->close();
}

// Thiết lập phân trang
$limit = 10; // Số bài viết trên mỗi trang
$page = $_GET['page'] ?? 1; // Lấy số trang từ URL
$offset = ($page - 1) * $limit; // Tính toán offset

// Truy vấn tổng số bài viết
$totalResult = $conn->query("SELECT COUNT(*) as total FROM baiviet");
$totalRow = $totalResult->fetch_assoc();
$total = $totalRow['total'];
$totalPages = ceil($total / $limit); // Tổng số trang

// Truy vấn bài viết với phân trang
$sql = "SELECT * FROM baiviet LIMIT ?, ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $offset, $limit);
$stmt->execute();
$result = $stmt->get_result();
?>

<main>
    <div class="wrapper container p-4">
        <a href='article_add.php'>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal">
                Thêm bài viết
            </button>
        </a>

        <!-- Bảng hiển thị dữ liệu với tính năng responsive -->
        <div class="table-responsive mt-4">
            <table class="table table-striped ">
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
                    <?php
                    if ($result->num_rows > 0) {
                        // Duyệt qua từng hàng dữ liệu
                        while ($row = $result->fetch_assoc()) {
                            echo '<tr>';
                            echo '<td>' . htmlspecialchars($row['ma_bviet']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['tieude']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['ten_bhat']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['ma_tloai']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['tomtat']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['noidung']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['ma_tgia']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['ngayviet']) . '</td>';
                            echo '<td><img src="' . htmlspecialchars($row['hinhanh']) . '" style="height: 200px" /></td>';
                            echo '<td>';
                            echo '<div class="d-flex">';
                            echo '<a href="article_add.php?id=' . $row['ma_bviet'] . '" class="btn btn-warning btn-sm me-2"><i class="fas fa-edit"></i> Sửa</a>'; // Icon sửa
                            echo '<a href="article_delete.php?id=' . $row['ma_bviet'] . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\')"><i class="fas fa-trash"></i> Xóa</a>'; // Icon xóa
                            echo '</div>';
                            echo '</td>';
                            echo '</tr>';
                        }
                    } else {
                        echo '<tr><td colspan="10">Không có dữ liệu</td></tr>';
                    }

                    // Đóng kết nối
                    $stmt->close();
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Phân trang -->
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center mt-4">
                <?php if ($page > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?= $page - 1 ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                        <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>

                <?php if ($page < $totalPages): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?= $page + 1 ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</main>

<?php
include('../includes/footer.php');
?>