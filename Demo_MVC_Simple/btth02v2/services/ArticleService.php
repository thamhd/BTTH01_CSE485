<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/Demo_MVC_Simple/btth02v2/configs/DBConnection.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/Demo_MVC_Simple/btth02v2/models/Article.php');


class ArticleService {
    // Lấy tất cả các bài viết
    public function getAllArticles() {
        $db = new DbConnection();
        $conn = $db->getConnection(); 

        $sql = 'SELECT ma_bviet, tieude, ten_bhat, ma_tloai, tomtat, noidung, ma_tgia, ngayviet, hinhanh FROM baiviet';
        $stmt = $conn->query($sql);

        $articles = $stmt->fetchAll(PDO::FETCH_FUNC, function($ma_bviet, $tieude, $ten_bhat, $ma_tloai, $tomtat, $noidung, $ma_tgia, $ngayviet, $hinhanh) {
            return new Article($ma_bviet, $tieude, $ten_bhat, $ma_tloai, $tomtat, $noidung, $ma_tgia, $ngayviet, $hinhanh);
        });
        return $articles;
    }

    // Thêm bài viết vào bảng bài viết
    public function addArticle($title, $songName, $categoryId, $summary, $content, $authorId, $image = null) {
        $db = new DbConnection();
        $conn = $db->getConnection();

        // Lấy giá trị ma_bviet lớn nhất hiện tại
        $sql_get_max_id = "SELECT MAX(ma_bviet) AS max_id FROM baiviet";
        $stmt = $conn->prepare($sql_get_max_id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $maxId = $result['max_id'] ?? 0;

        $newId = $maxId + 1;

        // Sử dụng prepared statement để thêm dữ liệu
        $sql = "INSERT INTO baiviet (ma_bviet, tieude, ten_bhat, ma_tloai, tomtat, noidung, ma_tgia, ngayviet, hinhanh) VALUES (:ma_bviet, :tieude, :ten_bhat, :ma_tloai, :tomtat, :noidung, :ma_tgia, NOW(), :hinhanh)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':ma_bviet', $newId);
        $stmt->bindParam(':tieude', $title);
        $stmt->bindParam(':ten_bhat', $songName);
        $stmt->bindParam(':ma_tloai', $categoryId);
        $stmt->bindParam(':tomtat', $summary);
        $stmt->bindParam(':noidung', $content);
        $stmt->bindParam(':ma_tgia', $authorId);
        $stmt->bindParam(':hinhanh', $image);

        $stmt->execute();
    }

    // Xoá bài viết
    public function deleteArticle($ma_bviet) {
        $db = new DbConnection();
        $conn = $db->getConnection();

        $query = "DELETE FROM baiviet WHERE ma_bviet = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $ma_bviet);
        $stmt->execute();
    }

    // Lấy thông tin bài viết theo ID
    public function getArticleById($ma_bviet) {
        $db = new DbConnection();
        $conn = $db->getConnection();

        $sql = "SELECT ma_bviet, tieude, ten_bhat, ma_tloai, tomtat, noidung, ma_tgia, ngayviet, hinhanh FROM baiviet WHERE ma_bviet = :ma_bviet";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':ma_bviet', $ma_bviet, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return new Article($result['ma_bviet'], $result['tieude'], $result['ten_bhat'], $result['ma_tloai'], $result['tomtat'], $result['noidung'], $result['ma_tgia'], $result['ngayviet'], $result['hinhanh']);
        }
        return null; // Không tìm thấy bài viết
    }

    // Cập nhật bài viết
    public function updateArticle($ma_bviet, $title, $songName, $categoryId, $summary, $content, $authorId, $image = null) {
        $db = new DbConnection();
        $conn = $db->getConnection();

        $sql = "UPDATE baiviet SET tieude = :tieude, ten_bhat = :ten_bhat, ma_tloai = :ma_tloai, tomtat = :tomtat, noidung = :noidung, ma_tgia = :ma_tgia, hinhanh = :hinhanh WHERE ma_bviet = :ma_bviet";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':tieude', $title);
        $stmt->bindParam(':ten_bhat', $songName);
        $stmt->bindParam(':ma_tloai', $categoryId);
        $stmt->bindParam(':tomtat', $summary);
        $stmt->bindParam(':noidung', $content);
        $stmt->bindParam(':ma_tgia', $authorId);
        $stmt->bindParam(':hinhanh', $image);
        $stmt->bindParam(':ma_bviet', $ma_bviet, PDO::PARAM_INT);

        $stmt->execute();
    }
}
?>
