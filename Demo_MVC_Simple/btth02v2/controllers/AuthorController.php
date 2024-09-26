<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/Demo_MVC_Simple/btth02v2/services/AuthorService.php');

class AuthorController{
     private $authorService;

    public function __construct(){
        $this->authorService = new AuthorService();
    }

    public function get() {
        $authors = $this->authorService->getAllAuthor();
        require_once($_SERVER['DOCUMENT_ROOT'] . '/Demo_MVC_Simple/btth02v2/views/author/index_author.php');
    }

    public function getAuthorById($id) {
        return $this->authorService->getAuthorById($id);
    }

    // Phương thức thêm mới tác giả
    public function addAuthor() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ten_tgia = $_POST['ten_tgia'] ?? '';
            $hinh_tgia = null; // nếu không có trường hình ảnh
    
            $this->authorService->addAuthor($ten_tgia, $hinh_tgia);
    
            // Điều hướng về trang danh sách sau khi thêm thành công
            header('Location: index_author.php?controller=author&action=get');
            exit(); // Đảm bảo kết thúc sau khi điều hướng
        }
    }
    //Phương thức xoá tác giả
    public function delete() {
            if (isset($_GET['id'])) { 
                $ma_tgia = $_GET['id'];
                $this->authorService->deleteAuthor($ma_tgia);
                header('Location: index_author.php?controller=author&action=get');
                exit();
            }
        }
    
    //Phương thức cập nhật tác giả
    public function saveEditAuthor() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ma_tgia = $_POST['txtCatId'];
            $ten_tgia = $_POST['txtCatName'];

            // Gọi phương thức để cập nhật thông tin tác giả
            $this->authorService->updateAuthor($ma_tgia, $ten_tgia);

            // Chuyển hướng về trang danh sách tác giả
            header('Location: index_author.php');
            exit();
        }
    }
    
}
?>
