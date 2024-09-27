<?php
include("configs/DBConnection.php");
include("models/Category.php");
class CategoryService{
    public function getAllCategories(){
        // 4 bước thực hiện
       $dbConn = new DBConnection();
       $conn = $dbConn->getConnection();

        // B2. Truy vấn
        $sql = "SELECT * FROM theloai";
        $stmt = $conn->query($sql);

        // B3. Xử lý kết quả
        $categories = [];
        while($row = $stmt->fetch()){
            $category = new Category($row['ma_tloai'], $row['ten_tloai']);
            array_push($categories,$category);
        }
        // Mảng (danh sách) các đối tượng Category Model

        return $categories;
    }

    public function addCategory($ten_tloai){
        $db = new DBConnection();
        $conn = $db->getConnection();

        $sql_get_max_id = "SELECT max(ma_tloai) as max_id from theloai";
        $stmt = $conn->prepare($sql_get_max_id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $maxID = $result['max_id'] ?? 0;

        $newID = $maxID + 1;

        $sql = "INSERT INTO theloai(ma_tloai, ten_tloai) VALUES (:ma_tloai, :ten_tloai)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':ma_tloai', $newID);
        $stmt->bindParam(':ten_tloai',$ten_tloai);
        $stmt->execute();
    }


    public function getCategoryById($ma_tloai) {
        try {
            $db = new DbConnection();
            $conn = $db->getConnection();

            $sql = "SELECT ma_tloai, ten_tloai FROM theloai WHERE ma_tloai = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $ma_tloai, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Lỗi truy vấn: " . $e->getMessage());
        }
    }


    public function updateCategory($ma_tloai, $ten_tloai) {
        try {
            $db = new DbConnection(); // Kết nối PDO
            $conn = $db->getConnection();

            $sql = "UPDATE theloai SET ten_tloai = :name WHERE ma_tloai = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':name', $ten_tloai, PDO::PARAM_STR);
            $stmt->bindParam(':id', $ma_tloai, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            die("Lỗi cập nhật: " . $e->getMessage());
        }
    }

    public function deleteCategory($ma_tloai) {
        try {
            $db = new DBConnection();
            $conn = $db->getConnection();
            
            // Câu lệnh xóa tác giả dựa trên ma_tgia
            $sql = "DELETE FROM theloai WHERE ma_tloai = :ma_tloai";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':ma_tloai', $ma_tloai, PDO::PARAM_INT);
            
            return $stmt->execute();
        } catch (PDOException $e) {
            // Nếu có lỗi, bạn có thể log hoặc xử lý lỗi ở đây
            return false;
        }
    }
}