<?php

// получение всех комментариев из базы
function get_comments( $db ) {
	$stmt = $db->query( 'SELECT * FROM comment');		// запрос к базе (используется вместо prepare + bindParam, т.к. нет передачи параметров)
	return $stmt->fetchAll();							// возвращение результата
}

// добавление комментария
function create_comment( $db, $username, $message ) {
	$session_id = session_id();							// значение в параметрах передаются по ссылке, поэтому сохраняем функцию в переменную

	if (empty($_SESSION[ 'username' ])) {				// если в сессии имя пустое - заполняем
		$_SESSION[ 'username' ] = $username;
	}

	$stmt = $db->prepare( 'INSERT INTO comment (username, message, session_id ) VALUES ( ?, ?, ?)' ); 	// подготовка запроса. prepare + bindParam, чтобы удобно вынести неименованные параметры из запроса
	$message = htmlspecialchars( $message );			// обработка специальных символов в комментарии
	$stmt->bindParam( 1, $username, PDO::PARAM_STR );	// привязываем параметр к переменной: 1 - позиция в запросе, $username - имя переменной, PDO::PARAM_STR - тип данных
	$stmt->bindParam( 2, $message, PDO::PARAM_STR );	
	$stmt->bindParam( 3, $session_id, PDO::PARAM_STR );

	return $stmt->execute();							// выполнение подготовленного запроса
}

// изменение комментария
function update_comment( $db, $id, $message ) {
	$session_id = session_id();
	$stmt = $db->prepare( 'UPDATE comment SET message = ? WHERE id = ? AND session_id = ?' );
	$message = htmlspecialchars( $message );
	$stmt->bindParam( 1, $message, PDO::PARAM_STR );											
	$stmt->bindParam( 2, $id, PDO::PARAM_INT );
	$stmt->bindParam( 3, $session_id, PDO::PARAM_STR );

	return $stmt->execute();
}

// удаление комментария
function delete_comment( $db, $id ) {
	$session_id = session_id();
	$stmt = $db->prepare( 'DELETE FROM comment WHERE id = ? AND session_id = ?');
	// $stmt->bindParam( 1, $id, PDO::PARAM_INT );
	// $stmt->bindParam( 2, $session_id, PDO::PARAM_STR );
	// return $stmt->execute();
	return $stmt->execute([ $id, $session_id ]);	// параметры в execute аналогично bindParam
}

// Проверка, является ли пользователь собственником комментария
function is_comment_owner( $comment ) {
	return $comment[ 'session_id' ] === session_id();
}

?>