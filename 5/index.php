<?

// получаем соединение
function getConnection() {
	return new PDO("mysql:host=localhost;dbname=gb-adress-book;charset=UTF8", "mysql", "mysql");
}
// var_dump( getConnection() );	// Проверяем что функция работает. Д.б: object(PDO)#1 (0) { }  

// получаем пользователей
function getUsers( $db ) {
	$sth = $db->prepare('SELECT * FROM user WHERE is_deleted = 0');	// подготовка запроса
	$sth->execute();							// выполнение запроса
	return $sth->fetchAll();					// возвращение результата
}

// помечаем пользователей на удаление
function removeUser( $id, $db ) {
	$sth = $db->prepare('UPDATE user SET is_deleted = 1 WHERE id = ?');	// неименованный параметр ? вместо id чтобы не было уязвимости
	
	$sth->bindParam( 1, $id, PDO::PARAM_INT ); 	
	// 1 - позиция псевдопеременной в запросе (вместо первого ?), 
	// $id - имя переменной, которую требуется привязать к параметру SQL-запроса
	// PDO::PARAM_INT - явно заданный тип данных параметра
	$sth->execute();
	return $sth->fetchAll();
}

// удаляем пользователей из базы
function removeUserForever( $id, $db ) {
	$sth = $db->prepare('DELETE FROM user WHERE id = ?');
	$sth->bindParam( 1, $id, PDO::PARAM_INT ); 	
	$sth->execute();
	return $sth->fetchAll();
}


// добавление пользователей
function addUser( $params, $db ) {
	$sth = $db->prepare('INSERT INTO user (name, last_name, username, password, email, age, birthday) VALUES (:name, :last_name, :username, :password, :email, :age, :birthday)');	

	$sth->execute([
			':name'	 	=> $params[ 'name' ],
			':last_name'=> $params[ 'last_name' ],
			':username' => $params[ 'username' ],
			':password' => $params[ 'password' ],
			':email' 	=> $params[ 'email' ],
			':birthday' => $params[ 'birthday' ],
			':age' 		=> getFullAge($params[ 'birthday' ])	// вычисляем возраст из даты рождения
		]);

	return $sth->fetchAll();
}

// восстанавливаем пользователей, помеченных на удаление
function restoreUser( $db ) {
	$sth = $db->prepare('UPDATE user SET is_deleted = 0 WHERE is_deleted = 1');		// подготовка запроса
	$sth->execute();																// выполнение запроса
	?> <script type="text/javascript">
		window.location.href = "/5";
	</script> <?
	return $sth->fetchAll();														// вывод результата

}

// вычисляем возраст по дате рождения
function getFullAge( $birthday ) {
	$birthday = new DateTime($birthday);
	$interval = $birthday->diff(new DateTime);
	return $interval->y;
}


$db = getConnection();	

//var_dump( $users );				// для проверки отображения результата выборки в виде массива


if (isset( $_GET[ 'delete' ])) {
	 removeUser($_GET[ 'delete' ], $db);
}

if (isset( $_GET[ 'deleteForever' ])) {
	 removeUserForever($_GET[ 'deleteForever' ], $db);
}

if (isset( $_GET[ 'restore' ])) {
	 restoreUser( $db );
}

if (isset( $_POST[ 'insert' ])) {		// добавляем с помощью POST-данных
	 addUser( $_POST, $db );
}

$users = getUsers( $db );	// важно, чтобы получение пользователей было после вызова функций удаления и добавления
require 'view.php';			// подключаем файл с отображением страницы (после ф-й удаления и добавления)

?>  