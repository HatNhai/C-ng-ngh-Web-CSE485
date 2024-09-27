<?php
class Article{
    // Thuộc tính

    private $tieude;
    private $tomtat;
    private $ten_tloai;


    public function __construct($tieude, $tomtat, $ten_tloai){
        $this->tieude = $tieude;
        $this->tomtat = $tomtat;
        $this->ten_tloai = $ten_tloai;
    }

    // Setter và Getter
    public function getTitle(){
        return $this->tieude;
    }
}