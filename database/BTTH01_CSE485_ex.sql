--a) Liệt kê các bài viết thuộc thể loại Nhạc trữ tình
SELECT baiviet.tieude, baiviet.ten_bhat, theloai.ten_tloai
FROM baiviet
JOIN theloai ON baiviet.ma_tloai = theloai.ma_tloai
WHERE theloai.ten_tloai = 'Nhạc trữ tình';

--b) Liệt kê các bài viết của tác giả Nhacvietplus
SELECT baiviet.tieude, baiviet.ten_bhat, tacgia.ten_tgia
FROM baiviet
JOIN tacgia ON baiviet.ma_tgia = tacgia.ma_tgia
WHERE tacgia.ten_tgia = 'Nhacvietplus';


--c) Liệt kê các thể loại chưa có bài viết cảm nhận nào
SELECT theloai.ten_tloai
FROM theloai
LEFT JOIN baiviet ON baiviet.ma_tloai = theloai.ma_tloai
WHERE baiviet.ma_bviet IS NULL;

--d) Liệt kê các bài viết với thông tin: mã bài viết, tiêu đề, tên bài hát, tên tác giả, tên thể loại, ngày viết
SELECT baiviet.ma_bviet, baiviet.tieude, baiviet.ten_bhat, tacgia.ten_tgia, theloai.ten_tloai, baiviet.ngayviet
FROM baiviet
JOIN tacgia ON baiviet.ma_tgia = tacgia.ma_tgia
JOIN theloai ON baiviet.ma_tloai = theloai.ma_tloai;


--e) Tìm thể loại có số bài viết nhiều nhất
SELECT theloai.ten_tloai, COUNT(baiviet.ma_bviet) AS so_bai_viet
FROM baiviet
JOIN theloai ON baiviet.ma_tloai = theloai.ma_tloai
GROUP BY theloai.ten_tloai
ORDER BY so_bai_viet DESC
LIMIT 1;


--f) Liệt kê 2 tác giả có số bài viết nhiều nhất
SELECT tacgia.ten_tgia, COUNT(baiviet.ma_bviet) AS so_bai_viet
FROM baiviet
JOIN tacgia ON baiviet.ma_tgia = tacgia.ma_tgia
GROUP BY tacgia.ten_tgia
ORDER BY so_bai_viet DESC



--i) Tạo view vw_Music để hiển thị thông tin về bài viết và thể loại
CREATE VIEW vw_Music AS
SELECT baiviet.tieude, baiviet.ten_bhat, theloai.ten_tloai, tacgia.ten_tgia
FROM baiviet
JOIN theloai ON baiviet.ma_tloai = theloai.ma_tloai
JOIN tacgia ON baiviet.ma_tgia = tacgia.ma_tgia;


--j) Tạo thủ tục sp_DSBaiViet trả về danh sách bài viết của thể loại
DELIMITER $$

CREATE PROCEDURE sp_DSBaiViet(IN the_loai VARCHAR(50))
BEGIN
    SELECT baiviet.tieude, baiviet.ten_bhat, tacgia.ten_tgia
    FROM baiviet
    JOIN theloai ON baiviet.ma_tloai = theloai.ma_tloai
    JOIN tacgia ON baiviet.ma_tgia = tacgia.ma_tgia
    WHERE theloai.ten_tloai = the_loai;
END $$

DELIMITER ;

--k. Trigger để cập nhật số lượng bài viết theo thể loại

ALTER TABLE theloai ADD COLUMN SLBaiViet INT DEFAULT 0;
DELIMITER //

CREATE TRIGGER tg_CapNhatTheLoai
AFTER INSERT ON baiviet
FOR EACH ROW
BEGIN
    UPDATE theloai
    SET SLBaiViet = (SELECT COUNT(*) FROM baiviet WHERE baiviet.ma_tloai = NEW.ma_tloai)
    WHERE theloai.ma_tloai = NEW.ma_tloai;
END //

DELIMITER ;


--l,Tạo bảng users để lưu thông tin đăng nhập
CREATE TABLE user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL
);
