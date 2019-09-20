<?php
// Здесь хранится вся логика

require_once '../functions.php';
$images = get_images();			// получаем изображение

//var_dump( $images );			// проверяем, что находится в массиве изображений
require '_view.php';			// отображаем страницу

