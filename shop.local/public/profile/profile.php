<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Личный кабинет</title>
</head>
<body>
	<?php
	session_start();

	if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
		header('Location: ../login/login.php');
		exit;
	}
	?>

	<h1>Личный кабинет</h1>
</body>
</html>