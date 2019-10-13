<?php

// Действия над комметарием
function handle_action( $db ) {

	if (!isset( $_REQUEST['action'] )) {		// если нет никакого действия в поле action - выходим из функции
		return;
	}

	switch ($_REQUEST['action']) {				// в зависимости от поля action выполняет одно из действий над комментарием
		case 'create':
			$params = empty( $_SESSION['username']) ? [ 'username', 'message'] : ['message'];

			if ( !array_have_values( array_keys($_POST), $params)) {	// если не нашли нужные элементы по ключам массива $_POST - выходим 
				return;
			}
			create_comment( $db, $_SESSION['username'] ?? $_POST['username'], $_POST['message']);	// добавляем комментарий. Если $_SESSION['username'] != null - используем его, иначе $_POST['username']
			break;

		case 'update':
			if ( !array_have_values( array_keys($_POST), ['id', 'message'])) {
				return;
			}
			update_comment( $db, $_POST['id'], $_POST['message']);						// изменяем сообщение комментария по id
			break;

		case 'delete':
			if (empty( $_GET['id'])) {													// если id пуст - выходим
				return;
			}

			delete_comment( $db, $_GET['id']);											// удаляем комментарий по id
			break;
	}
}

// Проверка параметров. Сравниваем пересечение полученных данных с требуемыми для заполнения. Если колличество элементов равно - значит есть все необходимые данные
function array_have_values( $source, $neddle ) {
	return count( array_intersect( $source, $neddle )) === count( $neddle );		

}

?>