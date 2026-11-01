<?php $isEdit = isset($product); ?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $isEdit ? 'Chỉnh sửa sản phẩm' : 'Thêm sản phẩm mới' ?></title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; line-height: 1.6; }
        .form-container { max-width: 500px; padding: 20px; border: 1px solid #ccc; border-radius: 8px; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; font-weight: bold; margin-bottom: 5px; }
        .form-group input, .form-group select { width: 100%; padding: 8px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; }
        .btn-submit { background-color: #28a745; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; }
        .btn-cancel { color: #6c757d; text-decoration: none; margin-left: 10px; }
    </style>
</head>
<body>

<div class="form-container">
    <h2><?= $isEdit ? 'Chỉnh sửa sản phẩm' : 'Thêm sản phẩm mới' ?></h2>

    <form action="index.php?route=<?= $isEdit ? 'admin/products/update' : 'admin/products/store' ?>" method="POST">
        <?php if ($isEdit): ?>
            <input type="hidden" name="id" value="<?= htmlspecialchars($product['id'] ?? '') ?>">
        <?php endif; ?>

        <div class="form-group">
            <label for="category_id">Danh mục:</label>
            <select id="category_id" name="category_id" required>
                <?php if (!empty($categories)): ?>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?= $cat['id'] ?>" <?= ($isEdit && ($product['category_id'] ?? 0) == $cat['id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($cat['name']) ?>
                        </option>
                    <?php endforeach; ?>
                <?php else: ?>
                    <option value="1">Văn phòng phẩm</option>
                <?php endif; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="code">Mã sản phẩm:</label>
            <input type="text" id="code" name="code" value="<?= htmlspecialchars($product['code'] ?? '') ?>" required placeholder="VD: PEN-01">
        </div>

        <div class="form-group">
            <label for="name">Tên sản phẩm:</label>
            <input type="text" id="name" name="name" value="<?= htmlspecialchars($product['name'] ?? '') ?>" required placeholder="Nhập tên sản phẩm">
        </div>

        <div class="form-group">
            <label for="price">Giá bán (VNĐ):</label>
            <input type="number" id="price" name="price" value="<?= htmlspecialchars($product['price'] ?? 0) ?>" step="1000" min="0" required>
        </div>

        <div class="form-group">
            <label for="stock">Số lượng tồn kho:</label>
            <input type="number" id="stock" name="stock" value="<?= htmlspecialchars($product['stock'] ?? 0) ?>" min="0" required>
        </div>

        <div class="form-group">
            <button type="submit" class="btn-submit">Lưu sản phẩm</button>
            <a href="index.php?route=admin/products" class="btn-cancel">Hủy</a>
        </div>
    </form>
</div>

</body>
</html>