<?php
// Tự khai báo hàm mã hóa nếu chưa được nạp từ file khác
if (!function_exists('ma_hoa_dau_ra')) {
    function ma_hoa_dau_ra($chuoi) {
        return htmlspecialchars($chuoi ?? '', ENT_QUOTES, 'UTF-8');
    }
}

// Khởi tạo các biến mặc định nếu chưa có (chống lỗi Undefined variable)
$du_lieu = $du_lieu ?? [
    'ho_ten'      => '',
    'thu_dien_tu' => '',
    'ngay_sinh'   => '',
    'chu_de'      => 'Hỗ trợ kỹ thuật',
    'noi_dung'    => ''
];
$danh_sach_loi = $danh_sach_loi ?? [];
$thong_bao_thanh_cong = $thong_bao_thanh_cong ?? '';
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Liên hệ</title>
    <!-- Nhúng file CSS thuần Việt -->
    <link rel="stylesheet" href="trang_tri.css">
</head>
<body>

    <div class="the-lien-he">
        <h2>Liên hệ</h2>
        <p class="chu-ky-phu">Vui lòng nhập đầy đủ thông tin bên dưới.</p>

        <?php if (!empty($thong_bao_thanh_cong)): ?>
            <div class="thong-bao-thanh-cong"><?= ma_hoa_dau_ra($thong_bao_thanh_cong) ?></div>
        <?php endif; ?>

        <form action="xu_ly_lien_he.php" method="POST" enctype="multipart/form-data">
            
            <!-- Họ tên -->
            <div class="nhom-o-nhap">
                <label for="ho_ten">Họ tên</label>
                <input type="text" id="ho_ten" name="ho_ten" class="o-nhap <?= isset($danh_sach_loi['ho_ten']) ? 'co-loi' : '' ?>" value="<?= ma_hoa_dau_ra($du_lieu['ho_ten']) ?>">
                <?php if (isset($danh_sach_loi['ho_ten'])): ?>
                    <span class="thong-bao-loi"><?= ma_hoa_dau_ra($danh_sach_loi['ho_ten']) ?></span>
                <?php endif; ?>
            </div>

            <!-- Email -->
            <div class="nhom-o-nhap">
                <label for="thu_dien_tu">Email</label>
                <input type="text" id="thu_dien_tu" name="thu_dien_tu" class="o-nhap <?= isset($danh_sach_loi['thu_dien_tu']) ? 'co-loi' : '' ?>" placeholder="name@example.com" value="<?= ma_hoa_dau_ra($du_lieu['thu_dien_tu']) ?>">
                <?php if (isset($danh_sach_loi['thu_dien_tu'])): ?>
                    <span class="thong-bao-loi"><?= ma_hoa_dau_ra($danh_sach_loi['thu_dien_tu']) ?></span>
                <?php endif; ?>
            </div>

            <!-- Ngày sinh -->
            <div class="nhom-o-nhap">
                <label for="ngay_sinh">Ngày sinh</label>
                <input type="date" id="ngay_sinh" name="ngay_sinh" class="o-nhap <?= isset($danh_sach_loi['ngay_sinh']) ? 'co-loi' : '' ?>" value="<?= ma_hoa_dau_ra($du_lieu['ngay_sinh']) ?>">
                <?php if (isset($danh_sach_loi['ngay_sinh'])): ?>
                    <span class="thong-bao-loi"><?= ma_hoa_dau_ra($danh_sach_loi['ngay_sinh']) ?></span>
                <?php endif; ?>
            </div>

            <!-- Chủ đề -->
            <div class="nhom-o-nhap">
                <label for="chu_de">Chủ đề</label>
                <select id="chu_de" name="chu_de" class="o-nhap">
                    <option value="Hỗ trợ kỹ thuật" <?= ($du_lieu['chu_de'] ?? '') === 'Hỗ trợ kỹ thuật' ? 'selected' : '' ?>>Hỗ trợ kỹ thuật</option>
                    <option value="Góp ý" <?= ($du_lieu['chu_de'] ?? '') === 'Góp ý' ? 'selected' : '' ?>>Góp ý</option>
                    <option value="Hỏi đáp" <?= ($du_lieu['chu_de'] ?? '') === 'Hỏi đáp' ? 'selected' : '' ?>>Hỏi đáp</option>
                </select>
            </div>

            <!-- Nội dung -->
            <div class="nhom-o-nhap">
                <label for="noi_dung">Nội dung</label>
                <textarea id="noi_dung" name="noi_dung" class="o-nhap <?= isset($danh_sach_loi['noi_dung']) ? 'co-loi' : '' ?>" placeholder="Nhập nội dung từ 10 đến 500 ký tự..."><?= ma_hoa_dau_ra($du_lieu['noi_dung']) ?></textarea>
                <?php if (isset($danh_sach_loi['noi_dung'])): ?>
                    <span class="thong-bao-loi"><?= ma_hoa_dau_ra($danh_sach_loi['noi_dung']) ?></span>
                <?php endif; ?>
            </div>

            <!-- Ảnh đại diện -->
            <div class="nhom-o-nhap">
                <label for="anh_dai_dien">Ảnh đại diện (Bắt buộc, tối đa 2MB)</label>
                <input type="file" id="anh_dai_dien" name="anh_dai_dien" accept="image/*">
                <?php if (isset($danh_sach_loi['anh_dai_dien'])): ?>
                    <span class="thong-bao-loi"><?= ma_hoa_dau_ra($danh_sach_loi['anh_dai_dien']) ?></span>
                <?php endif; ?>
            </div>

            <button type="submit" class="nut-gui">Gửi liên hệ</button>
        </form>
    </div>

</body>
</html>