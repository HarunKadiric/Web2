<?php
require_once __DIR__ . '/../dao/UsersDAO.php';
require_once __DIR__ . '/../db.php';

header("Content-Type: application/json");

$dao = new UserDAO($pdo);

// Get request method and input
$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents("php://input"), true);
$action = $_GET['action'] ?? '';

switch ($method) {
    case 'POST':
        if ($action === 'register') {
            $success = $dao->register(
                $input['username'],
                $input['email'],
                $input['password'],
                $input['role']
            );
            echo json_encode(["success" => $success]);
        } elseif ($action === 'login') {
            $user = $dao->login($input['email'], $input['password']);
            if ($user) {
                unset($user['password']); // Hide hashed password
                echo json_encode($user);
            } else {
                http_response_code(401);
                echo json_encode(["error" => "Invalid email or password"]);
            }
        } else {
            echo json_encode(["error" => "Unknown action"]);
        }
        break;

    case 'GET':
        if (isset($_GET['id'])) {
            echo json_encode($dao->read($_GET['id']));
        } else {
            echo json_encode(["error" => "User ID required."]);
        }
        break;

    default:
        echo json_encode(["error" => "Unsupported request method."]);
}
?>
