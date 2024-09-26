<!-- Routing là gì? Định tuyến/Điều hướng -->
<!-- Phân tích xem: URL của người dùng > Muốn gì -->
<!-- Ví dụ: Trang chủ, Quản lý bài viết hay Thêm bài viết -->
<!-- Chuyển quyền cho Controller tương ứng điều khiển tiếp -->
<!-- URL của tôi thiết kế luôn có dạng: -->

<!-- http://localhost/btth02v2/index.php?controller=A&action=B -->
<!-- http://localhost/btth02v2/index.php -->
<!-- http://localhost/btth02v2/index.php?controller=home&action=index -->

<!-- Controller là tên của FILE controller mà chúng ta sẽ gọi -->
<!-- Action là tên cả HÀM trong FILE controller mà chúng ta gọi -->




<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/Demo_MVC_Simple/btth02v2/configs/DBConnection.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/Demo_MVC_Simple/btth02v2/controllers/AdminController.php');

// Tạo kết nối PDO
$pdo = new DBConnection(); // Đảm bảo rằng DBConnection trả về một đối tượng PDO
$controller = new AdminController($pdo);
$controller->index();
?>
