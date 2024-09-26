<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/btth02v2_dasua/configs/DBConnection.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/btth02v2_dasua/models/Article.php');

class ArticleService{
    public function getAllArticles(){
        // 4 bước thực hiện
       $dbConn = new DBConnection();
       $conn = $dbConn->getConnection();

        // B2. Truy vấn
        $sql = "SELECT * FROM baiviet";
        $stmt = $conn->query($sql);

        // B3. Xử lý kết quả
        $articles = [];
        while($row = $stmt->fetch()){
            $article = new Article($row['ma_bviet'],$row['tieude'],  $row['ten_bhat'], $row['ma_tloai'], $row['tomtat'], $row['noidung'], $row['ma_tgia'], $row['ngayviet'], $row['hinhanh']);
            array_push($articles,$article);
        }   
        // Mảng (danh sách) các đối tượng Article Model

        return $articles;
    }

    public function checkMaTgia($maTG){
        $dbConn = new DBConnection();
        $conn = $dbConn->getConnection();
        $sql_check_tacgia = "SELECT ma_tgia from tacgia where ma_tgia = :maTG";
        $temp_check_tacgia = $conn->prepare($sql_check_tacgia);
        $temp_check_tacgia -> execute(['maTG' => $maTG]);
        $listMa = $temp_check_tacgia -> fetch();
        return $listMa;
    }

    public function checkMaTloai($maTL){
        $dbConn = new DBConnection();
        $conn = $dbConn->getConnection();
        $sql_check_tloai = "SELECT ma_tloai from theloai where ma_tloai = :maTL";
        $temp_check_tloai = $conn->prepare($sql_check_tloai);
        $temp_check_tloai -> execute(['maTL' => $maTL]);
        $listMa = $temp_check_tloai -> fetch();
        return $listMa;
    }

    public function addArticle($title, $song, $sumary, $maTG, $maTL, $ngay, $noidung, $img){
        $dbConn = new DBConnection();
        $conn = $dbConn->getConnection();
        $sql= "INSERT INTO baiviet(tieude,ten_bhat,ma_tloai,tomtat,noidung,ma_tgia,ngayviet,hinhanh) VALUES(:tieude,:ten_bhat,:ma_tloai,:tomtat,:noidung,:ma_tgia,:ngayviet,:hinhanh)";
        $temp = $conn->prepare($sql);
        $temp -> execute(['tieude' => $title, 'ten_bhat' => $song, 'ma_tloai' => $maTL, 'tomtat' => $sumary, 'noidung' => $noidung, 'ma_tgia' => $maTG, 'ngayviet' => $ngay, 'hinhanh' => $img]);
    }

    public function viewEditBviet($id){
        $dbConn = new DBConnection();
        $conn = $dbConn->getConnection();
        $sql="SELECT *from baiviet where ma_bviet = :id ";
        $temp = $conn->prepare($sql);
        $temp-> execute(['id' => $id]);

        $row = $temp->fetch();
        $articles = new Article($row['ma_bviet'],$row['tieude'],  $row['ten_bhat'], $row['ma_tloai'], $row['tomtat'], $row['noidung'], $row['ma_tgia'], $row['ngayviet'], $row['hinhanh']);

        return $articles;
    }

    public function update($title,$song,$maTL,$sumary,$noidung,$maTG,$ngay,$img,$id){
        $dbConn = new DBConnection();
        $conn = $dbConn->getConnection();
        $sql="UPDATE baiviet SET tieude= :tieude, ten_bhat= :ten_bhat, ma_tloai= :ma_tloai, tomtat= :tomtat, noidung= :noidung, ma_tgia= :ma_tgia, ngayviet= :ngayviet, hinhanh= :hinhanh  
              WHERE ma_bviet= :ma_bviet ";
        $temp = $conn->prepare($sql);
        $temp -> execute(['tieude' => $title, 'ten_bhat' => $song, 'ma_tloai' => $maTL, 'tomtat' => $sumary, 'noidung' => $noidung, 'ma_tgia' => $maTG, 'ngayviet' => $ngay, 'hinhanh' => $img, 'ma_bviet' => $id]);
    }

    public function del($id){
        $dbConn = new DBConnection();
        $conn = $dbConn->getConnection();
        $sql = "DELETE from baiviet WHERE ma_bviet = :id";
        $temp = $conn -> prepare($sql);
        $temp->execute(['id' => $id]);
        $result = $temp->fetchAll();
        return count($result);
    }
}
?>
