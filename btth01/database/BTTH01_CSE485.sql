-- Tạo cơ sở dữ liệu BTTH01_CSE485
CREATE DATABASE IF NOT EXISTS BTTH01_CSE485;
USE BTTH01_CSE485;

-- Bảng tacgia
CREATE TABLE IF NOT EXISTS tacgia (
    ma_tgia INT NOT NULL PRIMARY KEY,
    ten_tgia VARCHAR(100) NOT NULL,
    hinh_tgia VARCHAR(100)
);

-- Bảng theloai
CREATE TABLE IF NOT EXISTS theloai (
    ma_tloai INT NOT NULL PRIMARY KEY,
    ten_tloai VARCHAR(50) NOT NULL
);

-- Bảng baiviet
CREATE TABLE IF NOT EXISTS baiviet (
    ma_bviet INT NOT NULL PRIMARY KEY,
    tieude VARCHAR(200) NOT NULL,
    ten_bhat VARCHAR(100) NOT NULL,
    ma_tloai INT NOT NULL,
    tomtat TEXT NOT NULL,
    noidung TEXT,
    ma_tgia INT NOT NULL,
    ngayviet DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    hinhanh VARCHAR(200),
    FOREIGN KEY (ma_tloai) REFERENCES theloai(ma_tloai),
    FOREIGN KEY (ma_tgia) REFERENCES tacgia(ma_tgia)
);

-- Bảng users (để hỗ trợ hệ thống đăng nhập)
CREATE TABLE IF NOT EXISTS users (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    fullname VARCHAR(100),
    email VARCHAR(100),
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- Thêm dữ liệu mẫu vào bảng tacgia
INSERT INTO tacgia (ma_tgia, ten_tgia) VALUES (1, N'Nhacvietplus');
INSERT INTO tacgia (ma_tgia, ten_tgia) VALUES (2, N'Sưu tầm');
INSERT INTO tacgia (ma_tgia, ten_tgia) VALUES (3, N'Sandy');
INSERT INTO tacgia (ma_tgia, ten_tgia) VALUES (4, N'Lê Trung Ngân');
INSERT INTO tacgia (ma_tgia, ten_tgia) VALUES (5, N'Khánh Ngọc');
INSERT INTO tacgia (ma_tgia, ten_tgia) VALUES (6, N'Night Stalker');
INSERT INTO tacgia (ma_tgia, ten_tgia) VALUES (7, N'Phạm Phương Anh');
INSERT INTO tacgia (ma_tgia, ten_tgia) VALUES (8, N'Tâm tình');

-- Thêm dữ liệu mẫu vào bảng theloai
INSERT INTO theloai (ma_tloai, ten_tloai) VALUES (1, N'Nhạc trẻ');
INSERT INTO theloai (ma_tloai, ten_tloai) VALUES (2, N'Nhạc trữ tình');
INSERT INTO theloai (ma_tloai, ten_tloai) VALUES (3, N'Nhạc cách mạng');
INSERT INTO theloai (ma_tloai, ten_tloai) VALUES (4, N'Nhạc thiếu nhi');
INSERT INTO theloai (ma_tloai, ten_tloai) VALUES (5, N'Nhạc quê hương');
INSERT INTO theloai (ma_tloai, ten_tloai) VALUES (6, N'POP');
INSERT INTO theloai (ma_tloai, ten_tloai) VALUES (7, N'Rock');
INSERT INTO theloai (ma_tloai, ten_tloai) VALUES (8, N'R&B');

-- Thêm dữ liệu mẫu vào bảng baiviet
INSERT INTO baiviet (ma_bviet, tieude, ten_bhat, ma_tloai, tomtat, ma_tgia, ngayviet)
VALUES (1, N'Lòng mẹ', N'Lòng mẹ', 2, N'Và mẹ ơi đừng khóc nhé!...', 1, '2012-07-23');

INSERT INTO baiviet (ma_bviet, tieude, ten_bhat, ma_tloai, tomtat, ma_tgia, ngayviet)
VALUES (2, N'Cảm ơn em đã rời xa anh', N'Vết mưa', 2, N'Cảm ơn em đã cho anh...', 3, '2012-02-12');

INSERT INTO baiviet (ma_bviet, tieude, ten_bhat, ma_tloai, tomtat, ma_tgia, ngayviet)
VALUES (3, N'Cuộc đời có mấy ngày mai?', N'Phôi pha', 2, N'Đêm nay, trời quang mây tạnh...', 4, '2014-03-13');

INSERT INTO baiviet (ma_bviet, tieude, ten_bhat, ma_tloai, tomtat, ma_tgia, ngayviet)
VALUES (4, N'Quê tôi!', N'Quê hương', 5, N'Quê hương là gì mà chở đầy kí ức nhỏ xinh...', 5, '2014-02-20');

INSERT INTO baiviet (ma_bviet, tieude, ten_bhat, ma_tloai, tomtat, ma_tgia, ngayviet)
VALUES (5, N'Đất nước', N'Đất nước', 5, N'Liệu có mảnh đất nào mà mỗi tấc đất...', 1, '2010-05-25');

INSERT INTO baiviet (ma_bviet, tieude, ten_bhat, ma_tloai, tomtat, ma_tgia, ngayviet)
VALUES (6, N'Hard Rock Hallelujah', N'Hard Rock Hallelujah', 7, N'Những linh hồn đang lạc lối...', 6, '2013-09-12');

INSERT INTO baiviet (ma_bviet, tieude, ten_bhat, ma_tloai, tomtat, ma_tgia, ngayviet)
VALUES (7, N'The Unforgiven', N'The Unforgiven', 7, N'Lâu lắm rồi mới nghe lại The Unforgiven...', 1, '2010-05-25');

INSERT INTO baiviet (ma_bviet, tieude, ten_bhat, ma_tloai, tomtat, ma_tgia, ngayviet)
VALUES (8, N'Nơi tình yêu bắt đầu', N'Nơi tình yêu bắt đầu', 1, N'Nhiều người sẽ nghĩ làm gì có yêu nhất...', 1, '2014-02-03');

INSERT INTO baiviet (ma_bviet, tieude, ten_bhat, ma_tloai, tomtat, ma_tgia, ngayviet)
VALUES (9, N'Love Me Like There’s No Tomorrow', N'Love Me Like There’s No Tomorrow', 8, N'Nếu ai đã từng yêu Queen...', 1, '2013-02-26');

INSERT INTO baiviet (ma_bviet, tieude, ten_bhat, ma_tloai, tomtat, ma_tgia, ngayviet)
VALUES (10, N'I am stronger', N'I am stronger', 7, N'Em không phải là người giỏi giấu cảm xúc...', 2, '2013-08-21');

-- Thêm dữ liệu mẫu vào bảng users
INSERT INTO users (username, password, fullname, email) VALUES
('user1', '$2y$10$eImiTXuWVxfM37uY4JANjO.jJzmy3X7UpGZJfzUJ4V78tq9L.R7Ou', 'Nguyen Van A', 'user1@example.com'), -- password: 'password1'
('user2', '$2y$10$wH2/Z0E/UImKzTso0rsY8Of5qWl9COFZaPt4/Au6P0mJvvX2yDlse', 'Tran Thi B', 'user2@example.com'), -- password: 'password2'
('user3', '$2y$10$Y6Zdq/EwtTh.vz.QDfE5CuTdxIuF1iYvAPXj5ixdNznjoJtYxzJeW', 'Le Thi C', 'user3@example.com'); -- password: 'password3'
