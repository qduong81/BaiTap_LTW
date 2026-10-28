<?php
// Buoi_5/products.php
require_once __DIR__ . '/config/db.php';

$pdo = db();

// 1. Xử lý XÓA HẲN KHỎI CSDL (Xóa dữ liệu ở bảng order_items trước để tránh lỗi Foreign Key)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete') {
    $id = (int)($_POST['id'] ?? 0);
    if ($id > 0) {
        // Bước 1: Xóa các chi tiết đơn hàng chứa sản phẩm này trước
        $stmtItems = $pdo->prepare("DELETE FROM order_items WHERE product_id = :id");
        $stmtItems->execute([':id' => $id]);

        // Bước 2: Xóa hẳn sản phẩm khỏi bảng products
        $stmtProduct = $pdo->prepare("DELETE FROM products WHERE id = :id");
        $stmtProduct->execute([':id' => $id]);
    }
    header('Location: products.php?msg=deleted');
    exit;
}

// 2. Lấy tham số TÌM KIẾM & PHÂN TRANG từ URL (GET)
$keyword = trim($_GET['kw'] ?? '');
$page = max(1, (int)($_GET['page'] ?? 1));
$perPage = 3; // Số sản phẩm hiển thị trên 1 trang
$offset = ($page - 1) * $perPage;

// 3. Truy vấn lấy danh sách sản phẩm bằng Prepared Statement
$sql = "SELECT p.*, c.name AS category_name 
        FROM products p
        JOIN categories c ON p.category_id = c.id
        WHERE p.code LIKE :kw OR p.name LIKE :kw
        ORDER BY p.id DESC
        LIMIT :limit OFFSET :offset";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':kw', "%$keyword%", PDO::PARAM_STR);
$stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$products = $stmt->fetchAll();

// 4. Đếm tổng số bản ghi để tính tổng số trang
$stmtCount = $pdo->prepare("SELECT COUNT(*) FROM products WHERE code LIKE :kw OR name LIKE :kw");
$stmtCount->execute([':kw' => "%$keyword%"]);
$totalRows = (int) $stmtCount->fetchColumn();
$totalPages = max(1, ceil($totalRows / $perPage));
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 5 - Quản lý Sản phẩm (MiniShop)</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 30px; background-color: #f8f9fa; }
        .container { max-width: 1000px; margin: 0 auto; background: white; padding: 25px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        h2 { color: #333; margin-top: 0; }
        .alert { padding: 10px 15px; background-color: #d4edda; color: #155724; border-radius: 4px; margin-bottom: 15px; border: 1px solid #c3e6cb; }
        .search-box { margin-bottom: 20px; display: flex; gap: 10px; }
        .search-box input[type="text"] { flex: 1; padding: 8px 12px; border: 1px solid #ccc; border-radius: 4px; }
        .search-box button { padding: 8px 16px; background-color: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; }
        .search-box button:hover { background-color: #0056b3; }
        table { border-collapse: collapse; width: 100%; margin-top: 10px; }
        th, td { border: 1px solid #dee2e6; padding: 12px; text-align: left; }
        th { background-color: #e9ecef; color: #495057; }
        tr:nth-child(even) { background-color: #f8f9fa; }
        .btn-delete { background-color: #dc3545; color: white; border: none; padding: 6px 12px; cursor: pointer; border-radius: 4px; font-size: 13px; }
        .btn-delete:hover { background-color: #bd2130; }
        .pagination { margin-top: 20px; display: flex; gap: 5px; }
        .pagination a, .pagination strong { padding: 8px 12px; border: 1px solid #dee2e6; text-decoration: none; color: #007bff; border-radius: 4px; }
        .pagination strong { background-color: #007bff; color: white; border-color: #007bff; }
        .pagination a:hover { background-color: #e9ecef; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Danh sách Sản phẩm (Bài 5 - PDO & CRUD)</h2>

        <!-- Thông báo sau khi xóa -->
        <?php if (isset($_GET['msg']) && $_GET['msg'] === 'deleted'): ?>
            <div class="alert">Đã xóa sản phẩm thành công khỏi hệ thống!</div>
        <?php endif; ?>

        <!-- Form tìm kiếm -->
        <form method="GET" action="products.php" class="search-box">
            <input type="text" name="kw" value="<?= htmlspecialchars($keyword) ?>" placeholder="Nhập mã hoặc tên sản phẩm để tìm...">
            <button type="submit">Tìm kiếm</button>
        </form>

        <!-- Bảng hiển thị -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Mã SP</th>
                    <th>Tên sản phẩm</th>
                    <th>Danh mục</th>
                    <th>Giá bán</th>
                    <th>Tồn kho</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($products)): ?>
                    <tr>
                        <td colspan="8" style="text-align: center; color: #6c757d;">Không tìm thấy sản phẩm nào.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($products as $p): ?>
                        <tr>
                            <td><?= $p['id'] ?></td>
                            <td><strong><?= htmlspecialchars($p['code']) ?></strong></td>
                            <td><?= htmlspecialchars($p['name']) ?></td>
                            <td><?= htmlspecialchars($p['category_name']) ?></td>
                            <td><?= number_format($p['price'], 0, ',', '.') ?> VNĐ</td>
                            <td><?= $p['stock'] ?></td>
                            <td><?= htmlspecialchars($p['status']) ?></td>
                            <td>
                                <!-- Form xóa gửi qua phương thức POST -->
                                <form method="POST" action="products.php" style="display:inline;" onsubmit="return confirm('Bạn có chắc chắn muốn XÓA HẲN sản phẩm này khỏi cơ sở dữ liệu?');">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="id" value="<?= $p['id'] ?>">
                                    <button type="submit" class="btn-delete">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- Thanh phân trang -->
        <?php if ($totalPages > 1): ?>
            <div class="pagination">
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <?php if ($i == $page): ?>
                        <strong><?= $i ?></strong>
                    <?php else: ?>
                        <a href="products.php?kw=<?= urlencode($keyword) ?>&page=<?= $i ?>"><?= $i ?></a>
                    <?php endif; ?>
                <?php endfor; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>