<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/Demo_MVC_Simple/btth02v2/services/CategoryService.php');

$categoryService = new CategoryService();
$categorys = $categoryService->getAllCategory();

// Kiểm tra nếu có tham số `id` được gửi để xoá thể loại
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $categoryId = $_GET['id'];
    $categoryService->deleteCategory($categoryId);

    // Sau khi xoá, điều hướng lại trang danh sách để cập nhật hiển thị
    header('Location: index_category.php');
    exit();
}
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
                        <a class="nav-link" aria-current="page" href="/Demo_MVC_Simple/btth02v2/views/admin/index_amin.php">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/Demo_MVC_Simple/btth02v2/views/home/home.php">Trang ngoài</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active fw-bold" href="index_category.php">Thể loại</a>
                    </li>   
                    <li class="nav-item">
                        <a class="nav-link " href="/Demo_MVC_Simple/btth02v2/views/author/index_author.php">Tác giả</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/Demo_MVC_Simple/btth02v2/views/article/index_article.php">Bài viết</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<main class="container mt-5 mb-5">
    <div class="row">
    <div class="col-sm">
            <a href="add_category.php" class="btn btn-success">Thêm mới</a>
            <table class="table">

                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tên thể loại</th>
                        <th>Sửa</th>
                        <th>Xóa</th>
                    </tr>
                </thead>

                <tbody>
                <?php 
                    //Duyet danh sach thể loại
                    foreach ($categorys as $index => $category) {
                        echo "<tr>";
                        echo "<th scope='row'>" . ($index + 1) . "</th>";
                        echo "<td>" . htmlspecialchars($category->getName()) . "</td>";
                        echo "<td><a href='edit_category.php?controller=category&id=" . $category->getId() . "' class='text-primary'><i class='fa-solid fa-pen-to-square'></i></a></td>";
                        echo "<td><a href='index_category.php?controller=category&action=delete&id=" . $category->getId() . "' class='text-danger'><i class='fa-solid fa-trash'></i></a></td>";
                        echo "</tr>";
                    }
                ?>
                </tbody>

            </table>
        </div>
    </div>
</main>

<footer class="bg-white d-flex justify-content-center align-items-center border-top border-secondary  border-2" style="height:80px">
    <h4 class="text-center text-uppercase fw-bold">TLU's music garden</h4>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

</body>
</html>