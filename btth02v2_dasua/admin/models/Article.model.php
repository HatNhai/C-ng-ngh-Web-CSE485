<?php
require_once 'config/config.php';

class ArticleModel
{
    // Các thuộc tính
    public $ma_bviet; // ID bài viết
    public $tieude; // Tiêu đề bài viết
    public $ten_bhat; // Tên bài hát
    public $ma_tloai; // Mã thể loại
    public $tomtat; // Tóm tắt
    public $noidung; // Nội dung
    public $ma_tgia; // Mã tác giả
    public $ngayviet; // Ngày viết
    public $hinhanh; // Hình ảnh

    // Kết nối đến cơ sở dữ liệu
    private static function connect()
    {
        global $conn; // Sử dụng biến toàn cục $conn từ config
        return $conn; // Trả về kết nối
    }

    // Phương thức kiểm tra xem mã bài viết đã tồn tại chưa
    public static function exists($ma_bviet)
    {
        $conn = self::connect();
        $stmt = $conn->prepare("SELECT COUNT(*) FROM baiviet WHERE ma_bviet = ?");
        if ($stmt === false) {
            die("Lỗi chuẩn bị truy vấn: " . $conn->error);
        }

        $stmt->bind_param("i", $ma_bviet);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();

        return $count > 0; // Trả về true nếu tồn tại, ngược lại false
    }

    // Phương thức để lấy bài viết theo ID
    public static function getById($id)
    {
        $conn = self::connect();
        $stmt = $conn->prepare("SELECT * FROM baiviet WHERE ma_bviet = ?");
        if ($stmt === false) {
            die("Lỗi chuẩn bị truy vấn: " . $conn->error);
        }

        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $article = new ArticleModel();
            $article->ma_bviet = $row['ma_bviet'];
            $article->tieude = $row['tieude'];
            $article->ten_bhat = $row['ten_bhat'];
            $article->ma_tloai = $row['ma_tloai'];
            $article->tomtat = $row['tomtat'];
            $article->noidung = $row['noidung'];
            $article->ma_tgia = $row['ma_tgia'];
            $article->ngayviet = $row['ngayviet'];
            $article->hinhanh = $row['hinhanh'];
            return $article; // Trả về đối tượng Article
        }

        return null; // Không tìm thấy bài viết
    }

    // Phương thức để lấy tất cả bài viết với phân trang và join bảng
    public static function getAllWithPagination($limit, $offset)
    {
        $conn = self::connect();
        $stmt = $conn->prepare("
            SELECT b.ma_bviet, b.tieude, b.ten_bhat, t.ten_tloai, b.tomtat, b.noidung, tg.ten_tgia, b.ngayviet, b.hinhanh 
            FROM baiviet b
            INNER JOIN theloai t ON b.ma_tloai = t.ma_tloai
            INNER JOIN tacgia tg ON b.ma_tgia = tg.ma_tgia
            ORDER BY b.ma_bviet ASC
            LIMIT ? OFFSET ?
        ");

        if ($stmt === false) {
            die("Lỗi chuẩn bị truy vấn: " . $conn->error);
        }

        $stmt->bind_param("ii", $limit, $offset);
        $stmt->execute();
        $result = $stmt->get_result();

        $articles = [];
        while ($row = $result->fetch_assoc()) {
            $article = new ArticleModel();
            $article->ma_bviet = $row['ma_bviet'];
            $article->tieude = $row['tieude'];
            $article->ten_bhat = $row['ten_bhat'];
            $article->ma_tloai = $row['ten_tloai']; // Join thể loại
            $article->tomtat = $row['tomtat'];
            $article->noidung = $row['noidung'];
            $article->ma_tgia = $row['ten_tgia']; // Join tác giả
            $article->ngayviet = $row['ngayviet'];
            $article->hinhanh = $row['hinhanh'];
            $articles[] = $article;
        }

        $stmt->close();
        return $articles; // Trả về danh sách bài viết với join
    }

    // Phương thức để lấy tổng số bài viết
    public static function getTotalCount()
    {
        $conn = self::connect();
        $result = $conn->query("SELECT COUNT(*) as total FROM baiviet");

        if (!$result) {
            die("Lỗi truy vấn: " . $conn->error);
        }

        $row = $result->fetch_assoc();
        return $row['total'];
    }

    // Phương thức để lưu bài viết (thêm hoặc cập nhật)
    public function save()
    {
        $conn = self::connect();

        // Check if the article already exists
        if (self::exists($this->ma_bviet)) {
            // Update the article if it exists
            $stmt = $conn->prepare("UPDATE baiviet SET tieude = ?, ten_bhat = ?, ma_tloai = ?, tomtat = ?, noidung = ?, ma_tgia = ?, hinhanh = ? WHERE ma_bviet = ?");
            if ($stmt === false) {
                die("Lỗi chuẩn bị truy vấn: " . $conn->error);
            }
            $stmt->bind_param("ssissssi", $this->tieude, $this->ten_bhat, $this->ma_tloai, $this->tomtat, $this->noidung, $this->ma_tgia, $this->hinhanh, $this->ma_bviet);
            $stmt->execute();
        } else {
            // Insert new article
            $stmt = $conn->prepare("INSERT INTO baiviet (ma_bviet, tieude, ten_bhat, ma_tloai, tomtat, noidung, ma_tgia, hinhanh) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            if ($stmt === false) {
                die("Lỗi chuẩn bị truy vấn: " . $conn->error);
            }
            $stmt->bind_param("sssissss", $this->ma_bviet, $this->tieude, $this->ten_bhat, $this->ma_tloai, $this->tomtat, $this->noidung, $this->ma_tgia, $this->hinhanh);
            $stmt->execute();
            $this->ma_bviet = $conn->insert_id; // Set the inserted ID
        }

        $stmt->close();
        $conn->close();
    }


    // Phương thức để xóa bài viết
    public static function delete($id)
    {
        $conn = self::connect();
        $stmt = $conn->prepare("DELETE FROM baiviet WHERE ma_bviet = ?");
        if ($stmt === false) {
            die("Lỗi chuẩn bị truy vấn: " . $conn->error);
        }

        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
        $conn->close();
    }
}
