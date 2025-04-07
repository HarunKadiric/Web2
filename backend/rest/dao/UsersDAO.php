<?php
require_once __DIR__ . '/../db.php';

class UserDAO {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function register($username, $email, $password, $role) {
        try {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $this->conn->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
            $success = $stmt->execute([$username, $email, $hashedPassword, $role]);
    
            if (!$success) {
                // Show the SQL error directly (only for debugging – remove this later!)
                die("DB Error: " . implode(" | ", $stmt->errorInfo()));
            }
    
            return $success;
        } catch (PDOException $e) {
            // Show exception message (again: remove for production!)
            die("PDO Exception: " . $e->getMessage());
        }
    }

    }

    public function login($email, $password) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }

    public function read($user_id) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE user_id = ?");
        $stmt->execute([$user_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($user_id, $username, $email, $role) {
        $stmt = $this->conn->prepare("UPDATE users SET username = ?, email = ?, role = ? WHERE user_id = ?");
        return $stmt->execute([$username, $email, $role, $user_id]);
    }

    public function delete($user_id) {
        $stmt = $this->conn->prepare("DELETE FROM users WHERE user_id = ?");
        return $stmt->execute([$user_id]);
    }

?>
