<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/Demo_MVC_Simple/btth02v2/services/ArticleService.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/Demo_MVC_Simple/btth02v2/services/CategoryService.php');

$articleService = new ArticleService();
$categoryService = new CategoryService();

// Kiểm tra nếu có tham số `id` để lấy bài viết cần sửa
if (isset($_GET['id'])) {
    $articleId = $_GET['id'];
    $article = $articleService->getArticleById($articleId); // Lấy bài viết theo ID
}

// Kiểm tra nếu có dữ liệu POST để cập nhật bài viết
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $categoryId = $_POST['category_id'];
    $authorName = $_POST['author_name'];

    // Cập nhật bài viết
    $articleService->updateArticle($articleId, $title, $categoryId, $authorName);

    // Sau khi cập nhật, điều hướng lại trang danh sách
    header('Location: index_article.php');
    exit();
}

$categories = $categoryService->getAllCategories(); // Lấy tất cả thể loại
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Bài Viết</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<main class="container mt-5 mb-5">
    <h2>Sửa Bài Viết</h2>
    <form method="POST" action="">
        <div class="mb-3">
            <label for="title" class="form-label">Tiêu đề</label>
            <input type="text" class="form-control" id="title" name="title" value="<?= htmlspecialchars($article->getTitle()) ?>" required>
        </div>
        <div class="mb-3">
            <label for="category_id" class="form-label">Thể loại</label>
            <select class="form-select" id="category_id" name="category_id" required>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category->getId() ?>" <?= $category->getId() === $article->getCategoryId() ? 'selected' : '' ?>>
                        <?= htmlspecialchars($category->getName()) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="author_name" class="form-label">Tên tác giả</label>
            <input type="text" class="form-control" id="author_name" name="author_name" value="<?= htmlspecialchars($article->getAuthorName()) ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
