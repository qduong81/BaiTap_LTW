<?php
namespace App\Controller;

use App\Repository\ProductRepository;

class ProductController {
    public function __construct(private ProductRepository $products) {}

    public function index(): void {
        $products = $this->products->findAll();
        require __DIR__ . '/../View/product/index.php';
    }
}