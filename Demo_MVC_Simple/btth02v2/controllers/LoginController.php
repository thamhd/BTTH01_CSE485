<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/Demo_MVC_Simple/btth02v2/models/UserModel.php');

class LoginController {
    private $model;

    public function __construct($db) {
        $this->model = new UserModel($db);
    }

    public function login($username, $password) {
        // Kiểm tra tên đăng nhập và mật khẩu
        $user = $this->model->validateUser($username, $password);

        if ($user) {
            session_start();
            $_SESSION['user'] = $user; // Lưu thông tin người dùng vào session
            header("Location: /Demo_MVC_Simple/btth02v2/views/admin/index_amin.php");
            exit();
        } else {
            return "Tên đăng nhập hoặc mật khẩu không hợp lệ.";
        }
    }
}
?>
