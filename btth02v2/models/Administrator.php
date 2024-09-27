<?php 
class Administration {
    private $sum_Users;
    private $sum_Category;
    private $sum_Author;
    private $sum_Article;

    // Constructor
    public function __construct($sum_Users , $sum_Category, $sum_Author , $sum_Article) {
        $this->sum_Users = $sum_Users;
        $this->sum_Category = $sum_Category;
        $this->sum_Author = $sum_Author;
        $this->sum_Article = $sum_Article;
    }

    public function getSumUsers() {
        return $this->sum_Users;
    }

    public function getSumCategory() {
        return $this->sum_Category;
    }

    public function getSumAuthor() {
        return $this->sum_Author;
    }

    public function getSumArticle() {
        return $this->sum_Article;
    }
}
?>
