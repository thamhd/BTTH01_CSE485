<?php
include 'C:\xampp\htdocs\php\db.php'; // Kết nối đến cơ sở dữ liệu

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Xóa bài viết dựa trên mã bài viết
    $sql = "DELETE FROM baiviet WHERE ma_bviet = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Nếu cột SoLuongBaiViet không tồn tại, không cần cập nhật nó
        // Nếu cần cập nhật số lượng bài viết của tác giả, hãy dùng đúng tên cột hiện có

        // Chuyển hướng về trang danh sách bài viết với thông báo thành công
        header("Location: article.php?msg=Xóa bài viết thành công!");
        exit;
    } else {
        echo "Có lỗi xảy ra khi xóa bài viết: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "ID bài viết không hợp lệ.";
}

$conn->close();
?>
