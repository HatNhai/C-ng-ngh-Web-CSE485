<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/btth02v2_dasua/configs/DBConnection.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/btth02v2_dasua/models/Member.php');

class MemberService {
    public function findUser($username, $password) {
        $dbConn = new DBConnection();
        $conn = $dbConn->getConnection();  

        if ($conn === null) {
            return null; 
        }

     
        $sql = "SELECT * FROM users WHERE username = :username AND password = :password";

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password); 

        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            
            $member = new Member(
                $user['username'], 
                $user['password'] 
            );
            return $member; 
        }

        return null; 
    }
}
?>
