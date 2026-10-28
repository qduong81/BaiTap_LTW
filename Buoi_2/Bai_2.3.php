<?php
function xepLoai(float $diem): string {
    if ($diem >= 8) {
        return "Giỏi";
    } elseif ($diem >= 6.5) {
        return "Khá";
    } elseif ($diem >= 5) {
        return "Trung bình";
    } else {
        return "Chưa đạt";
    }
}

$thongBao = "";
$nhap = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {//Kiểm tra xem người dùng đã nhấn nút gửi form (phương thức POST) hay chưa.
    $nhap = trim($_POST["diem"] ?? "");//Toán tử Null Coalescing (??) lấy giá trị từ ô nhập diem. Nếu không có, gán giá trị mặc định là chuỗi rỗng ""
    $so = str_replace(",", ".", $nhap);//Chuẩn hóa định dạng số. Nếu người dùng nhập dấu phẩy , (ví dụ: 8,5), PHP sẽ chuyển thành dấu chấm . (8.5) để tính toán.

    if (!is_numeric($so) || $so < 0 || $so > 10) {//Không phải là số.
        $thongBao = "Điểm không hợp lệ, vui lòng nhập số từ 0 đến 10.";
    } else {
        $thongBao = "Xếp loại: " . xepLoai((float)$so);
        //Nếu hợp lệ, ép kiểu sang (float)$so, gọi hàm xepLoai() và nối kết quả vào chuỗi $thongBao.
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Xếp loại điểm</title>
</head>
<body>
    <h2>Xếp loại điểm</h2>
    <form method="post">
        Nhập điểm: <input type="text" name="diem" value="<?= htmlspecialchars($nhap) ?>">
        <button type="submit">Xếp loại</button>
    </form>
    <p><?= $thongBao ?></p>
</body>
</html>