<?php 
session_start();
include_once './db.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Очищаем данные от лишних пробелов
    $formData = array_map('trim', $_POST);
    
    $fields = [
        'email',
        'password',
    ];
    $errors = [];

    // Защита от XSS
    foreach($formData as $key => $value){
        $formData[$key] = htmlspecialchars($value);
    }
  
    // Базовая проверка на заполненность
    foreach ($fields as $field) {
        if (!isset($formData[$field]) || empty($formData[$field])) {
            $errors[$field][] = 'Поле обязательно для заполнения';
        }
    }

    if (empty($errors)) {
        try {
            // Получаем пользователя по email
            $stmt = $db->prepare("
                SELECT id, email, password, type, name 
                FROM users 
                WHERE email = ?
            ");
            $stmt->execute([$formData['email']]);
            $user = $stmt->fetch();

            if (!$user) {
                $errors['email'][] = 'Пользователь не найден';
            } else {
                // Проверяем пароль
                if (!password_verify($formData['password'], $user['password'])) {
                    $errors['password'][] = 'Неверный пароль';
                } else {
                    // Генерируем новый токен
                    $hash = bin2hex(random_bytes(32));
                    $token = base64_encode($hash);

                    // Обновляем токен в базе
                    $stmt = $db->prepare("
                        UPDATE users 
                        SET api_token = ? 
                        WHERE id = ?
                    ");
                    $stmt->execute([$token, $user['id']]);

                    // Сохраняем данные в сессию
                    $_SESSION['token'] = $token;
                    $_SESSION['user_name'] = $user['name'];
                    $_SESSION['user_type'] = $user['type'];

                    // Перенаправляем в зависимости от типа пользователя
                    switch ($user['type']) {
                        case 'doctor':
                            header('Location: ../doctor.php');
                            break;
                        case 'admin':
                            header('Location: ../admin.php');
                            break;
                        case 'patient':
                        default:
                            header('Location: ../user.php');
                            break;
                    }
                    exit;
                }
            }
        } catch (PDOException $e) {
            $errors['system'][] = 'Ошибка авторизации. Попробуйте позже.';
            error_log($e->getMessage());
        }
    }

    // Если есть ошибки
    if (!empty($errors)) {
        $_SESSION['login-error'] = $errors;
        header('Location: ../login.php');
        exit;
    }
}
?> 