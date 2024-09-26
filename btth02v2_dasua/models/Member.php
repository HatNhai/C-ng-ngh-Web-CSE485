<?php
class Member {
    private $username;
    private $password;

    // Hàm khởi tạo
    public function __construct($username, $password) {
        $this->username = $username;
        $this->password = $password;
    }

    // Getter và Setter cho username
    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    // Getter và Setter cho password
    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }
}