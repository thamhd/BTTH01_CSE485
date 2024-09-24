<?php
include 'C:\xampp\htdocs\php\db.php';  // Kết nối cơ sở dữ liệu

// Kiểm tra xem form đã được submit chưa
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy dữ liệu từ form
    $postId = isset($_POST['txtPostId']) ? $_POST['txtPostId'] : null;
    $postTitle = isset($_POST['txtPostTitle']) ? $_POST['txtPostTitle'] : '';
    $songName = isset($_POST['txtSongName']) ? $_POST['txtSongName'] : '';
    $summary = isset($_POST['txtSummary']) ? $_POST['txtSummary'] : '';
    $content = isset($_POST['txtContent']) ? $_POST['txtContent'] : '';
    $categoryId = isset($_POST['ddlCategory']) ? $_POST['ddlCategory'] : null;
    $authorId = isset($_POST['ddlAuthor']) ? $_POST['ddlAuthor'] : null;

    // Kiểm tra xem có file ảnh được upload không
    if (isset($_FILES['fileImage']) && $_FILES['fileImage']['error'] == 0) {
        // Thư mục lưu trữ hình ảnh
        $uploadDir = 'uploads/';
        $imageName = basename($_FILES['fileImage']['name']);
        $uploadFile = $uploadDir . $imageName;
        
        // Kiểm tra và di chuyển ảnh vào thư mục uploads
        if (move_uploaded_file($_FILES['fileImage']['tmp_name'], $uploadFile)) {
            $imagePath = $uploadFile;  // Đường dẫn ảnh mới
        } else {
            header("Location: edit_article.php?id=$postId&error=Không thể tải ảnh lên.");
            exit;
        }
    } else {
        // Nếu không có ảnh mới được tải lên, giữ nguyên ảnh cũ
        $imagePath = isset($_POST['currentImage']) ? $_POST['currentImage'] : null;
    }

    // Kiểm tra dữ liệu hợp lệ trước khi cập nhật
    if (!$postId || !$postTitle || !$songName || !$content || !$categoryId || !$authorId) {
        header("Location: edit_article.php?id=$postId&error=Vui lòng nhập đầy đủ thông tin.");
        exit;
    }

    // Câu lệnh SQL để cập nhật bài viết
    $sql = "UPDATE baiviet 
            SET tieude = ?, ten_bhat = ?, ma_tloai = ?, tomtat = ?, noidung = ?, ma_tgia = ?, hinhanh = ? 
            WHERE ma_bviet = ?";

    // Chuẩn bị truy vấn và bind các giá trị
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("ssissssi", $postTitle, $songName, $categoryId, $summary, $content, $authorId, $imagePath, $postId);

        // Thực thi câu lệnh và kiểm tra kết quả
        if ($stmt->execute()) {
            header("Location: article.php?success=Cập nhật bài viết thành công.");
        } else {
            header("Location: edit_article.php?id=$postId&error=Có lỗi xảy ra khi cập nhật bài viết.");
        }

        $stmt->close();
    } else {
        header("Location: edit_article.php?id=$postId&error=Lỗi kết nối cơ sở dữ liệu.");
    }

    // Đóng kết nối
    $conn->close();
} else {
    header("Location: article.php");
    exit;
}
?>
