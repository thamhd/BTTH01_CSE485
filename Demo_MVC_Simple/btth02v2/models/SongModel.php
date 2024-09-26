<?// models/SongModel.php
class SongModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getTopSongs() {
        $sql = "SELECT * FROM songs LIMIT 5"; // Giả định bảng "songs" có các bài hát
        $result = $this->db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>