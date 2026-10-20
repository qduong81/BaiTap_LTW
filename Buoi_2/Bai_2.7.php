<?php
// Hàm định dạng tiền tệ
function money(float $value): string {
    return number_format($value, 0, ',', '.') . ' đ';
}

// Đọc POST và ép kiểu cơ bản
$name = $_POST['name'] ?? '';
$qty = (int)($_POST['qty'] ?? 0);
$price = (float)($_POST['price'] ?? 0);

// Tính thành tiền
$total = $qty * $price;
?>

<!-- Form nhập liệu -->
<form method="post">
    <input name="name" placeholder="Tên tài liệu">
    <input name="qty" type="number" min="1">
    <input name="price" type="number" min="0">
    <button>Tính</button>
</form>

<!-- Hiển thị kết quả và mã hóa output tên tài liệu -->
<?php if ($total > 0): ?>
    <p><?= htmlspecialchars($name) ?>: <?= money($total) ?></p>
<?php endif; ?>