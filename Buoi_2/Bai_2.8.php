<?php
// 1. Tạo mảng $students gồm 3 sinh viên với name, midterm, final
$students = [
    ['name' => 'Quang Hiếu', 'midterm' => 7.5, 'final' => 8.0],
    ['name' => 'Thu Trang', 'midterm' => 4.0, 'final' => 5.0],
    ['name' => 'Lê Bống', 'midterm' => 3.0, 'final' => 4.0],
];

// 2. Viết hàm calculateAverage() tính điểm trung bình
function calculateAverage(float $midterm, float $final): float {
    return ($midterm + $final) / 2;
}
?>

<!-- 3. Dùng foreach để in bảng HTML -->
<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>Họ và tên</th>
            <th>Điểm giữa kỳ</th>
            <th>Điểm cuối kỳ</th>
            <th>Điểm trung bình</th>
            <th>Kết quả</th> <!-- 4. Thêm cột kết quả -->
        </tr>
    </thead>
    <tbody>
        <?php foreach ($students as $student): ?>
            <?php 
                $avg = calculateAverage($student['midterm'], $student['final']);
                // 4. Đạt nếu điểm trung bình >= 5
                $status = ($avg >= 5) ? 'Đạt' : 'Không đạt'; 
            ?>
            <tr>
                <!-- 5. Mã hóa tên sinh viên bằng htmlspecialchars() -->
                <td><?= htmlspecialchars($student['name']) ?></td>
                <td><?= $student['midterm'] ?></td>
                <td><?= $student['final'] ?></td>
                <td><?= number_format($avg, 1) ?></td>
                <td><?= $status ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>