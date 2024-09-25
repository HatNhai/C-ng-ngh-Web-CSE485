<?php
class UserModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function login($username, $password) {
        // Tránh SQL Injection
        $username = $this->conn->real_escape_string($username);
        $password = $this->conn->real_escape_string($password);

        // Truy vấn để kiểm tra tài khoản
        $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $result = $this->conn->query($sql);

        return $result->num_rows > 0;
    }
}
?>