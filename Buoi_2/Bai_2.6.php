<?php
$ten = $_POST['ten'] ?? '';
$sl = $_POST['sl'] ?? 0;
$gia = $_POST['gia'] ?? 0;
$tong = $sl * $gia;
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body>

    <form method="POST">
        <input type="text" name="ten" placeholder="Tên tài liệu" value="<?= htmlspecialchars($ten) ?>">
        <input type="number" name="sl" value="<?= htmlspecialchars($sl) ?>">
        <input type="number" name="gia" value="<?= htmlspecialchars($gia) ?>">
        <button type="submit">Tính</button>
    </form>

    <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
        <p><?= htmlspecialchars($ten) ?>: <?= number_format($tong, 0, ',', '.') ?> đ</p>
    <?php endif; ?>

</body>
</html>