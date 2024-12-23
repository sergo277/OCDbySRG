<?php
session_start();
// require_once 'config/database.php';
// require_once 'includes/functions.php';
function isAuthenticated() {
    return false;
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Онлайн консультации с врачами">
    <title>МедОнлайн - Онлайн консультации с врачами</title>
    
    <!-- Подключение стилей -->
    <link rel="stylesheet" href="lib/scss/font-awesome.scss">
    <link rel="stylesheet" href="styles/settings.css">
    <link rel="stylesheet" href="styles/pages/index.css">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="assets/images/favicon.ico">
</head>
<body>
    <!-- Шапка сайта -->
    <header class="header">
        <div class="container">
            <div class="header__wrapper">
                <a href="/" class="logo">
                    <img src= "img/logo.png" alt="МедОнлайн">
                </a>
                
                <nav class="main-nav">
                    <ul class="main-nav__list">
                        <li><a href="/specialists">Врачи</a></li>
                        <li><a href="/services">Услуги</a></li>
                        <li><a href="/prices">Цены</a></li>
                        <li><a href="/about">О нас</a></li>
                    </ul>
                </nav>

                <div class="user-actions">
                    <!-- <?php if (isAuthenticated()): ?> -->
                        <a href="/profile" class="btn btn--secondary">Личный кабинет</a>
                    <!-- <?php else: ?> -->
                        <a href="/login" class="btn btn--primary">Войти</a>
                    <!-- <?php endif; ?> -->
                </div>
            </div>
        </div>
    </header>

    <!-- Главный экран -->
    <main>
        <section class="hero">
            <div class="container">
                <h1 class="hero__title">Онлайн консультации с проверенными врачами</h1>
                <p class="hero__subtitle">Получите профессиональную консультацию врача, не выходя из дома</p>
                
                <div class="search-form">
                    <form action="/search" method="GET">
                        <div class="search-form__wrapper">
                            <input type="text" 
                                   name="query" 
                                   placeholder="Поиск врача по специальности или имени"
                                   class="search-form__input">
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
                <h2 class="section-title">Почему выбирают нас</h2>
                <div class="benefits__grid">
                    <div class="benefit-card">
                        <i class="fa fa-certificate"></i>
                        <h3>Проверенные врачи</h3>
                        <p>Все специалисты имеют подтвержденное образование и лицензии</p>
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
                        <p>Общайтесь с врачом через чат и, по завершению, вам выдадут направление </p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Подвал -->
    <footer class="footer">
        <div class="container">
            <div class="footer__grid">
                <div class="footer__column">
                    <h4>О компании</h4>
                    <ul>
                        <li><a href="/about">О нас</a></li>
                        <li><a href="/doctors">Врачи</a></li>
                        <li><a href="/reviews">Отзывы</a></li>
                        <li><a href="/contacts">Контакты</a></li>
                    </ul>
                </div>
                <div class="footer__column">
                    <h4>Пациентам</h4>
                    <ul>
                        <li><a href="/how-it-works">Как это работает</a></li>
                        <li><a href="/faq">Частые вопросы</a></li>
                        <li><a href="/blog">Блог о здоровье</a></li>
                    </ul>
                </div>
                <div class="footer__column">
                    <h4>Документы</h4>
                    <ul>
                        <li><a href="/privacy">Политика конфиденциальности</a></li>
                        <li><a href="/terms">Пользовательское соглашение</a></li>
                        <li><a href="/license">Лицензии</a></li>
                    </ul>
                </div>
                <div class="footer__column">
                    <h4>Контакты</h4>
                    <ul>
                        <li>Телефон: 8 (800) 100-20-30</li>
                        <li>Email: info@medonline.ru</li>
                        <li>
                            <div class="social-links">
                                <a href="#" class="social-link"><i class="fab fa-vk"></i></a>
                                <a href="#" class="social-link"><i class="fab fa-telegram"></i></a>
                                <a href="#" class="social-link"><i class="fab fa-whatsapp"></i></a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="footer__bottom">
                <p>&copy; <?php echo date('Y'); ?> МедОнлайн. Все права защищены.</p>
            </div>
        </div>
    </footer>

    <!-- Подключение скриптов -->
    <!-- <script src="assets/js/main.js"></script> -->
</body>
</html>
