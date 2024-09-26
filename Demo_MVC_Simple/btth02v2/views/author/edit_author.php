<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/Demo_MVC_Simple/btth02v2/controllers/AuthorController.php');

$controller = new AuthorController();

// Lấy ID tác giả từ query string
$ma_tgia = $_GET['id'] ?? null;

// Gọi phương thức để lấy thông tin tác giả dựa trên ID
if ($ma_tgia) {
    $author = $controller->getAuthorById($ma_tgia); // Gọi phương thức getAuthorById trong controller
    if (!$author) {
        echo "<p>Tác giả không tồn tại.</p>";
        exit();
    }
} else {
    echo "<p>ID tác giả không hợp lệ.</p>";
    exit();
}

//Cập nhật tác giả
$controller_2 = new AuthorController();
$controller_2->saveEditAuthor();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music for Life</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style_login.css">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary shadow p-3 bg-white rounded">
            <div class="container-fluid">
                <div class="h3">
                    <a class="navbar-brand" href="#">Administration</a>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="./">Trang chủ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../index.php">Trang ngoài</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="category.php">Thể loại</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active fw-bold" href="author.php">Tác giả</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="article.php">Bài viết</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main class="container mt-5 mb-5">
        <div class="row">
            <div class="col-sm">
                <h3 class="text-center text-uppercase fw-bold">Sửa thông tin tác giả</h3>

                <form action="edit_author.php?id=<?php echo $ma_tgia; ?>" method="post"> <!-- Cập nhật action của form -->
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblCatId">Mã tác giả</span>
                        <input type="text" class="form-control" name="txtCatId" readonly value="<?php echo htmlspecialchars($author->getId()); ?>"> <!-- Hiển thị ID -->
                    </div>

                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblCatName">Tên tác giả</span>
                        <input type="text" class="form-control" name="txtCatName" value="<?php echo htmlspecialchars($author->getName()); ?>"> <!-- Hiển thị tên tác giả -->
                    </div>

                    <div class="form-group float-end">
                        <input name="save" type="submit" value="Lưu lại" class="btn btn-success">
                        <a href="/Demo_MVC_Simple/btth02v2/views/author/index_author.php" class="btn btn-warning">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <footer class="bg-white d-flex justify-content-center align-items-center border-top border-secondary border-2" style="height:80px">
        <h4 class="text-center text-uppercase fw-bold">TLU's music garden</h4>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>
