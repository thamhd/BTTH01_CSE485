<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/Demo_MVC_Simple/btth02v2/configs/DBConnection.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/Demo_MVC_Simple/btth02v2/models/Statistics.php');

class AdminController {
    private $model;

    public function __construct($pdo) {
        $this->model = new Statistics($pdo);
    }

    public function index() {
        $userCount = $this->model->getUserCount();
        $categoryCount = $this->model->getCategoryCount();
        $authorCount = $this->model->getAuthorCount();
        $articleCount = $this->model->getArticleCount();

        // Truyền các biến cần thiết vào view
        include $_SERVER['DOCUMENT_ROOT'] . '/Demo_MVC_Simple/btth02v2/views/admin/index_amin.php';
    }
}
?>
