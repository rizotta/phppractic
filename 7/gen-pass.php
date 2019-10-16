<?php
// Файл не используется в проекте, нужен для генерации хеша определённых паролей
require 'functions.php';
$str = $_GET[ 'password' ] ?? uniqid();		// если нет значения, то будет уникальное, основанное на времени в микросекундах
$hash = get_password( $str );
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Генерация паролей</title>
</head>
<body>
	<div>
		Для пароля <b><?= $str ?></b>, хэш: <b><?= $hash ?></b>
	</div>
	<form action="">
		<input type="text" name="password">
		<button>Получить хэш</button>
	</form>
</body>
</html>