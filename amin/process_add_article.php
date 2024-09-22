<?php
include 'C:\xampp\htdocs\php\db.php'; // Kết nối với cơ sở dữ liệu

// Kiểm tra nếu form đã được submit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy dữ liệu từ form
    $tieude = $conn->real_escape_string($_POST['tieude']);
    $ten_bhat = $conn->real_escape_string($_POST['ten_bhat']);
    $ma_tloai = intval($_POST['ma_tloai']);
    $ma_tgia = intval($_POST['ma_tgia']);
    $tomtat = $conn->real_escape_string($_POST['tomtat']);
    $noidung = $conn->real_escape_string($_POST['noidung']);

    // Xử lý hình ảnh
    $hinhanh = "";
    if (isset($_FILES['hinhanh']) && $_FILES['hinhanh']['error'] == 0) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["hinhanh"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Kiểm tra file có phải là ảnh không
        $check = getimagesize($_FILES["hinhanh"]["tmp_name"]);
        if ($check !== false) {
            if (move_uploaded_file($_FILES["hinhanh"]["tmp_name"], $target_file)) {
                $hinhanh = $target_file;
            } else {
                echo "Lỗi khi tải ảnh.";
            }
        } else {
            echo "File không phải là ảnh.";
        }
    }

    // Câu truy vấn SQL để thêm bài viết vào bảng baiviet
    $sql = "INSERT INTO baiviet (tieude, ten_bhat, ma_tloai, tomtat, noidung, ma_tgia, hinhanh)
            VALUES ('$tieude', '$ten_bhat', $ma_tloai, '$tomtat', '$noidung', $ma_tgia, '$hinhanh')";

    // Thực thi câu truy vấn
    if ($conn->query($sql) === TRUE) {
        // Chuyển hướng về trang chính với thông báo thành công
        header('Location: article.php?msg=Thêm bài viết thành công');
    } else {
        echo "Lỗi: " . $sql . "<br>" . $conn->error;
    }

    // Đóng kết nối
    $conn->close();
}
?>
