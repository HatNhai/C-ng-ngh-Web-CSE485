<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . '/btth02v2_dasua/configs/DBConnection.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/btth02v2_dasua/models/Administration.php');

class AdminiService {
    public function getAllUsers() {
        $dbConn = new DBConnection();
        $conn = $dbConn->getConnection();  
        if ($conn === null) {
            return null; 
        }  
        
        $sqlUsers = "SELECT COUNT(*) as sum_users FROM users";
        $stmtUsers = $conn->prepare($sqlUsers);
        $stmtUsers->execute();
        $sum_users = $stmtUsers->fetchColumn();

        
        $sqlAuthors = "SELECT COUNT(*) as sum_authors FROM tacgia";
        $stmtAuthors = $conn->prepare($sqlAuthors);
        $stmtAuthors->execute();
        $sum_authors = $stmtAuthors->fetchColumn();

    
        $sqlCategories = "SELECT COUNT(*) as sum_categories FROM theloai";
        $stmtCategories = $conn->prepare($sqlCategories);
        $stmtCategories->execute();
        $sum_categories = $stmtCategories->fetchColumn();

        $sqlArticles = "SELECT COUNT(*) as sum_articles FROM baiviet";
        $stmtArticles = $conn->prepare($sqlArticles);
        $stmtArticles->execute();
        $sum_articles = $stmtArticles->fetchColumn();

    
        return new Administration($sum_users, $sum_categories, $sum_authors, $sum_articles);
    }
}
?>