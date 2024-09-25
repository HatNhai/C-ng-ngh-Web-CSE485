<?php
class Database {
    private static $conn;

    public static function connect() {
        if (!self::$conn) {
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "BTTH01_CSE485";
            self::$conn = new mysqli($servername, $username, $password, $dbname);

            if (self::$conn->connect_error) {
                die("Kết nối thất bại: " . self::$conn->connect_error);
            }
        }
        return self::$conn;
    }
}
?>