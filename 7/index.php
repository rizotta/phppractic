<?php 

require 'functions.php';
session_start();						// формируем начало сессии

$pageTitle = 'Авторизация на сайте';

$action = $_REQUEST['action'] ?? '';

if ( $action == 'login') {
	$result = auth_user( $_POST['username'], $_POST['password']);
	if (is_string( $result )) {		// если результат - строка, то не отображаем другие страницы
		echo $result;				// отображаем ошибку в зависимости от выполнения функции
		die;
	}
}

$isGuest = user_is_guest();							// является ли пользователь зарегистрированным
$view = $isGuest ? 'login.php' : 'account.php';		// в зависимости от ответа выбираем страницу
require __DIR__.'/views/'.$view;					// подключаем выбранную страницу