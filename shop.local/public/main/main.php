<?php
session_start();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../styles/style.css">
    <link rel="stylesheet" type="text/css" href="../styles/bar.css">
    <link rel="stylesheet" href="../styles/footer.css">

    <title>ТехноМир - Интернет-магазин электроники</title>
</head>
<body>

    <header>
        <div class="logo">
            <img src="../assets/logo.jpeg" alt="company-logo">
            <h1>ТехноМир</h1>
        </div>
        <nav id="main-nav">
            <ul>
                <li><a href="../main/main.php"><i class="fas fa-home"></i> Главная</a></li>
                <li><a href="../services/services.php" class="nava"><i class="fas fa-shopping-cart"></i> Товары</a></li>
                <li><a href="../contact/contact.html"><i class="fas fa-envelope"></i> Контакты</a></li>
            </ul>
        </nav>
        <div class="registration">
            <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
                <a href="../profile/profile.php"><i class="fas fa-user"></i> Личный кабинет</a>
            <?php else: ?>
                <a href="../authorization/registration.php"><i class="fas fa-briefcase"></i> Регистрация</a>
            <?php endif; ?>
        </div>
        
    </header>

    <main>
        <section class="welcome">
            <div class="welcome-content">
                <h1>Добро пожаловать в ТехноМир!</h1>
                <p>Здесь вы найдете все необходимые электронные устройства и гаджеты для комфортной жизни и работы.</p>
            </div>            
        </section>

        <section class="about-company">
            <h2>О компании</h2>
            <p>ТехноМир - это интернет-магазин, специализирующийся на продаже электроники: от смартфонов и ноутбуков до умных устройств для дома и офиса. Мы предлагаем высококачественные товары от ведущих мировых производителей по доступным ценам. Наша миссия - сделать технологические решения доступными для всех.</p>
            <p>Мы гарантируем отличный сервис и быструю доставку. Наши эксперты всегда готовы помочь вам с выбором лучшей техники для ваших нужд.</p>
        </section>
    </main>

    <hr style="width: 75%; margin: 0 auto;">

    <footer>
        <p>&copy; 2024 ТехноМир. Все права защищены.</p> 
    </footer>

<script src="script.js"> </script>
<script src="https://kit.fontawesome.com/fce9a50d02.js" crossorigin="anonymous"></script>

</body>
</html>
