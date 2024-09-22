-------------------------------------------------------------------------------------------------------
--4.Thực hiện các truy vấn sau:
--4.a--
SELECT * 
FROM baiviet 
JOIN theloai ON baiviet.ma_tloai = theloai.ma_tloai
WHERE theloai.ten_tloai = N'Nhạc trữ tình';
--4.b--
SELECT *
FROM tacgia
JOIN baiviet ON tacgia.ma_tgia = baiviet.ma_tgia
WHERE ten_tgia = N'Nhacvietplus';
--4.c--
SELECT * FROM theloai
JOIN baiviet ON theloai.ma_tloai = baiviet.ma_bviet
where baiviet.ma_tloai is null
--4.d--
SELECT baiviet.ma_bviet, baiviet.ten_bhat, tacgia.ten_tgia, theloai.ten_tloai, baiviet.ngayviet
FROM baiviet 
INNER JOIN tacgia ON baiviet.ma_tgia = tacgia.ma_tgia
INNER JOIN theloai ON baiviet.ma_tloai = theloai.ma_tloai;
--4.e--
SELECT theloai.ten_tloai, count(baiviet.ma_bviet) as soluongbaiviet
from theloai
join baiviet on theloai.ma_tloai = baiviet.ma_tloai
group by ten_tloai
order by soluongbaiviet desc
--4.f--
SELECT tacgia.ten_tgia, COUNT(baiviet.ma_bviet) AS so_bai_viet
FROM tacgia 
LEFT JOIN baiviet ON tacgia.ma_tgia = baiviet.ma_tgia
GROUP BY ten_tgia
ORDER BY so_bai_viet DESC
OFFSET 0 ROWS FETCH NEXT 2 ROWS ONLY;
--4.g--
SELECT *
FROM baiviet
WHERE ten_bhat LIKE '%yêu%' 
   OR ten_bhat LIKE '%thương%' 
   OR ten_bhat LIKE '%anh%' 
   OR ten_bhat LIKE '%em%';
--4.h--
SELECT *
FROM baiviet
WHERE tieude LIKE '%yêu%' 
   OR tieude LIKE '%thương%' 
   OR tieude LIKE '%anh%' 
   OR tieude LIKE '%em%'
   OR ten_bhat LIKE '%yêu%' 
   OR ten_bhat LIKE '%thương%' 
   OR ten_bhat LIKE '%anh%' 
   OR ten_bhat LIKE '%em%';
--4.i--
CREATE vw_Music AS
    SELECT b.ma_bviet, b.tieude, b.ten_bhat, b.tomtat, b.ngayviet, t.ten_tloai, a.ten_tgia
    FROM baiviet b
    JOIN theloai t ON b.ma_tloai = t.ma_tloai
    JOIN tacgia a ON b.ma_tgia = a.ma_tgia;
--4.j--
CREATE PROCEDURE sp_DSBaiViet
    @TenTheLoai NVARCHAR(255)
AS
BEGIN
    -- Kiểm tra xem thể loại có tồn tại không
    IF NOT EXISTS (SELECT 1 FROM theloai WHERE ten_tloai = @TenTheLoai)
    BEGIN
        RAISERROR(N'Thể loại không tồn tại.', 16, 1);
        RETURN;
    END

    -- Lấy danh sách bài viết thuộc thể loại được chỉ định
    SELECT b.ma_bviet, b.tieude, b.ten_bhat, b.tomtat, b.ngayviet
    FROM baiviet b
    JOIN theloai t ON b.ma_tloai = t.ma_tloai
    WHERE t.ten_tloai = @TenTheLoai;
END

