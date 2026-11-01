<?php
namespace App\Controller;

use App\Repository\ProductRepository;

class AdminProductController {
    public function __construct(private ProductRepository $products) {}

    public function index(): void {
        $products = $this->products->findAll();
        require __DIR__ . '/../View/admin/product/index.php';
    }

    public function createForm(): void {
        $categories = $this->products->categories();
        require __DIR__ . '/../View/admin/product/form.php';
    }

    public function store(): void {
        $categoryId = (int)($_POST['category_id'] ?? 1);
        $code       = trim($_POST['code'] ?? '');
        $name       = trim($_POST['name'] ?? '');
        $price      = (float)($_POST['price'] ?? 0);
        $stock      = (int)($_POST['stock'] ?? 0);

        if (empty($code) || empty($name)) {
            die('Mã sản phẩm và Tên sản phẩm không được để trống.');
        }

        $this->products->create([
            'category_id' => $categoryId,
            'code'        => $code,
            'name'        => $name,
            'price'       => $price,
            'stock'       => $stock,
            'status'      => 'active'
        ]);

        header('Location: index.php?route=admin/products');
        exit;
    }

    public function editForm(): void {
        $id = (int)($_GET['id'] ?? 0);
        $product = $this->products->findById($id);

        if (!$product) {
            die('Sản phẩm không tồn tại.');
        }

        $categories = $this->products->categories();
        require __DIR__ . '/../View/admin/product/form.php';
    }

    public function update(): void {
        $id         = (int)($_POST['id'] ?? 0);
        $categoryId = (int)($_POST['category_id'] ?? 1);
        $code       = trim($_POST['code'] ?? '');
        $name       = trim($_POST['name'] ?? '');
        $price      = (float)($_POST['price'] ?? 0);
        $stock      = (int)($_POST['stock'] ?? 0);

        if (empty($code) || empty($name)) {
            die('Thông tin không hợp lệ.');
        }

        $this->products->update($id, [
            'category_id' => $categoryId,
            'code'        => $code,
            'name'        => $name,
            'price'       => $price,
            'stock'       => $stock,
            'status'      => 'active'
        ]);

        header('Location: index.php?route=admin/products');
        exit;
    }

    public function delete(): void {
        $id = (int)($_POST['id'] ?? 0);
        if ($id > 0) {
            $this->products->delete($id);
        }
        header('Location: index.php?route=admin/products');
        exit;
    }
}