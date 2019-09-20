<a href="../">Вернуться на главную страницу</a><br>	<br>	

<?
// получаем соединение
function getConnection() {
	return new PDO("mysql:host=localhost;dbname=gb-adress-book;charset=UTF8", "mysql", "mysql");
}
//var_dump( getConnection() );	// Проверяем что функция работает. Д.б: object(PDO)#1 (0) { }  

// получаем пользователей
function getUsers( $db ) {
	$sth = $db->prepare('SELECT * FROM user');	// подготовка запроса
	$sth->execute();							// выполнение запроса
	return $sth->fetchAll();					// возвращение результата
}

function removeUser( $id, $db ) {
	$sth = $db->prepare('DELETE FROM user WHERE id = ?');	// неименованный параметр ? вместо id чтобы не было уязвимости
	
	$sth->bindParam( 1, $id, PDO::PARAM_INT ); 	
	// 1 - позиция псевдопеременной в запросе (вместо первого ?), 
	// $id - имя переменной, которую требуется привязать к параметру SQL-запроса
	// PDO::PARAM_INT - явно заданный тип данных параметра
	$sth->execute();
	return $sth->fetchAll();
}

function addUser( $params, $db ) {
	$sth = $db->prepare('INSERT INTO user (name, last_name, username, password, email, age, birthday) VALUES (:name, :last_name, :username, :password, :email, :age, :birthday)');	

	$sth->execute([
			':name'	 	=> $params[ 'name' ],
			':last_name' => $params[ 'last_name' ],
			':username' => $params[ 'username' ],
			':password' => $params[ 'password' ],		// Нужно в будущем хранить пароли в зашифрованом виде
			':email' 	=> $params[ 'email' ],
			':age' 		=> $params[ 'age' ],
			':birthday' => $params[ 'birthday' ],
		]);
    
	return $sth->fetchAll();
}

$db = getConnection();	

//var_dump( $users );				// для проверки отображения результата выборки в виде массива


// нужно доделать переадресацию на основную страницу после удаления
// а то в запросе остаётся http://pp/5/?delete=15
if (isset( $_GET[ 'delete' ])) {
	 removeUser($_GET[ 'delete' ], $db);
}

if (isset( $_POST[ 'insert' ])) {		// добавляем с помощью POST-данных
	 addUser( $_POST, $db );
}

$users = getUsers( $db );	// важно, чтобы это было после вызова функций удаления и добавления
require 'view.php';			// подключаем файл с отображением страницы (после ф-й удаления и добавления)

?>  