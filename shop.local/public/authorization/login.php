<?php
session_start();
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conn = new mysqli('MySQL-8.2', 'root', '', 'login');
    if ($conn->connect_error) {
        die('Ошибка подключения: ' . $conn->connect_error);
    }

    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($hashed_password);
    $stmt->fetch();
    $stmt->close();

    if ($hashed_password && password_verify($password, $hashed_password)) {
        $_SESSION['username'] = $username;
        $_SESSION['loggedin'] = true;
        header("Location: ../main/main.php");
        exit;
    } else {
        $error = 'Неверный логин или пароль.';
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Логин</title>
    <link rel="stylesheet" href="../styles/register.css">
    <style>
        .error {
            color: red;
            font-size: 14px;
            margin-bottom: 15px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-box">
            <h2>Логин</h2>
            <?php if (!empty($error)): ?>
                <p class="error"><?php echo $error; ?></p>
            <?php endif; ?>
            <form method="post">
                <div class="input-box">
                    <input type="text" name="username" required>
                    <label>Имя пользователя</label>
                </div>
                <div class="input-box">
                    <input type="password" name="password" required>
                    <label>Пароль</label>
                </div>
                <button type="submit" class="btn">Войти</button>
            </form>
            <p style="margin-top: 20px;">Нет аккаунта? <a href="registration.php" style="color:#ff6f00">Зарегистрируйтесь</a></p>
        </div>
    </div>
</body>
</html>
