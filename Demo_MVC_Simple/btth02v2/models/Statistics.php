<?php
class Statistics {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getUserCount() {
        // Thay thế bằng câu truy vấn SQL thực tế
        return 110; // Placeholder cho demo
    }

    public function getCategoryCount() {
        // Thay thế bằng câu truy vấn SQL thực tế
        return 10; // Placeholder cho demo
    }

    public function getAuthorCount() {
        // Thay thế bằng câu truy vấn SQL thực tế
        return 20; // Placeholder cho demo
    }

    public function getArticleCount() {
        // Thay thế bằng câu truy vấn SQL thực tế
        return 110; // Placeholder cho demo
    }
}
?>
