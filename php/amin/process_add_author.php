<?php
include 'C:\xampp\htdocs\php\db.php'; // Kết nối database

        // Xử lý form khi được gửi
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $catName = $_POST['txtCatName'];

            // Thêm tacgia vào cơ sở dữ liệu
            $sql = "INSERT INTO tacgia (ten_tgia) VALUES (?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $catName);

            if ($stmt->execute()) {
                // Chuyển hướng về danh sách tacgia 
                header("Location: author.php?msg=Thêm tác giả thành công!");
                exit;
            } else {
                echo "<div class='alert alert-danger'>Lỗi: " . $stmt->error . "</div>";
            }

            $stmt->close();
     }
?>
        