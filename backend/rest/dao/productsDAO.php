<?php
require_once 'db.php';

class ProductsDAO {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Create
    public function createProduct($name, $price, $category_id, $description, $stock_quantity) {
        $sql = "INSERT INTO products (name, price, category_id, description, stock_quantity) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$name, $price, $category_id, $description, $stock_quantity]);
    }

    // Read
    public function getProductById($id) {
        $sql = "SELECT * FROM products WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    // Update
    public function updateProduct($id, $name, $price, $category_id, $description, $stock_quantity) {
        $sql = "UPDATE products SET name = ?, price = ?, category_id = ?, description = ?, stock_quantity = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$name, $price, $category_id, $description, $stock_quantity, $id]);
    }

    // Delete
    public function deleteProduct($id) {
        $sql = "DELETE FROM products WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }
}
?>
