<?php
class Author{
    // Thuộc tính

    private $maTacgia;
    private $tenTacgia;
    private $hinhTacgia;


    public function __construct($maTacgia,$tenTacgia,$hinhTacgia = null){
        $this->maTacgia = $maTacgia;
        $this->tenTacgia = $tenTacgia;
        $this->hinhTacgia = $hinhTacgia;
        
    }

    // Setter và Getter
    public function getMaTacgia(){
        return $this->maTacgia;
    }

    public function getTenTgia(){
        return $this->tenTacgia;
    }

    public function getHinhTgia()
    {
        return $this->hinhTacgia;
    }

}