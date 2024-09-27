<?php
include("configs/DBConnection.php");
include("models/Author.php");

class AuthorService {

    public function getAllAuthor() {
        // B1. Kết nối database
        $dbConn = new DBConnection();
        $conn = $dbConn->getConnection();

        // B2. Truy vấn cơ sở dữ liệu
        $sql = 'SELECT * FROM tacgia';
        $stmt = $conn->query($sql);

        // B3. Xử lý kết quả truy vấn
        $authors = [];
        while ($row = $stmt->fetch()) {
            $author = new Author($row['ma_tgia'], $row['ten_tgia'], $row['hinh_tgia']);
            array_push($authors, $author);
        }
        return $authors;
    }

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

   

    //Lấy thông tin tác giả
    public function getAuthorById($id) {
        try {
            $db = new DBConnection();
            $conn = $db->getConnection();

            $sql = "SELECT ma_tgia, ten_tgia, hinh_tgia FROM tacgia WHERE ma_tgia = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Lỗi truy vấn: " . $e->getMessage());
        }
    }

    // Cập nhật thông tin tác giả
    public function updateAuthor($id, $name, $image = null) {
        try {

            $db = new DBConnection();
            $conn = $db->getConnection();

            $sql = "UPDATE tacgia SET ten_tgia = :name" . ($image ? ", hinh_tgia = :image" : "") . " WHERE ma_tgia = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            if ($image) {
                $stmt->bindParam(':image', $image, PDO::PARAM_STR);
            }
            return $stmt->execute();
        } catch (PDOException $e) {
            die("Lỗi cập nhật: " . $e->getMessage());
        }
    }


    //Phần xoá tác giả
    public function deleteAuthor($ma_tgia) {
        try {
            $db = new DBConnection();
            $conn = $db->getConnection();
            
            // Câu lệnh xóa tác giả dựa trên ma_tgia
            $sql = "DELETE FROM tacgia WHERE ma_tgia = :ma_tgia";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':ma_tgia', $ma_tgia, PDO::PARAM_INT);
            
            return $stmt->execute();
        } catch (PDOException $e) {
            // Nếu có lỗi, bạn có thể log hoặc xử lý lỗi ở đây
            return false;
        }
    }
}
?>
