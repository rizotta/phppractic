<?
// Задаём константы
// url-адрес для браузера для отображения картинок
define( 'UPLOAD_URL', '/static/upload/');	
// адрес для файловой системы для возможности удаления картинок
define( 'UPLOAD_DIR', __DIR__ . UPLOAD_URL);		// __DIR__ - ссылается на текущую папку
 
// Загружка изображения
function upload_image( $data ) {
	//var_dump( $data );	// смотрим, что находится в данных 

	// допустимые типы изображений
	$allowedTypes = [		
		'image/png' => 'png',  
		'image/jpg' => 'jpg', 
		'image/gif' => 'gif', 
		'image/jpeg' => 'jpg'];	

 	// если тип недопустим, выходим из функции
	if ( !in_array( $data[ 'type'], array_keys( $allowedTypes ))) { 	
		return false;													
	}

	// если файл больше 10 Мб, выходим
	if ( filesize($data['tmp_name']) > 1024 * 1024 * 10) {				
		return false;				
	}

	// формируем случайное значение для имени (уник. идентиф. основанный на времени + md5(хеш-сумма)) + зн-е текущего типа данных
	$filename = md5(uniqid()) . '.' . $allowedTypes[ $data['type' ]]; 	

	// формируем путь, куда переместится временное изображение
	$path = UPLOAD_DIR.$filename;  		

	// перемещаем временное изображение в выше указанную папку
	move_uploaded_file( $data['tmp_name'], $path );			

	return true;

}

// получаем список изображений
function get_images() {
	// начальное состояние списка
	$data = []; 		// массив с пустыми изображениями
	// открываем папку для чтения
	$handle = opendir( UPLOAD_DIR );
	if ( !$handle ) {	// если не удалось открыть папку с изображениями - выходим
		return $data;
	}

	// читаем каждый файл в папке, пока не закончится
	while ( false !== ($entry = readdir( $handle ) )) { 		// читаем содержимое папки по одному файлу
		// если название файла - текущая папка или каталог выше, не будем включать эти обозначения
		if ( $entry ==='..' || $entry === '.' ) {		// .. - ссылается на каталог выше, . - ссылается на текущий каталог
			continue; 								// продолжаем чтение, эти файлы не интересуют
		}
		// в ином случаем, добавляем элемент
		$data[] = [
			'name' => $entry,						// добавляем имя
			//'url' => UPLOAD_URL.'/'.$entry,			// формируем ссылку на изображение
			'url' => UPLOAD_URL.$entry,			// формируем ссылку на изображение без лишнего слеша
			'path' => UPLOAD_DIR.$entry			// добавляем полный путь к изображению
		];
	}

	return $data;
}

// переадресация в рамках той же директории, на другую страницу
function redirect( $page ) {
	//получаем название домена вместе с протоколом
	$origin = $_SERVER[ 'HTTP_ORIGIN' ];
	// получаем вторую часть текущего адреса
	$uri = $_SERVER[ 'REQUEST_URI' ];
	// находим директорию, в которой был вызван файл
	$index = strrpos( $uri, '/');
	// удаляем всё после, т.к. после будет название текущей страницы, которую нам нужно заменить на $page
	$url = $origin . substr( $uri, 0, $index ) . '/' . $page;
	// осуществляем переадресацию, посылаем браузеру соот. загловок
	header( 'Location: '. $url ); 				// перемещаемся обратно на index.php

//var_dump( $_SERVER);			//  ищем подходящий путь из данных
//var_dump( $_SERVER[ 'HTTP_ORIGIN']);		// http или https или другой- отправляется не всеми браузерами? безопасность?
//var_dump( $_SERVER[ 'REQUEST_URI']);		// /galery/admin/upload.php
	
}

// удаление изображений
function remove_image( $name ) {
	//получаем список изображений
	$images = get_images();			// получаем все изображения

	// среди всех изображений находим нужное
	for ( $i = 0, $len = count( $images); $i < $len; $i++) {
		// получаем отдельную информацию об изображении
		$item = $images[ $i ];

		// если имя изображения то, которое надо удалить
		if ( $item['name'] === $name) {	
			// удаляем изображение из файловой системы, нужен полный путь до файла, начиная с буквы диска Windows или с .
			unlink( $item[ 'path' ]);	
			return true;				
		}
	}
	return false;	// не получилось удалить
}


?>