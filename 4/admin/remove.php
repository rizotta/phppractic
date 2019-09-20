<?

require_once '../functions.php';

// если кто-то попал случайно на страницу или не загрузил ни одного файла
if ( !isset( $_GET[ 'name' ] )) {		
	die;
}

$status = remove_image( $_GET[ 'name' ] );		// удаляем изображение

redirect( 'index.php' );

?> 