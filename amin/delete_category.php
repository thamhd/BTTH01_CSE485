<?php
include 'C:\xampp\htdocs\php\db.php';


if (isset($_GET['id'])) {
    $catId = $_GET['id'];

    // Xóa thể loại
    $sql = "DELETE FROM theloai WHERE ma_tloai = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $catId);

    if ($stmt->execute()) {
        // Chuyển hướng về trang danh sách thể loại với thông báo thành công
        header("Location: category.php?msg=Xóa thể loại thành công!");
        exit;
    } else {
        echo "Có lỗi xảy ra khi xóa thể loại: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "ID thể loại không hợp lệ.";
}
?>

