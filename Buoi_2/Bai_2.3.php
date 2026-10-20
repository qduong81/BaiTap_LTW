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

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nhap = trim($_POST["diem"] ?? "");
    $so = str_replace(",", ".", $nhap);

    if (!is_numeric($so) || $so < 0 || $so > 10) {
        $thongBao = "Điểm không hợp lệ, vui lòng nhập số từ 0 đến 10.";
    } else {
        $thongBao = "Xếp loại: " . xepLoai((float)$so);
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