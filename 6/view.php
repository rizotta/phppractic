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
					<?php // если пользователь - владелец комментария, предоставляем возможность удалять и изменять
					if (is_comment_owner($comment)): ?>
						<a href="?action=delete&amp;id=<?= $comment['id'] ?>" class="chat__comment-delete">Удалить</a>
						<a href="?action=comment-edit&amp;id=<?= $comment['id'] ?>" class="chat__comment-update">Редактировать</a>
					<?php endif ?>
					<div class="chat__username">
						<?= $comment[ 'username' ]?>:
					</div>
					<div class="chat__date">
						<?= date('d.m.Y H:i:s', strtotime($comment['created_at'])) // преобразование даты к правильному формату ?>	
					</div>
					<div class="chat__message">
						<?php 
						// если комментарий с таким id редактируется его автором, выводим форму изменения. Иначе - обычный текст комментария
						if (($_GET['action'] ?? '' === 'comment-edit') && is_comment_owner( $comment ) && $_GET['id'] === $comment['id']): ?>
						<form action="index.php" method="post">
							<div class="chat__form-row" comment-edit>
								<textarea name="message" cols="40" rows="3" placeholder="Текст сообщения"><?= $comment['message'] ?></textarea>
							</div>
							<input type="hidden" name="action" value="update">
							<input type="hidden" name="id" value="<?= $comment['id']?>">
							<button>Изменить</button>
						</form>
						<?php else: ?>
							<?= $comment[ 'message' ]?>
						<?php endif ?>
					</div>
				</div>
			</div>
		<?php endforeach ?>

		<form class="chat__add-message" method="post">
			<h3>Добавить комментарий</h3>
			<?php // если в сессии нет имени пользователя - запрашиваем. Иначе - выводим имя из сессии.
			if (empty( $_SESSION['username'] )): ?>
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