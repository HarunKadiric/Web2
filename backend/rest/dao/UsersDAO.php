<?php
require_once __DIR__ . '/../db.php';

class UserDAO {
    private $conn;

    public function __construct($pdo) {
        $this->conn = $pdo;
    }

    public function register($username, $email, $password, $role) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->conn->prepare("INSERT INTO Users (username, email, password, role) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$username, $email, $hashedPassword, $role]);
    }

    public function login($email, $password) {
        $stmt = $this->conn->prepare("SELECT * FROM Users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }

    public function read($user_id) {
        $stmt = $this->conn->prepare("SELECT * FROM Users WHERE user_id = ?");
        $stmt->execute([$user_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($user_id, $username, $email, $role) {
        $stmt = $this->conn->prepare("UPDATE Users SET username = ?, email = ?, role = ? WHERE user_id = ?");
        return $stmt->execute([$username, $email, $role, $user_id]);
    }

    public function delete($user_id) {
        $stmt = $this->conn->prepare("DELETE FROM Users WHERE user_id = ?");
        return $stmt->execute([$user_id]);
    }
}
?>
