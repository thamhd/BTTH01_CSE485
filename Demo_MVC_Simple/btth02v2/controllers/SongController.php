<?// controllers/SongController.php

require_once($_SERVER['DOCUMENT_ROOT'] . '/Demo_MVC_Simple/btth02v2/configs/DBConnection.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/Demo_MVC_Simple/btth02v2/models/SongModel.php');

class SongController {
    private $songModel;

    public function __construct($db) {
        $this->songModel = new SongModel($db);
    }

    public function showTopSongs() {
        $songs = $this->songModel->getTopSongs();
      //  include 'views/songsView.php'; // Gửi dữ liệu sang view
    
        include $_SERVER['DOCUMENT_ROOT'] . '/Demo_MVC_Simple/btth02v2/views/home/home.php';// Tải view đăng nhập

    }
}

// Khởi tạo controller và hiển thị danh sách bài hát
$controller = new SongController($db);
$controller->showTopSongs();
?>