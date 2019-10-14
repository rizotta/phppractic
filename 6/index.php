<?php
require 'comments.php';				// здесь функции для CRUD + проверка собственника комментария
require 'contoller.php';			// здесь handle_action - управление действиями над комментариями 

session_start();					// формируем сессии

$db = new PDO("mysql:host=localhost;dbname=practic_chat;charset=UTF8", "mysql", "mysql");	// подключение к БД

handle_action( $db );				// действия над комментарием исходя из поля $_REQUEST['action']

$comments = get_comments( $db );	// получаем все комментарии из базы

require 'view.php'; 				// подключаем файл с отображением страницы

?>