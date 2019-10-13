<?php
require 'comments.php';				// здесь функции create_comment, update_comment, get_comments, delete_comment
require 'contoller.php';			// здесь функция handle_action, которая обрабатывает действия над комментариями 

session_start();					// включение сессии

$db = new PDO("mysql:host=localhost;dbname=practic_chat;charset=UTF8", "mysql", "mysql");	// подключение к БД

handle_action( $db );				// действие над комментарием исходя из поля $_REQUEST['action']

$comments = get_comments( $db );	// получаем все комментарии из базы

require 'view.php'; 				// подключаем файл с отображением страницы

?>