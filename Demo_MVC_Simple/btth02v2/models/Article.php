<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/Demo_MVC_Simple/btth02v2/services/AuthorService.php'); // Đảm bảo đường dẫn đúng

class Article {
    private $id;
    private $title;
    private $songName;
    private $categoryId;
    private $summary;
    private $content;
    private $authorId;
    private $publishDate;
    private $image;

    public function __construct($id, $title, $songName, $categoryId, $summary, $content, $authorId, $publishDate, $image = null) {
        $this->id = $id;
        $this->title = $title;
        $this->songName = $songName;
        $this->categoryId = $categoryId;
        $this->summary = $summary;
        $this->content = $content;
        $this->authorId = $authorId;
        $this->publishDate = $publishDate;
        $this->image = $image;
    }

    // Getter methods
    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getSongName() {
        return $this->songName;
    }

    public function getCategoryId() {
        return $this->categoryId;
    }

    public function getSummary() {
        return $this->summary;
    }

    public function getContent() {
        return $this->content;
    }

    public function getAuthorId() {
        return $this->authorId;
    }

    public function getPublishDate() {
        return $this->publishDate;
    }

    public function getImage() {
        return $this->image;
    }

    // Phương thức để lấy tên tác giả
    public function getAuthorName() {
        $authorService = new AuthorService();
        return $authorService->getAuthorNameById($this->authorId);
    }
}
?>