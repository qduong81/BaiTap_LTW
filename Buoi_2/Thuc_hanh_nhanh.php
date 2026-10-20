<?php
// Hàm kiểm tra điểm hợp lệ từ 0 đến 10
function kiemTraDiemHopLe($diem) {
    // Kiểm tra xem có phải là số và nằm trong đoạn [0, 10]
    if (is_numeric($diem) && $diem >= 0 && $diem <= 10) {
        return true;
    }
    return false;
}

$thong_bao = "";

// Xử lý khi người dùng nhấn nút Gửi (POST)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $diem_nhap = $_POST["diem"] ?? "";
    
    if (kiemTraDiemHopLe($diem_nhap)) {
        $thong_bao = "Điểm hợp lệ: " . htmlspecialchars($diem_nhap);
    } else {
        $thong_bao = "Điểm không hợp lệ! Vui lòng nhập số từ 0 đến 10.";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thực hành nhanh PHP</title>
</head>
<body>
    <h3>Thực hành nhanh: Kiểm tra điểm hợp lệ (0 - 10)</h3>
    
    <form method="POST" action="">
        <label for="diem">Nhập điểm:</label>
        <input type="text" id="diem" name="diem" required>
        <button type="submit">Kiểm tra</button>
    </form>

    <?php if (!empty($thong_bao)) { ?>
        <p><strong>Kết quả:</strong> <?php echo $thong_bao; ?></p>
    <?php } ?>
</body>
</html>