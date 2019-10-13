<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Адресная книга</title>
</head>
<body>
	<a href="../">Вернуться на главную страницу</a><br>	<br>
	<a href="/5"> Очистить адресную строку</a>	
	<p>Admin panel: <a href="?restore">Восстановить всех удалённых</a></p>


	<table border="1" > <!-- это лучше в css прописать-->
		<tr>
			<th>Id</th>
			<th>Имя</th>
			<th>Фамилия</th>
			<th>Логин</th>
			<th>E-mail</th>
			<th>Возраст</th>
			<th>Дата рождения</th>
			<th>Создано</th>
			<th>Обновлено</th>
			<th colspan=2>Действия</th>
		</tr>
	
		<?php foreach ($users as $user ): ?>
				<tr>
					<td><?= $user[ 'id' ]?></td>
					<td><?= $user[ 'name' ]?></td>
					<td><?= $user[ 'last_name' ]?></td>
					<td><?= $user[ 'username' ]?></td>
					<td><?= $user[ 'email' ]?></td>
					<td><?= $user[ 'age' ]?></td>
					<td><?= $user[ 'birthday' ]?></td>
					<td><?= $user[ 'created_at' ]?></td>
					<td><?= $user[ 'updated_at' ]?></td>
					<td>
						<a href="?deleteForever=<?= $user['id']?>">Удалить навсегда</a>
					</td>
					<td>
						<a href="?delete=<?= $user['id']?>">Удалить из таблицы</a>
					</td>
					
				</tr>
			<?php endforeach ?>
	</table>
	
	<form method="post"> 
		<h3>Добавить пользователя</h3>
		<div class="row">
			<input type="text" name="name" placeholder="Имя">
		</div>
		<div class="row">
			<input type="text" name="last_name" placeholder="Фамилия">
		</div>
		<div class="row">
			<input type="text" name="username" placeholder="Логин">
		</div>
		<div class="row">
			<input type="password" name="password" placeholder="Пароль">
		</div>
		<div class="row">
			<input type="email" name="email" placeholder="E-mail">
		</div>
		<!-- <div class="row">
			<input type="number" name="age" placeholder="Возраст">
		</div> -->
		<div class="row">
			<input type="date" name= "birthday" placeholder="Дата рождения">
		</div>
		<input type="hidden" name="insert" value="1">
		<button>Добавить</button>
	</form>
</body>
</html>