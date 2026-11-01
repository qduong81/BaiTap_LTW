<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách sản phẩm</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { border-collapse: collapse; width: 100%; margin-top: 15px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background-color: #f4f4f4; }
        a { text-decoration: none; color: #007bff; }
    </style>
</head>
<body>
    <h2>Danh sách sản phẩm</h2>
    <p><a href="index.php?route=admin/products/create">+ Thêm sản phẩm mới (Admin)</a></p>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Mã sản phẩm</th>
                <th>Tên sản phẩm</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($products)): ?>
                <?php foreach ($products as $p): ?>
                    <tr>
                        <td><?= $p['id'] ?></td>
                        <td><?= htmlspecialchars($p['code']) ?></td>
                        <td><?= htmlspecialchars($p['name']) ?></td>
                        <td><?= number_format($p['price']) ?> đ</td>
                        <td><?= $p['stock'] ?></td>
                        <td>
                            <a href="index.php?route=admin/products/edit&id=<?= $p['id'] ?>">Sửa</a> | 
                            <form action="index.php?route=admin/products/delete" method="POST" style="display:inline;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?');">
                                <input type="hidden" name="id" value="<?= $p['id'] ?>">
                                <button type="submit">Xóa</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="6">Chưa có sản phẩm nào.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>