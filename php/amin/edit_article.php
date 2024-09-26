<?php
include 'C:\xampp\htdocs\php\db.php';  // Kết nối cơ sở dữ liệu

// Kiểm tra thông báo lỗi và lấy ID bài viết
$errorMsg = isset($_GET['error']) ? $_GET['error'] : '';
$postId = isset($_GET['id']) ? $_GET['id'] : null;

if ($postId) {
    // Truy vấn để lấy thông tin bài viết hiện tại
    $sql = "SELECT tieude, ten_bhat, ma_tloai, tomtat, noidung, ma_tgia, hinhanh FROM baiviet WHERE ma_bviet = ?";
    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param("i", $postId);
        $stmt->execute();
        $stmt->bind_result($postTitle, $songName, $categoryId, $summary, $content, $authorId, $image);
        
        if (!$stmt->fetch()) {
            header("Location: article.php?error=Bài viết không tồn tại.");
            exit;
        }
        
        $stmt->close();
    } else {
        header("Location: article.php?error=Lỗi kết nối cơ sở dữ liệu.");
        exit;
    }

    // Lấy danh sách thể loại
    $categorySql = "SELECT ma_tloai, ten_tloai FROM theloai";
    $categoryResult = $conn->query($categorySql);

    // Lấy danh sách tác giả
    $authorSql = "SELECT ma_tgia, ten_tgia FROM tacgia";
    $authorResult = $conn->query($authorSql);

} else {
    header("Location: baiviet.php?error=ID bài viết không hợp lệ.");
    exit;
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa bài viết</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
        
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Quản lý</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link" href="baiviet.php">Bài viết</a></li>
                        <li class="nav-item"><a class="nav-link" href="tacgia.php">Tác giả</a></li>
                        <li class="nav-item"><a class="nav-link" href="theloai.php">Thể loại</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    
    <main class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h3 class="text-center">Sửa thông tin bài viết</h3>
                <!-- Hiển thị thông báo lỗi nếu có -->
                <?php if ($errorMsg): ?>
                    <div class="alert alert-danger">
                        <?php echo htmlspecialchars($errorMsg); ?>
                    </div>
                <?php endif; ?>
                
                <form action="process_edit_article.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="txtPostId" value="<?php echo htmlspecialchars($postId); ?>">

                    <div class="mb-3">
                        <label for="txtPostTitle" class="form-label">Tiêu đề bài viết</label>
                        <input type="text" class="form-control" id="txtPostTitle" name="txtPostTitle" value="<?php echo htmlspecialchars($postTitle); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="txtSongName" class="form-label">Tên bài hát</label>
                        <input type="text" class="form-control" id="txtSongName" name="txtSongName" value="<?php echo htmlspecialchars($songName); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="txtSummary" class="form-label">Tóm tắt</label>
                        <textarea class="form-control" id="txtSummary" name="txtSummary" rows="3"><?php echo htmlspecialchars($summary); ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="txtContent" class="form-label">Nội dung</label>
                        <textarea class="form-control" id="txtContent" name="txtContent" rows="5" required><?php echo htmlspecialchars($content); ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="ddlCategory" class="form-label">Thể loại</label>
                        <select class="form-select" id="ddlCategory" name="ddlCategory" required>
                            <?php while ($row = $categoryResult->fetch_assoc()): ?>
                                <option value="<?php echo $row['ma_tloai']; ?>" <?php if ($row['ma_tloai'] == $categoryId) echo 'selected'; ?>>
                                    <?php echo htmlspecialchars($row['ten_tloai']); ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="ddlAuthor" class="form-label">Tác giả</label>
                        <select class="form-select" id="ddlAuthor" name="ddlAuthor" required>
                            <?php while ($row = $authorResult->fetch_assoc()): ?>
                                <option value="<?php echo $row['ma_tgia']; ?>" <?php if ($row['ma_tgia'] == $authorId) echo 'selected'; ?>>
                                    <?php echo htmlspecialchars($row['ten_tgia']); ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="fileImage" class="form-label">Hình ảnh</label>
                        <input type="file" class="form-control" id="fileImage" name="fileImage">
                        <?php if ($image): ?>
                            <img src="<?php echo htmlspecialchars($image); ?>" alt="Hình ảnh hiện tại" class="img-fluid mt-2" style="max-width: 200px;">
                        <?php endif; ?>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-success">Lưu lại</button>
                        <a href="article.php" class="btn btn-warning">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </main>
    
    <footer class="text-center mt-5">
        <p>&copy; 2023 TLU's music garden</p>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
