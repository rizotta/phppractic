<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Чат</title> 
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<a href="../">Вернуться на главную страницу</a>
	<h1>Онлайн-чат</h1>

	<div class="chat">
		<?php foreach ($comments as $comment): ?>
			<div class="chat__comment">
				<div class="chat__comment-body">
					<?php if (is_comment_owner($comment)): ?>
						<a href="?action=delete&amp;id=<?= $comment['id'] ?>" class="chat__comment-delete">Удалить</a>
					<?php endif ?>
					<div class="chat__username">
						<?= $comment[ 'username' ]?>:
					</div>
					<div class="chat__message">
						<?= $comment[ 'message' ]?>
					</div>
				</div>
			</div>
		<?php endforeach ?>

		<form class="chat__add-message" method="post">
			<h3>Добавить комментарий</h3>
			
			<?php if (empty( $_SESSION['username'] )): ?>
				<div class="chat__form-row">
					<input type="text" name="username" placeholder="Введите имя">
				</div>	

			<?php else: ?>
				<div class="chat__form-username">
					<?=$_SESSION['username']?>:
				</div>
			<?php endif ?>
			
			<div class="chat__form-row">
				<textarea name="message" cols="40" rows="3" placeholder="Текст сообщения"></textarea>
			</div>
			<input type="hidden" name="action" value="create">
			<button>Добавить</button>
		</form>
	</div>

</body>
</html>