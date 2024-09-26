<?php
class UserModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function validateUser($username, $password) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        
        // Kiểm tra mật khẩu
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }
}
?>
