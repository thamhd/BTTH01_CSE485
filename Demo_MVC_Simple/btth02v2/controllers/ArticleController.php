<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/Demo_MVC_Simple/btth02v2/services/ArticleService.php');

class ArticleController {
    private $articleService;

    public function __construct() {
        $this->articleService = new ArticleService();
    }

    public function get() {
        $articles = $this->articleService->getAllArticles();
        require_once($_SERVER['DOCUMENT_ROOT'] . '/Demo_MVC_Simple/btth02v2/views/article/index_article.php');
    }

    public function getArticleById($id) {
        return $this->articleService->getArticleById($id);
    }

    // Phương thức thêm mới bài viết
    public function addArticle() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'] ?? '';
            $songName = $_POST['song_name'] ?? '';
            $categoryId = $_POST['category_id'] ?? 0;
            $summary = $_POST['summary'] ?? '';
            $content = $_POST['content'] ?? '';
            $authorId = $_POST['author_id'] ?? 0;
            $image = null; // Nếu không có trường hình ảnh

            $this->articleService->addArticle($title, $songName, $categoryId, $summary, $content, $authorId, $image);

            // Điều hướng về trang danh sách sau khi thêm thành công
            header('Location: index_article.php?controller=article&action=get');
            exit(); // Đảm bảo kết thúc sau khi điều hướng
        }
    }

    // Phương thức xoá bài viết
    public function delete() {
        if (isset($_GET['id'])) { 
            $articleId = $_GET['id'];
            $this->articleService->deleteArticle($articleId);
            header('Location: index_article.php?controller=article&action=get');
            exit();
        }
    }

    // Phương thức cập nhật bài viết
    public function saveEditArticle() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $articleId = $_POST['article_id'];
            $title = $_POST['title'];
            $songName = $_POST['song_name'];
            $categoryId = $_POST['category_id'];
            $summary = $_POST['summary'];
            $content = $_POST['content'];
            $authorId = $_POST['author_id'];
            // $image = $_POST['image'] ?? null; // Nếu cần thêm hình ảnh

            // Gọi phương thức để cập nhật thông tin bài viết
            $this->articleService->updateArticle($articleId, $title, $songName, $categoryId, $summary, $content, $authorId);

            // Chuyển hướng về trang danh sách bài viết
            header('Location: index_article.php');
            exit();
        }
    }
    



}
?>
