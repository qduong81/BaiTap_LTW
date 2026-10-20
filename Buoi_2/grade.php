<?php
// 1. Hàm kiểm tra điểm hợp lệ (từ 0 đến 10)
function isValidScore(float $score): bool {
    return $score >= 0 && $score <= 10;
}

// 2. Hàm tính điểm tổng kết (10% cc, 30% giữa kỳ, 60% cuối kỳ)
function finalScore(float $cc, float $mid, float $final): float {
    return $cc * 0.10 + $mid * 0.30 + $final * 0.60;
}

// 3. Hàm xếp loại
function getRank(float $score): string {
    if ($score >= 8.5) return 'Giỏi';
    if ($score >= 7.0) return 'Khá';
    if ($score >= 5.0) return 'Trung bình';
    return 'Chưa đạt';
}

// Khởi tạo các biến để giữ lại dữ liệu khi gửi form
$name = $_POST['name'] ?? '';
$cc = $_POST['cc'] ?? '';
$mid = $_POST['mid'] ?? '';
$final = $_POST['final'] ?? '';

$errors = [];
$result = null;

// Xử lý khi gửi form qua phương thức POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Kiểm tra điểm chuyên cần
    if ($cc === '' || !is_numeric($cc) || !isValidScore((float)$cc)) {
        $errors[] = 'Điểm chuyên cần phải nằm trong khoảng từ 0 đến 10.';
    }

    // Kiểm tra điểm giữa kỳ
    if ($mid === '' || !is_numeric($mid) || !isValidScore((float)$mid)) {
        $errors[] = 'Điểm giữa kỳ phải nằm trong khoảng từ 0 đến 10.';
    }

    // Kiểm tra điểm cuối kỳ
    if ($final === '' || !is_numeric($final) || !isValidScore((float)$final)) {
        $errors[] = 'Điểm cuối kỳ phải nằm trong khoảng từ 0 đến 10.';
    }

    // Nếu không có lỗi thì tiến hành tính toán
    if (empty($errors)) {
        $total = finalScore((float)$cc, (float)$mid, (float)$final);
        $rank = getRank($total);
        $result = [
            'name' => $name,
            'total' => $total,
            'rank' => $rank
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Máy tính điểm học phần</title>
</head>
<body>

    <h2>Máy tính điểm học phần</h2>

    <!-- Hiển thị lỗi nếu có -->
    <?php if (!empty($errors)): ?>
        <ul style="color: red;">
            <?php foreach ($errors as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <!-- Form nhập liệu qua phương thức POST -->
    <form method="post" action="grade.php">
        <p>
            <label>Họ tên:</label><br>
            <input type="text" name="name" value="<?= htmlspecialchars($name) ?>" required>
        </p>
        <p>
            <label>Điểm chuyên cần (10%):</label><br>
            <input type="number" step="0.1" name="cc" value="<?= htmlspecialchars($cc) ?>">
        </p>
        <p>
            <label>Điểm giữa kỳ (30%):</label><br>
            <input type="number" step="0.1" name="mid" value="<?= htmlspecialchars($mid) ?>">
        </p>
        <p>
            <label>Điểm cuối kỳ (60%):</label><br>
            <input type="number" step="0.1" name="final" value="<?= htmlspecialchars($final) ?>">
        </p>
        <button type="submit">Tính điểm</button>
    </form>

    <!-- Hiển thị kết quả -->
    <?php if ($result !== null): ?>
        <h3>Kết quả:</h3>
        <p>Họ tên: <strong><?= htmlspecialchars($result['name']) ?></strong></p>
        <p>Điểm tổng kết: <strong><?= number_format($result['total'], 2) ?></strong></p>
        <p>Xếp loại: <strong><?= $result['rank'] ?></strong></p>
    <?php endif; ?>

</body>
</html>