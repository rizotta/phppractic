<?

require_once '../functions.php';

// var_dump( $_FILES );			// проверка, подгрузился ли файл

// если кто-то попал случайно на страницу или не загрузил ни одного файла
if ( !isset( $_FILES[ 'file' ] )) {		
	die;
}

$status = upload_image( $_FILES[ 'file' ] );		//  загружаем картинку

redirect( 'index.php' );

?> 