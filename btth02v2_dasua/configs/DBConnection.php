<?php

class DBConnection
{
    private $conn = null;

    public function __construct()
    {
        // B1. Kết nối DB Server
        try {
            $this->conn = new PDO('mysql:host=localhost;dbname=BTTH01_CSE485;port=3306', 'root', 'Ngochai01');
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getConnection()
    {
        return $this->conn;
    }
}
