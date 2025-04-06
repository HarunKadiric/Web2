<?php
require_once 'db.php';

$stmt = $pdo->query("SELECT * FROM Users"); // Make sure this table exists
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "<pre>";
print_r($users);
echo "</pre>";
?>
