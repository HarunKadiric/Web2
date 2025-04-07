<?php
require_once 'db.php';

class OrdersDAO {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Create
    public function createOrder($user_id, $total_price, $order_date) {
        $sql = "INSERT INTO orders (user_id, total_price, order_date) VALUES (?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$user_id, $total_price, $order_date]);
    }

    // Read
    public function getOrderById($id) {
        $sql = "SELECT * FROM orders WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    // Update
    public function updateOrder($id, $user_id, $total_price, $order_date) {
        $sql = "UPDATE orders SET user_id = ?, total_price = ?, order_date = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$user_id, $total_price, $order_date, $id]);
    }

    // Delete
    public function deleteOrder($id) {
        $sql = "DELETE FROM orders WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }
}
?>
