<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/Demo_MVC_Simple/btth02v2/services/CategoryService.php');

class CategoryController {
    private $categoryService;

    public function __construct() {
        $this->categoryService = new CategoryService();
    }

    // Phương thức lấy danh sách thể loại
    public function get() {
        $categories = $this->categoryService->getAllCategory();
        require_once($_SERVER['DOCUMENT_ROOT'] . '/Demo_MVC_Simple/btth02v2/views/category/index_category.php');
    }

    // Phương thức lấy thể loại theo ID
    public function getCategoryById($id) {
        return $this->categoryService->getCategoryById($id);
    }

    // Phương thức thêm mới thể loại
    public function addCategory() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ten_tloai = $_POST['ten_tloai'] ?? '';

            // Thêm thể loại thông qua CategoryService
            $this->categoryService->addCategory($ten_tloai);

            // Điều hướng về trang danh sách sau khi thêm thành công
            header('Location: index_category.php?controller=category&action=get');
            exit(); 
        } else {
            // Nếu không phải phương thức POST, hiển thị form thêm thể loại
            require_once($_SERVER['DOCUMENT_ROOT'] . '/Demo_MVC_Simple/btth02v2/views/category/add_category.php');
        }
    }

    // Phương thức xoá thể loại
    public function delete() {
        if (isset($_GET['id'])) { 
            $ma_tloai = $_GET['id'];
            $this->categoryService->deleteCategory($ma_tloai);
            header('Location: index_category.php?controller=category&action=get');
            exit();
        }
    }

    // Phương thức cập nhật thể loại
    public function saveEditCategory() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ma_tloai = $_POST['txtCatId'];
            $ten_tloai = $_POST['txtCatName'];

            // Gọi phương thức để cập nhật thông tin thể loại
            $this->categoryService->updateCategory($ma_tloai, $ten_tloai);

            // Điều hướng về trang danh sách thể loại
            header('Location: index_category.php?controller=category&action=get');
            exit();
        } else {
            // Nếu không phải phương thức POST, hiển thị form sửa thể loại
            $ma_tloai = $_GET['id'] ?? null;
            if ($ma_tloai) {
                $category = $this->categoryService->getCategoryById($ma_tloai);
                if ($category) {
                    require_once($_SERVER['DOCUMENT_ROOT'] . '/Demo_MVC_Simple/btth02v2/views/category/edit_category.php');
                } else {
                    echo "<p>Thể loại không tồn tại.</p>";
                }
            } else {
                echo "<p>ID thể loại không hợp lệ.</p>";
            }
        }
    }
}
?>
