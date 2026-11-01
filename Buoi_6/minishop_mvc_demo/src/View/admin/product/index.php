<section>
    <div class="page-head">
        <div>
            <h1>Quản trị sản phẩm</h1>
            <p class="muted">Route này được bảo vệ bằng role = admin</p>
        </div>
        <a class="button" href="index.php?route=admin/products/create">+ Thêm sản phẩm</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Mã</th>
                <th>Tên</th>
                <th>Danh mục</th>
                <th>Giá</th>
                <th>Tồn kho</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($products)): ?>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?= (int) $product['id'] ?></td>
                        <td><?= htmlspecialchars($product['code'] ?? '') ?></td>
                        <td><?= htmlspecialchars($product['name'] ?? '') ?></td>
                        <td><?= htmlspecialchars($product['category_name'] ?? 'Chưa phân loại') ?></td>
                        <td><?= number_format($product['price'] ?? 0) ?> đ</td>
                        <td><?= (int) ($product['stock'] ?? 0) ?></td>
                        <td>
                            <a href="index.php?route=admin/products/edit&id=<?= $product['id'] ?>">Sửa</a> | 
                            <form action="index.php?route=admin/products/delete" method="POST" style="display:inline;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?');">
                                <input type="hidden" name="id" value="<?= $product['id'] ?>">
                                <button type="submit" style="background:none; border:none; color:red; cursor:pointer; padding:0;">Xóa</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7">Chưa có sản phẩm nào.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</section>