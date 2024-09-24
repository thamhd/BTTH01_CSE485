<?php
include 'C:\xampp\htdocs\php\db.php'; // Kết nối database
if ($conn->connect_error) {
    die("Kết nối cơ sở dữ liệu thất bại: " . $conn->connect_error);
}


        // Xử lý form khi được gửi
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $catName = $_POST['txtCatName'];

            // Thêm theloai vào cơ sở dữ liệu
            $sql = "INSERT INTO theloai (ten_tloai) VALUES (?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $catName);

            if ($stmt->execute()) {
                // Chuyển hướng về danh sách the loai
                header("Location: category.php?msg=Thêm thể loại thành công!");
                exit;
            } else {
                echo "<div class='alert alert-danger'>Lỗi: " . $stmt->error . "</div>";
            }

            $stmt->close();
        }
        ?>