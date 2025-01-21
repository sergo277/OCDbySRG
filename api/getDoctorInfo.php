<?php
session_start();
include_once 'db.php';

if (!isset($_SESSION['token'])) {
    http_response_code(401);
    exit;
}

if (isset($_GET['id'])) {
    $stmt = $db->prepare("
        SELECT id, name, surname, patronymic, specialization, experience_years, about_doctor 
        FROM users 
        WHERE id = ? AND type = 'doctor'
    ");
    $stmt->execute([$_GET['id']]);
    $doctor = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($doctor) {
        echo json_encode($doctor);
    } else {
        http_response_code(404);
        echo json_encode(['error' => 'Врач не найден']);
    }
}
?> 