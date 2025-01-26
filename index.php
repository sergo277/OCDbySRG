<?php
// Инициализация сессии
session_start();

// Подключение к базе данных
include_once('api/db.php');

// require_once 'config/database.php';
// require_once 'includes/functions.php';
// function isAuthenticated() {
//     return false;
// }
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Онлайн консультации с врачами">
    <title>Карасукская ЦРБ - Онлайн консультации с врачами</title>
    
    <!-- Подключение стилей -->
    <link rel="stylesheet" href="lib/scss/font-awesome.scss">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="styles/settings.css">
    <link rel="stylesheet" href="styles/pages/index.css">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="assets/images/favicon.ico">
</head>
<body>
    <!-- Подключаем шапку -->
    <?php include 'includes/header.php'; ?>

    <!-- Главный экран -->
    <main>
        <section class="hero">
            <div class="container">
                <h1 class="hero__title">Консультации у врачей теперь онлайн!</h1>
                <p class="hero__subtitle">Получите профессиональную консультацию врача, не выходя из дома</p>
                
                <div class="search-form">
                    <form action="doctors.php" method="GET" class="search-form">
                        <div class="search-form__wrapper">
                            <input class= "search-form__input" type="text" 
                                   name="search" 
                                   placeholder="Поиск врача по ФИО или специализации"
                                   required>
                            <button type="submit" class="btn btn--primary">Найти врача</button>
                        </div>
                    </form>
                </div>

                <div class="popular-categories">
                    <h2 class="popular-categories__title">Популярные специальности</h2>
                    <div class="popular-categories__grid">
                        <a href="/specialists/therapist" class="category-card">
                            <i class="fa fa-stethoscope"></i>
                            <span>Терапевт</span>
                        </a>
                        <a href="/specialists/pediatrician" class="category-card">
                            <i class="fa fa-child"></i>
                            <span>Педиатр</span>
                        </a>
                        <a href="/specialists/psychologist" class="category-card">
                            <i class="fa fa-brain"></i>
                            <span>Психолог</span>
                        </a>
                        <a href="/specialists/dermatologist" class="category-card">
                            <i class="fa fa-allergies"></i>
                            <span>Дерматолог</span>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Преимущества -->
        <section class="benefits">
            <div class="container">
                <h2 class="section-title">Почему онлайн лучше?</h2>
                <div class="benefits__grid">
                    <div class="benefit-card">
                        <i class="fa fa-certificate"></i>
                        <h3>меньшее время ожидания</h3>
                        <p>Особенно при записи на онлайн консультацию заранее</p>
                    </div>
                    <div class="benefit-card">
                        <i class="fa fa-clock"></i>
                        <h3>доступность</h3>
                        <p>Консультации доступны в любой день недели по расписанию</p>
                    </div>
                    <div class="benefit-card">
                        <i class="fa fa-shield-alt"></i>
                        <h3>Безопасность</h3>
                        <p>Защищенные каналы связи и конфиденциальность данных</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Как это работает -->
        <section class="how-it-works">
            <div class="container">
                <h2 class="section-title">Как получить консультацию</h2>
                <div class="steps">
                    <div class="step">
                        <div class="step__number">1</div>
                        <h3>Выберите специалиста</h3>
                        <p>Найдите подходящего врача по специальности</p>
                    </div>
                    <div class="step">
                        <div class="step__number">2</div>
                        <h3>Запишитесь на прием</h3>
                        <p>Выберите удобное время для онлайн-консультации</p>
                    </div>
                    <div class="step">
                        <div class="step__number">3</div>
                        <h3>Получите консультацию</h3>
                        <p>Общайтесь с врачом через чат и, по завершению, вам выдадут справку</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Подключаем подвал -->
    <?php include 'includes/footer.php'; ?>

    <!-- Подключение скриптов -->
    <!-- <script src="assets/js/main.js"></script> -->
</body>
</html>
