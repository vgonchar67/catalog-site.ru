<h1>Гостевая книга</h1>
<ul class="media-list comments">
<?php foreach($comments['items'] as $comment):?>
	<li class="media">
		<div class="media-left">
			<a href="#">
				<img class="media-object" style="width: 64px; height: 64px;" src="/public/images/default-avatar.png" alt="...">
			</a>
		</div>
		<div class="media-body">
			<h4 class="media-heading">#<?=$comment['id']?> <?=$comment['user_name']?></h4>
			<?=$comment['text']?>
			<div class="signature">
				<div>Homepage: <a href="<?=$comment['homepage']?>" target="_blank"><?=$comment['homepage']?></a></div>
				<div>E-mail: <?=$comment['email']?></div>
			</div>
		</div>
	</li>
<?php endforeach;?>
</ul>

<?=$comments['pagenationHTML']?>

<button class="btn btn-default" data-toggle="modal" data-target="#commentsModal">Комментировать</button>
<div class="modal fade" id="commentsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Оставить комментарий</h4>
			</div>
			<div class="modal-body" id="form">
				<div class="js-common-error"></div>
				<div class="form-group">
					<label for="user_name" class="control-label">UserName:</label>
					<input type="text" name="user_name" class="form-control" id="user-name">
					<span class="error-text"></span>
				</div>
				<div class="form-group">
					<label for="homepage" class="control-label">Homepage:</label>
					<input type="text" name="homepage" class="form-control" id="homepage">
					<span class="error-text"></span>
				</div>
				<div class="form-group">
					<label for="email" class="control-label">E-mail:</label>
					<input type="text" name="email" class="form-control" id="email">
					<span class="error-text"></span>
				</div>
				<div class="form-group">
					<label for="message-text" class="control-label">Text:</label>
					<textarea name="text" class="form-control" id="message-text"></textarea>
					<span class="error-text"></span>
				</div>
				<div class="form-group">
					<img src="/captcha" id="captcha_image"/>
					<input type="text" name="captcha" id="captcha" class="form-control"/>
					<span class="error-text"></span>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
				<button type="button" class="btn btn-primary" id='send'>Отправить</button>
			</div>
		</div>
	</div>
</div>