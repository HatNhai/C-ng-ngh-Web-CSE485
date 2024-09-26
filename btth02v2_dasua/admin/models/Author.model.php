<?php
require_once 'config/config.php';

class AuthorModel
{
    public static function getAll()
    {
        global $conn;
        $query = "SELECT ma_tgia, ten_tgia FROM tacgia";
        $result = $conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
