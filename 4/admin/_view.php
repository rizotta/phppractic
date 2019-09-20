<!-- Отображение страницы  -->

<!doctype html> 
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Управление файлами</title>
	<link rel="stylesheet" href="../static/style.css">
</head>
<body> 
	<a href="../../">Вернуться на главную страницу</a><br>	
	<div class="upload">
		<h3 class="upload_title">Загрузить файл</h3>
		<form action="upload.php" method="post" enctype="multipart/form-data">
			<div class="upload-row">
				<input type="file" name="file" accept="image/jpg, image/jpeg, image/gif, image/png">
			</div>
			<button>Загрузить</button>
		</form>
	</div>

	<div class="list">
		<!-- Выводим список изображений -->
		<?php foreach ($images as $image): ?>
			<div class="list_item">
				<!-- Изображения находятся в каталоге уровнем выше, поэтому указываем перед путем к изображению .. -->
				<a href="..<?= $image['url'] ?>" target="blank"><img src="..<?= $image['url'] ?>" class="list_image"></a>
				<!-- Выводим ссылку на удаление изображения, передаём имя изображения -->
				<a href="remove.php?name=<?= $image['name']?>" class="list_remove_image">X</a>
			</div>
		<?php endforeach ?>
		<!-- <a href="http://ya.ru" target="blank"><img class="list_image" src="http://placeimg.com/640/480/any" alt=""></a> -->
		<!-- http://pp/galery/static/upload/b27098d0008db5ba1fffef4054f6abe1.jpg  -->
	</div>
</body>
</html>