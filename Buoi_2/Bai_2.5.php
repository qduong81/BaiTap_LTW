<?php
function finalScore(float $cc, float $mid, float $final): float
{
    return $cc * 0.10 + $mid * 0.30 + $final * 0.60;
}

$thongBao = "";
$cc = $mid = $final = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $cc    = trim($_POST["cc"] ?? "");
    $mid   = trim($_POST["mid"] ?? "");
    $final = trim($_POST["final"] ?? "");

    $ds = [$cc, $mid, $final];
    $hopLe = true;
    foreach ($ds as $d) {
        if (!is_numeric($d) || $d < 0 || $d > 10) {
            $hopLe = false;
        }
    }

    if (!$hopLe) {
        $thongBao = "Điểm không hợp lệ, vui lòng nhập số từ 0 đến 10.";
    } else {
        $thongBao = "Điểm tổng kết: " . round(finalScore((float)$cc, (float)$mid, (float)$final), 2);
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Điểm tổng kết</title>
</head>
<body>
    <h2>Tính điểm tổng kết</h2>
    <form method="post">
        Chuyên cần (10%): <input type="text" name="cc" value="<?= htmlspecialchars($cc) ?>"><br><br>
        Giữa kỳ (30%): <input type="text" name="mid" value="<?= htmlspecialchars($mid) ?>"><br><br>
        Cuối kỳ (60%): <input type="text" name="final" value="<?= htmlspecialchars($final) ?>"><br><br>
        <button type="submit">Tính điểm</button>
    </form>
    <p><?= $thongBao ?></p>
</body>
</html>