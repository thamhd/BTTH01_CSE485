<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/Demo_MVC_Simple/btth02v2/configs/DBConnection.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/Demo_MVC_Simple/btth02v2/models/Category.php');

class CategoryService {
    // Lấy tất cả các thể loại
    public function getAllCategory() {
        $db = new DbConnection();
        $conn = $db->getConnection(); 

        $sql = 'SELECT ma_tloai, ten_tloai FROM theloai';
        $stmt = $conn->query($sql);

        $categories = $stmt->fetchAll(PDO::FETCH_FUNC, function($ma_tloai, $ten_tloai) {
            return new Category($ma_tloai, $ten_tloai);
        });
        return $categories;
    }

    // Thêm tên thể loại vào bảng thể loại
    public function addCategory($ten_tloai) {
        $db = new DBConnection();
        $conn = $db->getConnection();
        
        // Lấy giá trị ma_tloai lớn nhất hiện tại
        $sql_get_max_id = "SELECT MAX(ma_tloai) AS max_id FROM theloai";
        $stmt = $conn->prepare($sql_get_max_id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $maxId = $result['max_id'] ?? 0;
        
        $newId = $maxId + 1;
        
        // Sử dụng prepared statement để thêm dữ liệu
        $sql = "INSERT INTO theloai (ma_tloai, ten_tloai) VALUES (:ma_tloai, :ten_tloai)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':ma_tloai', $newId);
        $stmt->bindParam(':ten_tloai', $ten_tloai);

        // Thực hiện câu lệnh
        $stmt->execute();
    }

    // Xoá thể loại
    public function deleteCategory($ma_tloai) {
        $db = new DBConnection();
        $conn = $db->getConnection();

        $query = "DELETE FROM theloai WHERE ma_tloai = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $ma_tloai);
        $stmt->execute();
    }

    // Lấy thông tin thể loại theo ID
    public function getCategoryById($ma_tloai) {
        $db = new DBConnection();
        $conn = $db->getConnection();

        $sql = "SELECT ma_tloai, ten_tloai FROM theloai WHERE ma_tloai = :ma_tloai";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':ma_tloai', $ma_tloai, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return new Category($result['ma_tloai'], $result['ten_tloai']);
        }
        return null; // Không tìm thấy thể loại
    }

    // Cập nhật thể loại
    public function updateCategory($ma_tloai, $ten_tloai) {
        $db = new DBConnection();
        $conn = $db->getConnection();

        $sql = "UPDATE theloai SET ten_tloai = :ten_tloai WHERE ma_tloai = :ma_tloai";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':ten_tloai', $ten_tloai);
        $stmt->bindParam(':ma_tloai', $ma_tloai, PDO::PARAM_INT);

        $stmt->execute();
    }

    // Phương thức để lấy tên thể loại dựa vào ID
    public function getCategoryNameById($categoryId) {
        $db = new DBConnection();
        $conn = $db->getConnection();

        // Truy vấn SQL để lấy tên thể loại
        $sql = "SELECT ten_tloai FROM theloai WHERE ma_tloai = :id"; // Đảm bảo sử dụng đúng tên cột và bảng
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $categoryId, PDO::PARAM_INT);
        $stmt->execute();

        // Lấy tên thể loại
        if ($stmt->rowCount() > 0) {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['ten_tloai']; // Sử dụng tên cột đúng từ bảng
        }

        return null; // Nếu không tìm thấy
    }

    

}
?>
