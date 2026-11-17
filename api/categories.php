<?php
require_once '../includes/auth_guard.php';
require_once '../includes/db.php';

header('Content-Type: application/json');

try {
    $stmt = $pdo->query('select id, name from categories');
    echo json_encode($stmt->fetchAll() ?: []);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}