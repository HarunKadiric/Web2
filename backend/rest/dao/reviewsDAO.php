<?php
require_once 'db.php';

class ReviewsDAO {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Create
    public function createReview($user_id, $product_id, $rating, $comment) {
        $sql = "INSERT INTO reviews (user_id, product_id, rating, comment) VALUES (?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$user_id, $product_id, $rating, $comment]);
    }

    // Read
    public function getReviewById($id) {
        $sql = "SELECT * FROM reviews WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    // Update
    public function updateReview($id, $user_id, $product_id, $rating, $comment) {
        $sql = "UPDATE reviews SET user_id = ?, product_id = ?, rating = ?, comment = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$user_id, $product_id, $rating, $comment, $id]);
    }

    // Delete
    public function deleteReview($id) {
        $sql = "DELETE FROM reviews WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }
}
?>
