<?php
// Khai báo mảng chứa dữ liệu nhập và mảng lỗi
$danh_sach_loi = [];
$du_lieu = [
    'ho_ten'      => '',
    'thu_dien_tu' => '',
    'ngay_sinh'   => '',
    'chu_de'      => 'Hỗ trợ kỹ thuật',
    'noi_dung'    => ''
];
$thong_bao_thanh_cong = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1. Chuẩn hóa dữ liệu văn bản
    $du_lieu['ho_ten']      = trim($_POST['ho_ten'] ?? '');
    $du_lieu['thu_dien_tu'] = trim($_POST['thu_dien_tu'] ?? '');
    $du_lieu['ngay_sinh']   = trim($_POST['ngay_sinh'] ?? '');
    $du_lieu['chu_de']      = trim($_POST['chu_de'] ?? 'Hỗ trợ kỹ thuật');
    $du_lieu['noi_dung']    = trim($_POST['noi_dung'] ?? '');

    // 2. Kiểm tra dữ liệu văn bản (Yêu cầu 3.7 & 3.8)
    if ($du_lieu['ho_ten'] === '') {
        $danh_sach_loi['ho_ten'] = 'Vui lòng nhập họ tên!';
    }

    if ($du_lieu['thu_dien_tu'] === '') {
        $danh_sach_loi['thu_dien_tu'] = 'Vui lòng nhập email!';
    } elseif (!filter_var($du_lieu['thu_dien_tu'], FILTER_VALIDATE_EMAIL)) {
        $danh_sach_loi['thu_dien_tu'] = 'Email không hợp lệ!';
    }

    if ($du_lieu['ngay_sinh'] === '') {
        $danh_sach_loi['ngay_sinh'] = 'Vui lòng chọn ngày sinh!';
    }

    $do_dai_noi_dung = mb_strlen($du_lieu['noi_dung']);
    if ($du_lieu['noi_dung'] === '') {
        $danh_sach_loi['noi_dung'] = 'Vui lòng nhập nội dung liên hệ!';
    } elseif ($do_dai_noi_dung < 10 || $do_dai_noi_dung > 500) {
        $danh_sach_loi['noi_dung'] = 'Nội dung phải từ 10 đến 500 ký tự.';
    }

    // 3. Kiểm tra & Tải ảnh đại diện (3 kiểm tra an toàn ở mục 3.6)
    $duong_dan_anh = '';
    if (isset($_FILES['anh_dai_dien']) && $_FILES['anh_dai_dien']['error'] === UPLOAD_ERR_OK) {
        $tep_tin = $_FILES['anh_dai_dien'];

        // [Kiểm tra 1]: Kích thước tối đa 2MB
        if ($tep_tin['size'] > 2 * 1024 * 1024) {
            $danh_sach_loi['anh_dai_dien'] = 'Kích thước file vượt quá 2MB!';
        } else {
            // [Kiểm tra 2]: Định dạng file ảnh & loại MIME
            $duoi_tep = strtolower(pathinfo($tep_tin['name'], PATHINFO_EXTENSION));
            $duoi_cho_phep = ['jpg', 'jpeg', 'png', 'gif'];

            $thong_tin_tep = finfo_open(FILEINFO_MIME_TYPE);
            $loai_mime = finfo_file($thong_tin_tep, $tep_tin['tmp_name']);
            finfo_close($thong_tin_tep);
            $mime_cho_phep = ['image/jpeg', 'image/png', 'image/gif'];

            if (!in_array($duoi_tep, $duoi_cho_phep) || !in_array($loai_mime, $mime_cho_phep)) {
                $danh_sach_loi['anh_dai_dien'] = 'Chỉ chấp nhận file ảnh (jpg, jpeg, png, gif)!';
            } else {
                // [Kiểm tra 3]: Đổi tên file mới an toàn
                $duong_dan_anh = 'tep_tai_len/' . uniqid('anh_') . '.' . $duoi_tep;
            }
        }
    } else {
        $danh_sach_loi['anh_dai_dien'] = 'Vui lòng chọn ảnh đại diện!';
    }

    // 4. Nếu không có lỗi -> Lưu ảnh và báo thành công
    if (empty($danh_sach_loi)) {
        if (!is_dir('tep_tai_len')) {
            mkdir('tep_tai_len', 0755, true);
        }

        if (move_uploaded_file($_FILES['anh_dai_dien']['tmp_name'], $duong_dan_anh)) {
            $thong_bao_thanh_cong = 'Gửi liên hệ thành công!';
            // Đặt lại dữ liệu form về rỗng
            $du_lieu = [
                'ho_ten'      => '',
                'thu_dien_tu' => '',
                'ngay_sinh'   => '',
                'chu_de'      => 'Hỗ trợ kỹ thuật',
                'noi_dung'    => ''
            ];
        } else {
            $danh_sach_loi['anh_dai_dien'] = 'Không thể lưu file ảnh tải lên!';
        }
    }
}

// Hàm mã hóa chống XSS
function ma_hoa_dau_ra($chuoi) {
    return htmlspecialchars($chuoi, ENT_QUOTES, 'UTF-8');
}

// Chèn file giao diện HTML để hiển thị
require_once 'giao_dien.php';