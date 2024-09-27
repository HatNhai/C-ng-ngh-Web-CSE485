<?php
class Article{
    // Thuộc tính

    private $maBaiviet;
    private $tieuDe;
    private $tenBaihat;
    private $maTheloai;
    private $tomTat;
    private $noiDung;
    private $maTacgia;
    private $ngayViet;
    private $hinhAnh;


    public function __construct($maBaiviet,$tieuDe,$tenBaihat,$maTheloai,$tomTat,$noiDung,$maTacgia,$ngayViet,$hinhAnh){
        $this->maBaiviet = $maBaiviet;
        $this->tieuDe = $tieuDe;
        $this->tenBaihat = $tenBaihat;
        $this->maTheloai = $maTheloai;
        $this->tomTat = $tomTat;
        $this->noiDung = $noiDung;
        $this->maTacgia = $maTacgia;
        $this->ngayViet = $ngayViet;
        $this->hinhAnh = $hinhAnh;
    }

    // Setter và Getter
    public function getMaBviet(){
        return $this->maBaiviet;
    }

    public function setMaBviet($maBaiviet){
        return $this->maBaiviet = $maBaiviet;
    }

    public function getTieude(){
        return $this->tieuDe;
    }

    public function setTieude($tieuDe){
        return $this->tieuDe = $tieuDe;
    }

    public function getTenBhat()
    {
        return $this->tenBaihat;
    }

    public function setTenBhat($tenBaihat){
        return $this->tenBaihat = $tenBaihat;
    }

    public function getMaTloai(){
        return $this->maTheloai;
    }

    public function setMaTloai($maTheloai){
        return $this->maTheloai = $maTheloai;
    }

    public function getTomtat(){
        return $this->tomTat;
    }

    public function setTomtat($tomTat){
        return $this->tomTat = $tomTat;
    }

    public function getNoidung(){
        return $this->noiDung;
    }

    public function setNoidung($noiDung){
        return $this->noiDung = $noiDung;
    }

    public function getMaTgia(){
        return $this->maTacgia;
    }

    public function setMaTgia($maTacgia){
        return $this->maTacgia = $maTacgia;
    }

    public function getNgayviet(){
        return $this->ngayViet;
    }

    public function setNgayviet($ngayViet){
        return $this->ngayViet = $ngayViet;
    }

    public function getHinhanh(){
        return $this->hinhAnh;
    }

    public function setHinhanh($hinhAnh){
        return $this->hinhAnh = $hinhAnh;
    }
}