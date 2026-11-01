<?php
namespace App\Repository;

use PDO;

class ProductRepository {
    public function __construct(private PDO $pdo) {}

    // 1. Lấy danh sách toàn bộ sản phẩm (kèm tên danh mục)
    public function findAll(): array {
        $stmt = $this->pdo->query(
            'SELECT p.*, c.name AS category_name 
             FROM products p 
             LEFT JOIN categories c ON p.category_id = c.id 
             ORDER BY p.id DESC'
        );
        return $stmt->fetchAll();
    }

    // 2. Tìm sản phẩm theo ID
    public function findById(int $id): ?array {
        $stmt = $this->pdo->prepare('SELECT * FROM products WHERE id = :id');
        $stmt->execute(['id' => $id]);
        return $stmt->fetch() ?: null;
    }

    // 3. Lấy danh sách tất cả các danh mục (Chỉ chọn id và name)
    public function categories(): array {
        $stmt = $this->pdo->query('SELECT id, name FROM categories ORDER BY name ASC');
        return $stmt->fetchAll();
    }

    // 4. Thêm sản phẩm mới
    public function create(array $data): bool {
        $sql = 'INSERT INTO products (category_id, code, name, price, stock, status) 
                VALUES (:category_id, :code, :name, :price, :stock, :status)';
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            'category_id' => $data['category_id'] ?? 1,
            'code'        => $data['code'],
            'name'        => $data['name'],
            'price'       => $data['price'],
            'stock'       => $data['stock'],
            'status'      => $data['status'] ?? 'active'
        ]);
    }

    // 5. Cập nhật thông tin sản phẩm
    public function update(int $id, array $data): bool {
        $sql = 'UPDATE products 
                SET category_id = :category_id, code = :code, name = :name, price = :price, stock = :stock, status = :status 
                WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            'id'          => $id,
            'category_id' => $data['category_id'] ?? 1,
            'code'        => $data['code'],
            'name'        => $data['name'],
            'price'       => $data['price'],
            'stock'       => $data['stock'],
            'status'      => $data['status'] ?? 'active'
        ]);
    }

    // 6. Xóa sản phẩm
    public function delete(int $id): bool {
        $stmt = $this->pdo->prepare('DELETE FROM products WHERE id = :id');
        return $stmt->execute(['id' => $id]);
    }
}