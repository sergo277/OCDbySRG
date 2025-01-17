<?php 
session_start();
include_once './db.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Очищаем данные от лишних пробелов
    $formData = array_map('trim', $_POST);
    
    // Определяем обязательные поля
    $fields = [
        'name',
        'surname',
        'email',
        'phone',
        'password',
        'password_confirm',
        'agree'
    ];

    // Добавляем проверку специализации для врачей
    if (isset($formData['user_type']) && $formData['user_type'] === 'doctor') {
        $fields[] = 'specialization';
    }
    
    $errors = [];

    // Защита от XSS
    foreach($formData as $key => $value){
        $formData[$key] = htmlspecialchars($value);
    }

    // Проверка заполненности обязательных полей
    foreach ($fields as $field) {
        if (!isset($formData[$field]) || empty($formData[$field])) {
            $errors[$field][] = 'Поле обязательно для заполнения';
        }
    }

    // Дополнительная проверка для врачей
    if (isset($formData['user_type']) && $formData['user_type'] === 'doctor' && empty($formData['specialization'])) {
        $errors['specialization'][] = 'Выберите специализацию';
    }

    // Валидация email
    if (!empty($formData['email']) && !filter_var($formData['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'][] = 'Некорректный формат email';
    }

    // Валидация телефона
    if (!empty($formData['phone'])) {
        $phone = preg_replace('/[^0-9+]/', '', $formData['phone']);
        if (!preg_match('/^\+7[0-9]{10}$/', $phone)) {
            $errors['phone'][] = 'Некорректный формат телефона';
        }
    }

    // Проверка паролей
    if (!empty($formData['password'])) {
        if (strlen($formData['password']) < 6) {
            $errors['password'][] = 'Пароль должен быть не менее 6 символов';
        }
        if ($formData['password'] !== $formData['password_confirm']) {
            $errors['password_confirm'][] = 'Пароли не совпадают';
        }
    }

    // Проверка уникальности email и телефона
    if (empty($errors['email']) && empty($errors['phone'])) {
        $stmt = $db->prepare("SELECT email, phone FROM users WHERE email = ? OR phone = ?");
        $stmt->execute([$formData['email'], $formData['phone']]);
        $user = $stmt->fetch();

        if ($user) {
            if ($user['email'] == $formData['email']) {
                $errors['email'][] = 'Этот email уже зарегистрирован';
            }
            if ($user['phone'] == $formData['phone']) {
                $errors['phone'][] = 'Этот номер телефона уже зарегистрирован';
            }
        }
    }

    // Если нет ошибок, сохраняем пользователя
    if (empty($errors)) {
        try {
            // Хешируем пароль
            $hashedPassword = password_hash($formData['password'], PASSWORD_DEFAULT);
            
            // Определяем тип пользователя
            $userType = isset($formData['user_type']) ? $formData['user_type'] : 'patient';
            
            // Подготавливаем и выполняем запрос
            $stmt = $db->prepare("
                INSERT INTO users (
                    name, 
                    surname, 
                    patronymic, 
                    email, 
                    phone, 
                    password, 
                    agree, 
                    type,
                    specialization
                ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
            ");

            $result = $stmt->execute([
                $formData['name'],
                $formData['surname'],
                $formData['patronymic'] ?? null,
                $formData['email'],
                $formData['phone'],
                $hashedPassword,
                $formData['agree'] ? 1 : 0,
                $userType,
                ($userType === 'doctor') ? $formData['specialization'] : null
            ]);

            if ($result) {
                // Очищаем ошибки и перенаправляем на страницу входа
                unset($_SESSION['register-errors']);
                header('Location: ../login.php');
                exit;
            } else {
                throw new Exception('Ошибка при выполнении запроса');
            }

        } catch (Exception $e) {
            $errors['system'][] = 'Ошибка при регистрации. Попробуйте позже.';
            error_log($e->getMessage());
        }
    }

    // Если есть ошибки, сохраняем их в сессию и возвращаемся на форму
    if (!empty($errors)) {
        $_SESSION['register-errors'] = $errors;
        header('Location: ../register.php');
        exit;
    }
}

// Добавим отладочный код
if (!empty($errors)) {
    error_log('Registration errors: ' . print_r($errors, true));
}
?> 