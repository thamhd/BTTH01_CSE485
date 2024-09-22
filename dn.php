<?php
session_start(); // Khởi động phiên

// Kết nối đến cơ sở dữ liệu
include 'C:\xampp\htdocs\php\db.php';

// Khởi tạo biến thông báo lỗi nếu có
$error_message = "";

// Nhận thông tin từ biểu mẫu đăng nhập
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];

    // Truy vấn để lấy thông tin người dùng
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Kiểm tra mật khẩu
        if (password_verify($password, $row['password'])) {
            // Đăng nhập thành công, lưu thông tin vào session
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = $row['role'];

            // Chuyển hướng đến trang chủ
            header("Location: index.php"); // Đảm bảo rằng đường dẫn này là đúng
            exit(); // Đảm bảo thoát ngay sau khi chuyển hướng
        } else {
            $error_message = "Mật khẩu không đúng.";
        }
    } else {
        $error_message = "Tên người dùng không tồn tại.";
    }
}

$conn->close();
?>

<!-- Hiển thị thông báo lỗi (nếu có) -->
<?php if (!empty($error_message)): ?>
    <div class="error-message">
        <?php echo $error_message; ?>
    </div>
<?php endif; ?>
