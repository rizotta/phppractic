<?php 
 
function user_is_guest() {
	return empty($_SESSION['user_id']); 		// по наличию сессии с id проверяем, что пользователь зарегистрирован
}

// аутентификация 
function auth_user( $username, $password) {
	$pdo = connect();							// подключение к базе
	$stmt = $pdo->prepare( 'SELECT * from user WHERE username = :username' );	// подготовка запроса

	if ( !$stmt->execute([ ':username'=> $username ])) {  // если что-то пошло не так - выдаём ошибку
		return 'Ошибка работы запроса';
	}

	if ( $stmt->rowCount() === 0 ) {			// если количество записей по имени = 0, значит пользователь не найден (потенциальная угроза если нет ограничения на количество запросов, возможно лучше сразу проверять имя + пароль)
		return 'Пользователь не существует';
	}

	$user = $stmt->fetch();						// если найдены записи в БД, то получаем информацию о пользователе

	if ( !validate_password( $password, $user['password'])) {
		return 'Неверный пароль';
	}

	$_SESSION['user_id'] = $user['id'];			// записываем id в сессию
	return true;								// возвращаем истину если пользователь подтверждён
}

// проверка валидации пароля
function validate_password( $str, $hash) {
	return $hash === get_password( $str );		// сравнение хеша в БД с полученным хешем пароля от пользователя
}

// Генерация хеша пароля
function get_password( $str ) {
	$round = 10;								// несколько итераций для генерации соли
	$str = crypt( $str, md5( $str ));			// строка + соль
	while( $round-- ) {
		$str = crypt( $str, sha1( $str ));
	}
	return $str;
}

// подключение к базе
function connect() {
	static $db;									// делаем переменную статической
	if ($db ) {
		return $db;
	}
	return $db = new PDO("mysql:host=localhost;dbname=practic_chat;charset=UTF8", "mysql", "mysql");
}