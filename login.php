<?php
header('Content-Type: application/json');
require_once "config.php";

// Allow only POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        "status" => "error",
        "message" => "Invalid request method"
    ]);
    exit;
}

$email    = trim($_POST['email'] ?? '');
$password = trim($_POST['password'] ?? '');

if ($email === '' || $password === '') {
    echo json_encode([
        "status" => "error",
        "message" => "Email and password are required"
    ]);
    exit;
}

$stmt = $conn->prepare(
    "SELECT id, name, password FROM students WHERE email=? LIMIT 1"
);
$stmt->bind_param("s", $email);
$stmt->execute();
$res = $stmt->get_result();
$user = $res->fetch_assoc();
$stmt->close();

if ($user && password_verify($password, $user['password'])) {
    echo json_encode([
        "status"     => "success",
        "student_id" => (string)$user['id'],
        "name"       => $user['name']
    ]);
} else {
    echo json_encode([
        "status"  => "error",
        "message" => "Invalid email or password"
    ]);
}
