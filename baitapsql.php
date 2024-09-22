<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    include 'C:\xampp\htdocs\php\db.php'; // Kết nối CSDL
// a. Liệt kê các bài viết về các bài hát thuộc thể loại Nhạc trữ tình
$sql_a = "SELECT * FROM baiviet bv 
          JOIN theloai tl ON bv.ma_tloai = tl.ma_tloai 
          WHERE tl.ten_tloai = 'Nhạc trữ tình'";
$result_a = $conn->query($sql_a);

// b. Liệt kê các bài viết của tác giả “Nhacvietplus”
$sql_b = "SELECT * FROM baiviet bv 
          JOIN tacgia tg ON bv.ma_tgia = tg.ma_tgia 
          WHERE tg.ten_tgia = 'Nhacvietplus'";
$result_b = $conn->query($sql_b);

// c. Liệt kê các thể loại nhạc chưa có bài viết cảm nhận nào
$sql_c = "SELECT * FROM theloai tl WHERE NOT EXISTS 
          (SELECT 1 FROM baiviet bv WHERE bv.ma_tloai = tl.ma_tloai)";
$result_c = $conn->query($sql_c);

// d. Liệt kê các bài viết với các thông tin mã bài viết, tên bài viết, tên bài hát, tên tác giả, tên thể loại, ngày viết
$sql_d = "SELECT bv.ma_bviet, bv.tieude, bv.ten_bhat, tg.ten_tgia, tl.ten_tloai, bv.ngayviet 
          FROM baiviet bv 
          JOIN theloai tl ON bv.ma_tloai = tl.ma_tloai 
          JOIN tacgia tg ON bv.ma_tgia = tg.ma_tgia";
$result_d = $conn->query($sql_d);

// e. Tìm thể loại có số bài viết nhiều nhất
$sql_e = "SELECT tl.ten_tloai, COUNT(bv.ma_bviet) AS so_bai_viet 
          FROM baiviet bv 
          JOIN theloai tl ON bv.ma_tloai = tl.ma_tloai 
          GROUP BY tl.ma_tloai 
          ORDER BY so_bai_viet DESC LIMIT 1";
$result_e = $conn->query($sql_e);

// f. Liệt kê 2 tác giả có số bài viết nhiều nhất
$sql_f = "SELECT tg.ten_tgia, COUNT(bv.ma_bviet) AS so_bai_viet 
          FROM baiviet bv 
          JOIN tacgia tg ON bv.ma_tgia = tg.ma_tgia 
          GROUP BY tg.ma_tgia 
          ORDER BY so_bai_viet DESC LIMIT 2";
$result_f = $conn->query($sql_f);

// Hiển thị kết quả
if ($result_a->num_rows > 0) {
    echo "<h3>a. Bài viết về Nhạc trữ tình:</h3>";
    while($row = $result_a->fetch_assoc()) {
        echo "Mã bài viết: " . $row["ma_bviet"] . " - Tiêu đề: " . $row["tieude"] . "<br>";
    }
}

if ($result_b->num_rows > 0) {
    echo "<h3>b. Bài viết của tác giả Nhacvietplus:</h3>";
    while($row = $result_b->fetch_assoc()) {
        echo "Mã bài viết: " . $row["ma_bviet"] . " - Tiêu đề: " . $row["tieude"] . "<br>";
    }
}

if ($result_c->num_rows > 0) {
    echo "<h3>c. Thể loại chưa có bài viết:</h3>";
    while($row = $result_c->fetch_assoc()) {
        echo "Mã thể loại: " . $row["ma_tloai"] . " - Tên thể loại: " . $row["ten_tloai"] . "<br>";
    }
}

if ($result_d->num_rows > 0) {
    echo "<h3>d. Thông tin các bài viết:</h3>";
    while($row = $result_d->fetch_assoc()) {
        echo "Mã bài viết: " . $row["ma_bviet"] . " - Tiêu đề: " . $row["tieude"] . " - Tên bài hát: " . $row["ten_bhat"] . 
             " - Tác giả: " . $row["ten_tgia"] . " - Thể loại: " . $row["ten_tloai"] . " - Ngày viết: " . $row["ngayviet"] . "<br>";
    }
}

if ($result_e->num_rows > 0) {
    echo "<h3>e. Thể loại có số bài viết nhiều nhất:</h3>";
    $row = $result_e->fetch_assoc();
    echo "Thể loại: " . $row["ten_tloai"] . " - Số bài viết: " . $row["so_bai_viet"] . "<br>";
}

if ($result_f->num_rows > 0) {
    echo "<h3>f. 2 Tác giả có số bài viết nhiều nhất:</h3>";
    while($row = $result_f->fetch_assoc()) {
        echo "Tác giả: " . $row["ten_tgia"] . " - Số bài viết: " . $row["so_bai_viet"] . "<br>";
    }
}
$sql = "SELECT * FROM baiviet WHERE ten_bhat LIKE '%yêu%' 
        OR ten_bhat LIKE '%thương%' 
        OR ten_bhat LIKE '%anh%' 
        OR ten_bhat LIKE '%em%'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h3>g. Các bài hát chứa từ 'yêu', 'thương', 'anh', 'em':</h3>";
    while($row = $result->fetch_assoc()) {
        echo "Mã bài viết: " . $row["ma_bviet"] . " - Tên bài hát: " . $row["ten_bhat"] . "<br>";
    }
} else {
    echo "Không có bài hát nào.";
}


$sql = "SELECT * FROM baiviet WHERE tieude LIKE '%yêu%' 
        OR tieude LIKE '%thương%' 
        OR tieude LIKE '%anh%' 
        OR tieude LIKE '%em%' 
        OR ten_bhat LIKE '%yêu%' 
        OR ten_bhat LIKE '%thương%' 
        OR ten_bhat LIKE '%anh%' 
        OR ten_bhat LIKE '%em%'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h3>h. Các bài viết hoặc bài hát chứa từ 'yêu', 'thương', 'anh', 'em':</h3>";
    while($row = $result->fetch_assoc()) {
        echo "Mã bài viết: " . $row["ma_bviet"] . " - Tiêu đề: " . $row["tieude"] . " - Tên bài hát: " . $row["ten_bhat"] . "<br>";
    }
} else {
    echo "Không có bài viết nào.";
}

echo "<h3>i. Tạo view có tên vw_Music để hiển thị thông tin về danh sách các bài viết kèm theo tên thể loại và tên tác giả:</h3>";
// Sử dụng CREATE OR REPLACE VIEW để thay thế nếu view đã tồn tại
$sql = "CREATE OR REPLACE VIEW vw_Music AS 
        SELECT baiviet.ma_bviet, baiviet.tieude, baiviet.ten_bhat, theloai.ten_tloai, tacgia.ten_tgia 
        FROM baiviet 
        JOIN theloai ON baiviet.ma_tloai = theloai.ma_tloai 
        JOIN tacgia ON baiviet.ma_tgia = tacgia.ma_tgia";

if ($conn->query($sql) === TRUE) {
    echo "View 'vw_Music' đã được tạo thành công hoặc cập nhật.";
} else {
    echo "Lỗi khi tạo view: " . $conn->error;
}

// Truy vấn dữ liệu từ view vw_Music
$sql = "SELECT * FROM vw_Music";
$result = $conn->query($sql);

// Kiểm tra và hiển thị dữ liệu
if ($result->num_rows > 0) {
    echo "<table border='1'>
            <tr>
                <th>Mã bài viết</th>
                <th>Tiêu đề</th>
                <th>Tên bài hát</th>
                <th>Thể loại</th>
                <th>Tác giả</th>
            </tr>";
    // Lặp qua từng hàng dữ liệu và hiển thị
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['ma_bviet'] . "</td>
                <td>" . $row['tieude'] . "</td>
                <td>" . $row['ten_bhat'] . "</td>
                <td>" . $row['ten_tloai'] . "</td>
                <td>" . $row['ten_tgia'] . "</td>
            </tr>";
    }
    echo "</table>";
} else {
    echo "Không có bài viết nào.";
}

echo "<h3>j. Tạo thủ tục có tên sp_DSBaiViet với tham số truyền vào là tên thể loại và trả về danh sách bài viết:</h3>";


echo "<h3>k. Thêm cột SLBaiViet vào bảng theloai và tạo trigger có tên tg_CapNhatTheLoai để cập nhật số lượng bài viết:</h3>";
//Xóa trigger nếu nó đã tồn tại:
$dropTrigger = "DROP TRIGGER IF EXISTS tg_CapNhatTheLoai_Insert";
if ($conn->query($dropTrigger) === TRUE) {
    echo "Trigger đã bị xóa (nếu tồn tại).";
} else {
    echo "Lỗi khi xóa trigger: " . $conn->error;
}

// Tạo lại trigger cho AFTER INSERT
$sql_insert_trigger = "CREATE TRIGGER tg_CapNhatTheLoai_Insert
                       AFTER INSERT ON baiviet
                       FOR EACH ROW
                       BEGIN
                           UPDATE theloai
                           SET SLBaiViet = (SELECT COUNT(*) FROM baiviet WHERE ma_tloai = NEW.ma_tloai)
                           WHERE ma_tloai = NEW.ma_tloai;
                       END;";

if ($conn->query($sql_insert_trigger) === TRUE) {
    echo "Trigger 'tg_CapNhatTheLoai_Insert' đã được tạo thành công.";
} else {
    echo "Lỗi khi tạo trigger: " . $conn->error;
}


echo "<h3>l. Bổ sung thêm bảng Users để lưu thông tin tài khoản đăng nhập và sử dụng chức năng đăng nhập/quản trị trang web:</h3>";
// Xóa bảng nếu nó đã tồn tại
$dropTable = "DROP TABLE IF EXISTS users";
if ($conn->query($dropTable) === TRUE) {
    echo "Bảng đã bị xóa (nếu tồn tại).<br>";
} else {
    echo "Lỗi khi xóa bảng: " . $conn->error . "<br>";
} 
// Tạo bảng Users
$sql_create_users = "CREATE TABLE Users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql_create_users) === TRUE) {
    echo "Bảng 'Users' đã được tạo thành công.";
} else {
    echo "Lỗi khi tạo bảng: " . $conn->error;
}


    // Đếm số lượng thể loại
    $sql_theloai = "SELECT COUNT(ma_tloai) AS count_theloai FROM theloai";
    $result_theloai = $conn->query($sql_theloai);
    $count_theloai = $result_theloai->fetch_assoc()['count_theloai'];

    // Đếm số lượng tác giả
    $sql_tacgia = "SELECT COUNT(ma_tgia) AS count_tacgia FROM tacgia";
    $result_tacgia = $conn->query($sql_tacgia);
    $count_tacgia = $result_tacgia->fetch_assoc()['count_tacgia'];

    // Đếm số lượng bài viết
    $sql_baiviet = "SELECT COUNT(ma_bviet) AS count_baiviet FROM baiviet";
    $result_baiviet = $conn->query($sql_baiviet);
    $count_baiviet = $result_baiviet->fetch_assoc()['count_baiviet'];

    // // Đếm số lượng người dùng (Giả sử bạn có bảng 'users')
    // $sql_users = "SELECT COUNT(id) AS count_users FROM users";
    // $result_users = $conn->query($sql_users);
    // $count_users = $result_users->fetch_assoc()['count_users'];

?>

</body>
</html>