<?php
// Подключение к базе данных
$conn = new mysqli('MySQL-8.2', 'root', '', 'login');
if ($conn->connect_error) {
    die('Ошибка подключения: ' . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    // Вставка в базу данных
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Form</title>
    <link rel="stylesheet" href="../styles/register.css">
    <script>
        function validateForm(event) {
            event.preventDefault();
            
            const username = document.querySelector('input[name="username"]').value;
            const email = document.querySelector('input[name="email"]').value;
            const password = document.querySelector('input.password').value;
            const passwordRepeat = document.querySelector('input.password_repeat').value;

            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (password.length < 8) {
                alert("Пароль должен быть не менее 8 символов");
                return;
            } if (password !== passwordRepeat) {
                alert("Пароли не совпадают");
                return;
            }
            document.querySelector('form').submit();
        }
    </script>
</head>
<body>
    <div class="container">
        <div class="form-box">
            <h2>Регистрация</h2>
            <form method="post" onsubmit="validateForm(event)">
                <div class="input-box">
                    <input type="text" name="username" required>
                    <label>Имя пользователя</label>
                </div>
                <div class="input-box">
                    <input type="email" name="email" required>
                    <label>Почта</label>
                </div>
                <div class="input-box">
                    <input class='password' type="password" name="password" required>
                    <label>Пароль</label>
                </div>
                <div class="input-box">
                    <input class='password_repeat' type="password" name="password_repeat" required>
                    <label>Повторите пароль</label>
                </div>
                <button type="submit" class="btn">Регистрация</button>
            </form>
            <p style="margin-top: 20px;">Уже есть аккаунт? <a href="login.php" style="color:#ff6f00">Войдите здесь</a></p>
        </div>
    </div>
</body>
</html>
