<?php

// Действия над комметарием
function handle_action( $db ) {

	if (!isset( $_REQUEST['action'] )) {		// если нет никакого действия в поле action - выходим
		return;
	}

	switch ($_REQUEST['action']) {				// в зависимости от поля action выполняем одно из действий над комментарием
		case 'create':
			// определение параметров, необходимых к заполнению
			$params = empty( $_SESSION['username']) ? [ 'username', 'message'] : ['message'];
			// если не нашли нужные для заполнения элементы по ключам массива $_POST - выходим 
			if ( !array_have_values( array_keys($_POST), $params)) {
				return;
			}
			// добавляем комментарий. Если $_SESSION['username'] != null - используем его, иначе из $_POST['username']
			create_comment( $db, $_SESSION['username'] ?? $_POST['username'], $_POST['message']);	
			break;

		case 'update':
			if ( !array_have_values( array_keys($_POST), ['id', 'message'])) {
				return;
			}
			update_comment( $db, $_POST['id'], $_POST['message']);	// изменяем сообщение комментария, id передаёт форма через post
			break;

		case 'delete':
			if (empty( $_GET['id'])) {				// если id пуст - выходим
				return;
			}
			delete_comment( $db, $_GET['id']);		// удаляем комментарий по id
			break;
	}
}

// Проверка параметров. Сравниваем пересечение полученных данных с требуемыми для заполнения. Если колличество элементов равно - значит есть все необходимые данные
function array_have_values( $source, $neddle ) {
	return count( array_intersect( $source, $neddle )) === count( $neddle );
}

?>