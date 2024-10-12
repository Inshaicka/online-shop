<?php
session_start();

// Массив товаров (в реальности можно подключить базу данных)
$products = [
    [
        "name" => "Смартфон iPhone 13",
        "image" => "../assets/iphone13.jpg",
        "description" => "Смартфон Apple с новейшими технологиями.",
        "price" => 799
    ],
    [
        "name" => "Ноутбук MacBookAir",
        "image" => "../assets/macbook_air.png",
        "description" => "Легкий и мощный ноутбук для работы и учебы.",
        "price" => 999
    ],
    [
        "name" => "Смарт-часы Apple Watch",
        "image" => "../assets/apple_watch.jpg",
        "description" => "Следите за здоровьем и активностью с Apple Watch.",
        "price" => 399
    ],
    [
        "name" => "Планшет Samsung Galaxy Tab S7",
        "image" => "../assets/galaxy_tab_s7.jpg",
        "description" => "Мощный планшет с большим экраном для работы и развлечений.",
        "price" => 649
    ],
    [
        "name" => "Игровая консоль PlayStation 5",
        "image" => "../assets/ps5.jpg",
        "description" => "Самая популярная игровая консоль нового поколения.",
        "price" => 499
    ],
    [
        "name" => "Наушники Sony WH-1000XM4",
        "image" => "../assets/sony_wh1000xm4.jpg",
        "description" => "Беспроводные наушники с шумоподавлением.",
        "price" => 349
    ],
    [
        "name" => "Умная колонка Amazon Echo",
        "image" => "../assets/amazon_echo.jpg",
        "description" => "Голосовой помощник для вашего дома.",
        "price" => 99
    ],
    [
        "name" => "Камера GoPro Hero 9",
        "image" => "../assets/gopro_hero9.jpg",
        "description" => "Камера для экстремальных условий съемки.",
        "price" => 449
    ],
    [
        "name" => "Ноутбук Dell XPS 13",
        "image" => "../assets/dell_xps_13.jpg",
        "description" => "Ультратонкий ноутбук с мощным процессором.",
        "price" => 1199
    ],
    [
        "name" => "Игровая мышь Logitech G502",
        "image" => "../assets/logitech_g502.jpg",
        "description" => "Игровая мышь с высокой точностью и удобством.",
        "price" => 59
    ]
];

// Добавление товара в корзину
if (isset($_POST['add_to_cart'])) {
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    
    $cart_item = [
        "name" => $product_name,
        "price" => $product_price
    ];

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    $_SESSION['cart'][] = $cart_item;
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Товары - ТехноМир</title>
    <link rel="stylesheet" href="../styles/services.css">
    <link rel="stylesheet" href="../styles/bar.css">
    <link rel="stylesheet" href="../styles/footer.css">
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
        <section class="products">
            <h2>Наши товары</h2>

            <div class="filter-sort">
                <form method="GET" action="services.php">
                    <label for="sort_by">Сортировка по цене:</label>
                    <select name="sort_by" id="sort_by">
                        <option value="asc">По возрастанию</option>
                        <option value="desc">По убыванию</option>
                    </select>
                    <button type="submit">Применить</button>
                </form>
            </div>

            <div class="product-grid">
                <?php
                if (isset($_GET['sort_by'])) {
                    if ($_GET['sort_by'] == 'asc') {
                        usort($products, function($a, $b) {
                            return $a['price'] - $b['price'];
                        });
                    } elseif ($_GET['sort_by'] == 'desc') {
                        usort($products, function($a, $b) {
                            return $b['price'] - $a['price'];
                        });
                    }
                }

                foreach ($products as $product): ?>
                    <div class="product-card">
                        <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
                        <h3><?php echo $product['name']; ?></h3>
                        <p><?php echo $product['description']; ?></p>
                        <p class="price"><?php echo $product['price']; ?> $</p>
                        <form method="POST" action="services.php">
                            <input type="hidden" name="product_name" value="<?php echo $product['name']; ?>">
                            <input type="hidden" name="product_price" value="<?php echo $product['price']; ?>">
                            <button type="submit" name="add_to_cart">Добавить в корзину</button>
                        </form>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 ТехноМир. Все права защищены.</p> 
    </footer>

<script src="https://kit.fontawesome.com/fce9a50d02.js" crossorigin="anonymous"></script>

</body>
</html>
