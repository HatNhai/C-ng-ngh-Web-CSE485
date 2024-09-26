<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/btth02v2_dasua/configs/DBConnection.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/btth02v2_dasua/models/Author.php');


class AuthorService {
    // Lấy tất cả các tác giả
    public function getAllAuthor() {
        $db = new DbConnection();
        $conn = $db->getConnection(); 

        $sql = 'SELECT ma_tgia, ten_tgia FROM tacgia';
        $stmt = $conn->query($sql);

        $authors = $stmt->fetchAll(PDO::FETCH_FUNC, function($ma_tgia, $ten_tgia){
            return new Author($ma_tgia, $ten_tgia);
        });
        return $authors;
    }

    
    //Thêm tác giả vào bảng tác giả
    public function addAuthor($ten_tgia, $hinh_tgia = null){
       
        $db = new DBConnection();
        $conn = $db->getConnection();
    
        // Lấy giá trị ma_tgia lớn nhất hiện tại
        $sql_get_max_id = "SELECT MAX(ma_tgia) AS max_id FROM tacgia";
        $stmt = $conn->prepare($sql_get_max_id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $maxId = $result['max_id'] ?? 0;
    
       
        $newId = $maxId + 1;
    
        // Sử dụng prepared statement để thêm dữ liệu
        $sql = "INSERT INTO tacgia (ma_tgia, ten_tgia, hinh_tgia) VALUES (:ma_tgia, :ten_tgia, :hinh_tgia)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':ma_tgia', $newId);
        $stmt->bindParam(':ten_tgia', $ten_tgia);
        $stmt->bindParam(':hinh_tgia', $hinh_tgia);
    
       
        $stmt->execute();
    }
    //Xoá tác giả
        public function deleteAuthor($ma_tgia) {
        $db = new DBConnection();
        $conn = $db->getConnection();

        $query = "DELETE FROM tacgia WHERE ma_tgia = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $ma_tgia);
        $stmt->execute();
    }
    
    // Lấy thông tin tác giả theo ID
    public function getAuthorById($ma_tgia) {
        $db = new DbConnection();
        $conn = $db->getConnection();

        $sql = "SELECT ma_tgia, ten_tgia, hinh_tgia FROM tacgia WHERE ma_tgia = :ma_tgia";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':ma_tgia', $ma_tgia, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return new Author($result['ma_tgia'], $result['ten_tgia'], $result['hinh_tgia']);
        }
        return null; // Không tìm thấy tác giả
    }

    //Cập nhật tác giả
    public function updateAuthor($ma_tgia, $ten_tgia, $hinh_tgia = null) {
        $db = new DBConnection();
        $conn = $db->getConnection();

        $sql = "UPDATE tacgia SET ten_tgia = :ten_tgia, hinh_tgia = :hinh_tgia WHERE ma_tgia = :ma_tgia";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':ten_tgia', $ten_tgia);
        $stmt->bindParam(':hinh_tgia', $hinh_tgia);
        $stmt->bindParam(':ma_tgia', $ma_tgia, PDO::PARAM_INT);

        $stmt->execute();
    }
}
?>
