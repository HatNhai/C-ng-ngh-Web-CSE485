<?php

class Category
{
    private $ma_tloai;
    private $ten_tloai;

    public function __construct($ma_tloai, $ten_tloai)
    {
        $this->ma_tloai = $ma_tloai;
        $this->ten_tloai = $ten_tloai;
    }

    public function getMaTLoai()
    {
        return $this->ma_tloai;
    }

    public function getTenTLoai()
    {
        return $this->ten_tloai;
    }

    public function setMaTLoai($ma_tloai)
    {
        $this->ma_tloai = $ma_tloai;
    }

    public function setTenTLoai($ten_tloai)
    {
        $this->ten_tloai = $ten_tloai;
    }
}

?>