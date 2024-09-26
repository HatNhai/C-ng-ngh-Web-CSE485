<?php
require_once 'config/config.php';

class CategoryModel
{
    public static function getAll()
    {
        global $conn;
        $query = "SELECT ma_tloai, ten_tloai FROM theloai";
        $result = $conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
