<?php  require '_head.php'; ?>

<a href="../">Вернуться на главную страницу</a>
<div class="grid-container">
	<div class="grid-x">
		<h1>Авторизация</h1>
	</div>

	<form action="" method="post">
		<input type="hidden" name="action" value="login">
		<div class="row">
			<input type="text" name="username" required placeholder="Логин">
		</div>
		<div class="row">
			<input type="password" name="password" required placeholder="Пароль">
		</div>
		<div class="row">
			<button class="button">Войти</button>
		</div>
	</form>
</div>

<?php require '_footer.php'; ?>